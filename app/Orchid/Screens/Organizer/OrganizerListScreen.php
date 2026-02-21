<?php

namespace App\Orchid\Screens\Organizer;

use App\Models\Organizer;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;

class OrganizerListScreen extends Screen
{
    public function query(): iterable {
        return ['organizers' => Organizer::paginate()];
    }

    public function name(): ?string { return 'Organizers & VIPs'; }

    public function commandBar(): iterable {
        return [
            Link::make('Add Organizer')
                ->icon('bs.plus-circle')
                ->href(route('platform.organizers.create'))
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::table('organizers', [
                TD::make('first_name', 'First Name'),
                TD::make('last_name', 'Last Name'),
                TD::make('job_function', 'Job Function'),

                // Show count of events
                TD::make('events', 'Events')->render(fn($o) =>
                    $o->events->count() . ' Event(s)'
                ),

                TD::make('Actions')->alignRight()->render(fn (Organizer $o) =>
                Link::make('Edit')
                    ->route('platform.organizers.edit', $o->id)
                    ->icon('bs.pencil')
                ),
            ])
        ];
    }
}
