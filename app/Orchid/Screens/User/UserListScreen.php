<?php

declare(strict_types=1);

namespace App\Orchid\Screens\User;

use App\Orchid\Layouts\User\UserEditLayout;
use App\Orchid\Layouts\User\UserFiltersLayout;
use App\Orchid\Layouts\User\UserListLayout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Company;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Color;

class UserListScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'users' => User::with(['roles', 'company'])
                ->filters(UserFiltersLayout::class)
                ->defaultSort('id', 'desc')
                ->paginate(20),
            'stats' => [
                'total' => User::count(),
                'exhibitors' => User::whereHas('roles', function($q) {
                    $q->where('slug', 'exhibitor');
                })->count(),
                'visitors' => User::whereHas('roles', function($q) {
                    $q->where('slug', 'visitor');
                })->count(),
                'with_company' => User::whereNotNull('company_id')->count(),
                'visible' => User::where('is_visible', true)->count(),
            ],
        ];
    }

    public function name(): ?string
    {
        return 'User Management';
    }

    public function description(): ?string
    {
        return 'Manage all registered users, their profiles, roles, and visibility.';
    }

    public function permission(): ?iterable
    {
        return [
            'platform.systems.users',
        ];
    }

    public function commandBar(): iterable
    {
        return [
            Button::make('Export Users')
                ->icon('bs.download')
                ->method('exportUsers')
                ->class('btn btn-outline-secondary'),

            Link::make(__('Add User'))
                ->icon('bs.plus-circle')
                ->route('platform.systems.users.create')
                ->type(Color::PRIMARY),
        ];
    }

    public function layout(): iterable
    {
        return [
            // Statistics Dashboard
            Layout::view('orchid.users.stats', [
                'stats' => $this->query()['stats']
            ]),

            // Filters
            UserFiltersLayout::class,

            // Bulk Actions
            Layout::rows([
                Button::make('Toggle Visibility (Selected)')
                    ->icon('bs.eye')
                    ->confirm('Toggle visibility for selected users?')
                    ->method('bulkToggleVisibility')
                    ->class('btn btn-warning'),

                Button::make('Delete Selected')
                    ->icon('bs.trash')
                    ->confirm('Are you sure you want to delete the selected users?')
                    ->method('bulkDelete')
                    ->class('btn btn-danger'),
            ])->title('Bulk Actions'),

            // User List
            UserListLayout::class,

            // Edit Modal
            Layout::modal('editUserModal', UserEditLayout::class)
                ->title('Edit User')
                ->applyButton('Save Changes')
                ->deferred('loadUserOnOpenModal'),
        ];
    }

    public function loadUserOnOpenModal(User $user): iterable
    {
        return [
            'user' => $user,
        ];
    }

    public function saveUser(Request $request, User $user): void
    {
        $request->validate([
            'user.name' => 'required|string|max:255',
            'user.last_name' => 'nullable|string|max:255',
            'user.email' => [
                'required',
                'email',
                Rule::unique(User::class, 'email')->ignore($user),
            ],
            'user.phone' => 'nullable|string|max:20',
            'user.job_title' => 'nullable|string|max:255',
            'user.bio' => 'nullable|string|max:1000',
            'user.company_id' => 'nullable|exists:companies,id',
            'user.linkedin_url' => 'nullable|url',
            'user.is_visible' => 'boolean',
        ]);

        $userData = $request->input('user');
        $userData['is_visible'] = $userData['is_visible'] ?? false;

        $user->fill($userData)->save();

        Toast::success('User updated successfully.');
    }

    public function remove(Request $request): void
    {
        User::findOrFail($request->get('id'))->delete();

        Toast::success('User deleted successfully.');
    }

    public function bulkToggleVisibility(Request $request)
    {
        $userIds = $request->get('users', []);

        if (empty($userIds)) {
            Toast::warning('No users selected.');
            return;
        }

        foreach ($userIds as $userId) {
            $user = User::find($userId);
            if ($user) {
                $user->is_visible = !$user->is_visible;
                $user->save();
            }
        }

        Toast::success('Visibility toggled for ' . count($userIds) . ' users.');
    }

    public function bulkDelete(Request $request)
    {
        $userIds = $request->get('users', []);

        if (empty($userIds)) {
            Toast::warning('No users selected.');
            return;
        }

        $count = User::whereIn('id', $userIds)->delete();

        Toast::success("Deleted {$count} users successfully.");
    }

    public function exportUsers()
    {
        $users = User::with(['roles', 'company'])->get();

        $csvData = "ID,Name,Last Name,Email,Phone,Job Title,Company,Role,Visible,Created At\n";

        foreach ($users as $user) {
            $csvData .= sprintf(
                "%d,\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\"\n",
                $user->id,
                $user->name,
                $user->last_name ?? '',
                $user->email,
                $user->phone ?? '',
                $user->job_title ?? '',
                $user->company->name ?? '',
                $user->roles->pluck('name')->implode(', '),
                $user->is_visible ? 'Yes' : 'No',
                $user->created_at->format('Y-m-d H:i:s')
            );
        }

        return response($csvData)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="users-' . now()->format('Y-m-d') . '.csv"');
    }
}
