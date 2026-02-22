<?php

namespace App\Orchid\Screens\Conference;

use App\Models\Conference;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;

class ConferenceListScreen extends Screen
{
    public $name = 'Conference Agenda';
    public $description = 'Manage talks, panels, and workshops.';

    public function query(): array
    {
        return [
            'conferences' => Conference::orderBy('start_time', 'asc')->paginate()
        ];
    }

    public function commandBar(): array
    {
        return [
            // ✅ FIX: Must point to 'create', not 'edit'
            Link::make('Add Session')
                ->icon('plus')
                ->route('platform.conferences.create')
        ];
    }

    public function layout(): array
    {
        return [
            Layout::table('conferences', [
                TD::make('title', 'Title')
                    ->sort()
                    ->filter(TD::FILTER_TEXT)
                    ->render(fn($c) => "<strong>{$c->title}</strong>"),

                TD::make('start_time', 'Time')
                    ->sort()
                    ->render(fn($c) => $c->start_time->format('M d, H:i') . ' - ' . $c->end_time->format('H:i')),

                TD::make('location', 'Room/Location')
                    ->sort(),

                TD::make('type', 'Format')
                    ->sort()
                    ->render(fn($c) => ucfirst($c->type)),

                TD::make('Actions')->render(fn($c) =>
                Link::make('Edit')
                    ->route('platform.conferences.edit', $c->id)
                    ->icon('pencil')
                )
            ])
        ];
    }
}
