<?php

namespace App\Orchid\Screens\Content;

use App\Models\HomeWidget;
use App\Models\HomeWidgetItem;
use App\Orchid\Layouts\Content\HomeWidgetItemListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Color;

class HomeWidgetEditScreen extends Screen
{
    public $widget;

    public function query(HomeWidget $widget): iterable
    {
        // Load the widget and its items (sorted)
        return [
            'widget' => $widget,
            'items'  => $widget->items()->orderBy('order', 'asc')->get(),
        ];
    }

    public function name(): ?string
    {
        return $this->widget->exists ? $this->widget->title : 'Create New Section';
    }

    public function commandBar(): array
    {
        return [
            Link::make('Back')
                ->icon('bs.arrow-left')
                ->route('platform.content.widgets.list'),

            Button::make('Save Changes')
                ->icon('bs.check-circle')
                ->method('save'),

            Button::make('Delete Section')
                ->icon('bs.trash3')
                ->method('remove')
                ->canSee($this->widget->exists),
        ];
    }

    public function layout(): iterable
    {
        // Only show content management if the section is saved (exists)
        // AND it's a manual section (not a dynamic list)
        $canManageContent = $this->widget->exists && empty($this->widget->data_source);

        return [
            Layout::tabs([

                // TAB 1: General Settings
                'Configuration' => [
                    Layout::rows([
                        Input::make('widget.title')->title('Title')->required(),
                        Select::make('widget.widget_type')->options(HomeWidget::TYPES)->required(),
                        Select::make('widget.data_source')->options(HomeWidget::DATA_SOURCES)->empty('Manual Content'),
                        Input::make('widget.order')->type('number')->title('Order'),
                        CheckBox::make('widget.is_active')->sendTrueOrFalse()->title('Visible'),
                    ]),
                ],

                // TAB 2: Items List
                'Content Items' => [
                    // The "Add Item" button
                    Layout::rows([
                        Link::make('Add New Item')
                            ->icon('bs.plus-circle')
                            ->type(Color::PRIMARY)
                            ->route('platform.content.items.create', ['widgetId' => $this->widget->id ?? 0])
                            ->canSee($canManageContent)
                    ]),

                    // The Items Table
                    HomeWidgetItemListLayout::class,
                ],
            ]),
        ];
    }

    public function save(HomeWidget $widget, Request $request)
    {
        $widget->fill($request->get('widget'))->save();
        Toast::info('Settings saved.');
        return redirect()->route('platform.content.widgets.edit', $widget->id);
    }

    public function remove(HomeWidget $widget)
    {
        $widget->delete();
        Toast::info('Section deleted.');
        return redirect()->route('platform.content.widgets.list');
    }

    public function removeItem(Request $request)
    {
        $item = HomeWidgetItem::findOrFail($request->get('id'));
        $item->delete();

        Toast::info('Item removed.');
        // Refresh the page to show the updated list
        return redirect()->route('platform.content.widgets.edit', $this->widget->id);
    }
}
