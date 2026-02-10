<?php

namespace App\Orchid\Screens\Speaker;

use App\Orchid\Layouts\Speaker\SpeakerListLayout;
use App\Models\Speaker;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;

class SpeakerListScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'speakers' => Speaker::filters()
                ->defaultSort('full_name') // Updated to full_name
                ->paginate(),
        ];
    }

    public function name(): ?string
    {
        return 'Speakers';
    }

    public function commandBar(): array
    {
        return [
            Link::make('Add Speaker')
                ->icon('bs.person-plus')
                ->route('platform.speakers.create'),
        ];
    }

    public function layout(): iterable
    {
        return [
            SpeakerListLayout::class,
        ];
    }
}
