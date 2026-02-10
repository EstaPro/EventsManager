<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Speaker;

use App\Models\Speaker;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SpeakerListLayout extends Table
{
    public $target = 'speakers';

    public function columns(): array
    {
        return [
            TD::make('photo', 'Photo')
                ->width('70px')
                ->render(fn (Speaker $speaker) => $speaker->photo_url
                    ? "<img src='{$speaker->photo_url}' alt='photo' class='rounded-circle bg-light' style='width:40px; height:40px; object-fit:cover;'>"
                    : ''),

            TD::make('full_name', 'Full Name')
                ->sort()
                ->filter(Input::make())
                ->render(fn (Speaker $speaker) => Link::make($speaker->full_name)
                    ->route('platform.speakers.edit', $speaker->id)
                    ->class('fw-bold')),

            TD::make('job_title', 'Job Title')
                ->sort()
                ->render(fn (Speaker $speaker) => $speaker->job_title ?? '—'),

            TD::make('company_name', 'Company')
                ->sort()
                ->filter(Input::make()),

            TD::make('created_at', 'Created')
                ->sort()
                ->render(fn ($speaker) => $speaker->created_at->format('M d, Y')),
        ];
    }
}
