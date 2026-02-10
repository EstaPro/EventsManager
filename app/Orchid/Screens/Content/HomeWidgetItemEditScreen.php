<?php

namespace App\Orchid\Screens\Content;

use App\Models\HomeWidgetItem;
use App\Models\HomeWidget;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class HomeWidgetItemEditScreen extends Screen
{
    public $item;
    public $widgetId;

    public function query(Request $request, HomeWidgetItem $item): iterable
    {
        // Determine parent Widget ID: from URL (create) or DB (edit)
        $this->widgetId = $request->get('widgetId') ?? $item->home_widget_id;

        return [
            'item' => $item,
        ];
    }

    public function name(): ?string
    {
        return $this->item->exists ? 'Edit Item' : 'Add Content';
    }

    public function commandBar(): array
    {
        return [
            Button::make('Save')->icon('bs.check-circle')->method('save'),
        ];
    }

    public function layout(): iterable
    {
        // Get widget type to conditionally show fields
        $widget = HomeWidget::find($this->widgetId);
        $type = $widget->widget_type ?? 'slider';

        return [
            Layout::rows([
                // Hidden field to link item to widget
                Input::make('item.home_widget_id')
                    ->type('hidden')
                    ->value($this->widgetId),

                // Image (for Sliders, Logos, Banners)
                Cropper::make('item.image')
                    ->title('Image')
                    ->targetRelativeUrl()
                    ->canSee(in_array($type, ['slider', 'logo_cloud', 'single_banner'])),

                // Icon (for Menu Grid)
                Input::make('item.icon')
                    ->title('Icon Name (Material)')
                    ->placeholder('e.g. calendar_today')
                    ->canSee($type === 'menu_grid'),

                Input::make('item.title')
                    ->title('Title')
                    ->placeholder('Main Text'),

                Input::make('item.subtitle')
                    ->title('Subtitle')
                    ->canSee($type === 'slider'),

                Input::make('item.action_url')
                    ->title('Link / Route')
                    ->placeholder($type === 'menu_grid' ? '/route' : 'https://...'),

                Input::make('item.order')
                    ->type('number')
                    ->title('Sort Order')
                    ->value(0),
            ])
        ];
    }

    public function save(HomeWidgetItem $item, Request $request)
    {
        $item->fill($request->get('item'))->save();
        Toast::info('Item saved.');
        // Redirect back to the Widget Edit Screen (Content Tab)
        return redirect()->route('platform.content.widgets.edit', $item->home_widget_id);
    }
}
