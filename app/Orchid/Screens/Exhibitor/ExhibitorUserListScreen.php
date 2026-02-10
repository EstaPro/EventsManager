<?php

namespace App\Orchid\Screens\Exhibitor;

use App\Models\User;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;

class ExhibitorUserListScreen extends Screen
{
    public $name = 'Exhibitors (Team Members)';
    public $description = 'List of users with the Exhibitor role.';

    public function query(): array
    {
        return [
            'exhibitors' => User::with('company')
                ->whereHas('roles', fn($q) => $q->where('slug', 'exhibitor'))
                ->paginate()
        ];
    }

    public function commandBar(): array
    {
        return [
            // Points to User creation (admin can assign role there)
            Link::make('Add Exhibitor User')
                ->icon('plus')
                ->route('platform.systems.users.create')
        ];
    }

    public function layout(): array
    {
        return [
            Layout::table('exhibitors', [
                TD::make('avatar', 'Avatar')->render(fn($u) =>
                $u->avatar ? "<img src='{$u->avatar}' width='40' style='border-radius:50%'>" : ''),

                TD::make('name', 'Name')->sort()->render(fn($u) => $u->name . ' ' . $u->last_name),

                TD::make('company_id', 'Company')->render(fn($u) =>
                $u->company ? $u->company->name : '<span class="text-muted">-</span>'),

                TD::make('job_title', 'Job Title'),
                TD::make('email', 'Email'),

                TD::make('Actions')->render(fn($u) =>
                Link::make('Edit')
                    ->route('platform.systems.users.edit', $u->id)
                )
            ])
        ];
    }
}
