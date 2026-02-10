<?php

namespace App\Orchid\Screens\App;

use App\Models\HomeSection;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class HomeSectionListScreen extends Screen
{
    public function name(): ?string { return 'Home Page Sections'; }
    public function description(): ?string { return 'Manage the order and visibility of home screen blocks.'; }

    public function query(): iterable
    {
        return [
            'sections' => HomeSection::orderBy('order', 'asc')->paginate(20),
        ];
    }

    public function commandBar(): array
    {
        return [
            Link::make('Add Section')
                ->icon('bs.plus-circle')
                ->route('platform.app.sections.create'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::table('sections', [
                TD::make('order', 'Order')->sort()->width('80px'),

                TD::make('title', 'Display Title')
                    ->render(fn(HomeSection $s) => Link::make($s->title ?? 'No Title')
                        ->route('platform.app.sections.edit', $s->id)
                        ->class('fw-bold')),

                TD::make('section_key', 'System Key')
                    ->render(fn($s) => "<span class='badge bg-dark'>{$s->section_key}</span>"),

                TD::make('banners_count', 'Items')
                    ->render(fn($s) => $s->banners()->count() . ' items'),

                TD::make('is_active', 'Active')
                    ->render(fn ($s) => $s->is_active ? '<span class="text-success">●</span>' : '<span class="text-danger">○</span>'),
            ]),
        ];
    }
}
