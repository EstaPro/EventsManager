<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Content;

use App\Models\HomeWidget;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class HomeWidgetListLayout extends Table
{
    public $target = 'widgets';

    public function columns(): array
    {
        return [
            TD::make('order', 'Sort')->sort()->width('60px'),

            TD::make('title', 'Section Title')
                ->sort()
                ->render(fn (HomeWidget $w) => Link::make($w->title)
                    ->route('platform.content.widgets.edit', $w->id)
                    ->class('fw-bold')),

            TD::make('widget_type', 'Type')
                ->sort()
                ->render(fn ($w) => match ($w->widget_type) {
                    'dynamic_list' => '<span class="badge bg-primary">Live Data</span>',
                    'slider'       => '<span class="badge bg-info text-dark">Slider</span>',
                    'menu_grid'    => '<span class="badge bg-warning text-dark">Menu</span>',
                    default        => '<span class="badge bg-secondary">'.ucfirst(str_replace('_', ' ', $w->widget_type)).'</span>',
                }),

            TD::make('content_info', 'Content')
                ->render(function (HomeWidget $w) {
                    if ($w->widget_type === 'dynamic_list') {
                        return '<span class="text-muted">Source: '.($w->data_source ?? 'None').'</span>';
                    }
                    return $w->items->count() . ' items';
                }),

            TD::make('is_active', 'Status')
                ->render(fn ($w) => $w->is_active
                    ? '<span class="text-success">✔ Active</span>'
                    : '<span class="text-danger">Hidden</span>'),

            // --- ADDED ACTIONS COLUMN ---
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (HomeWidget $widget) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
                        Link::make(__('Edit'))
                            ->route('platform.content.widgets.edit', $widget->id)
                            ->icon('bs.pencil'),

                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('Delete this section and all its content?'))
                            ->method('remove', [
                                'id' => $widget->id,
                            ]),
                    ])),
        ];
    }
}
