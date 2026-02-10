<?php

namespace App\Orchid\Screens\Interaction\Networking;

use App\Models\Connection;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Color;

class ConnectionRequestListScreen extends Screen
{
    public $name = 'Connection Requests';
    public $description = 'Track and moderate user networking requests';

    public function query(Request $request): array
    {
        $status = $request->get('status');

        $requests = Connection::with(['requester', 'target'])
            ->when($status, fn ($q) => $q->where('status', $status))
            ->latest()
            ->paginate(15);

        return [
            'requests' => $requests,
            'stats' => [
                'pending'   => Connection::where('status', 'pending')->count(),
                'accepted'  => Connection::where('status', 'accepted')->count(),
                'declined'  => Connection::where('status', 'declined')->count(),
                'today'     => Connection::whereDate('created_at', today())->count(),
            ],
        ];
    }

    public function commandBar(): array
    {
        return [
            Link::make('All')
                ->route('platform.networking.requests')
                ->icon('bs.list'),

            Link::make('Pending')
                ->route('platform.networking.requests', ['status' => 'pending'])
                ->icon('bs.hourglass-split'),

            Link::make('Accepted')
                ->route('platform.networking.requests', ['status' => 'accepted'])
                ->icon('bs.check-circle'),

            Link::make('Declined')
                ->route('platform.networking.requests', ['status' => 'declined'])
                ->icon('bs.x-circle'),
        ];
    }

    public function layout(): array
    {
        return [

            /* ================= Stats cards ================= */
            Layout::metrics([
                'Pending Requests' => 'stats.pending',
                'Accepted'         => 'stats.accepted',
                'Declined'         => 'stats.declined',
                'Requests Today'   => 'stats.today',
            ]),

            /* ================= Table ================= */
            Layout::table('requests', [

                TD::make('requester', 'From')
                    ->render(fn ($r) => view('orchid.networking.user-mini', [
                        'user' => $r->requester
                    ])),

                TD::make('target', 'To')
                    ->render(fn ($r) => view('orchid.networking.user-mini', [
                        'user' => $r->target
                    ])),

                TD::make('status', 'Status')
                    ->align(TD::ALIGN_CENTER)
                    ->render(fn ($r) => match ($r->status) {
                        'pending'  => '<span class="badge bg-warning text-dark">Pending</span>',
                        'accepted' => '<span class="badge bg-success">Accepted</span>',
                        'declined' => '<span class="badge bg-danger">Declined</span>',
                        default    => $r->status
                    }),

                TD::make('created_at', 'Requested')
                    ->render(fn ($r) => $r->created_at->diffForHumans()),

                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->render(fn ($r) =>
                    $r->status === 'pending'
                        ? Button::make('Accept')
                            ->icon('bs.check')
                            ->type(Color::SUCCESS)
                            ->method('forceAccept', ['id' => $r->id])

                        . Button::make('Decline')
                            ->icon('bs.x')
                            ->type(Color::DANGER)
                            ->method('forceDecline', ['id' => $r->id])
                        : '-'
                    ),
            ]),
        ];
    }

    /* ================= Actions ================= */

    public function forceAccept(int $id)
    {
        Connection::whereKey($id)->update(['status' => 'accepted']);
    }

    public function forceDecline(int $id)
    {
        Connection::whereKey($id)->update(['status' => 'declined']);
    }
}
