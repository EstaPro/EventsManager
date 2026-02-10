<?php

namespace App\Orchid\Screens\Sponsor;

use App\Models\Sponsor;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;

class SponsorListScreen extends Screen
{
    public function query(): iterable {
        return ['sponsors' => Sponsor::paginate()];
    }

    public function name(): ?string { return 'Sponsors'; }

    public function commandBar(): iterable {
        return [
            Link::make('Add Sponsor')
                ->icon('bs.plus-circle')
                ->href(route('platform.sponsors.create'))
        ];
    }

    public function layout(): iterable {
        return [
            Layout::table('sponsors', [
                TD::make('name', 'Name'),
                TD::make('type', 'Type'),
                TD::make('Actions')->alignRight()->render(fn (Sponsor $s) =>
                Link::make('Edit')
                    ->route('platform.sponsors.edit', $s->id)
                    ->icon('bs.pencil')
                ),
            ])
        ];
    }
}
