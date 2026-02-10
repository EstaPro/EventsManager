<?php

namespace App\Orchid\Screens\Content;

use App\Models\HomeWidget;
use App\Orchid\Layouts\Content\HomeWidgetListLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;

class HomeWidgetListScreen extends Screen
{
    public function name(): ?string { return 'App Home Manager'; }
    public function description(): ?string { return 'Configure the layout and content of the mobile app home screen.'; }

    public function query(): iterable
    {
        return [
            'widgets' => HomeWidget::with('items')->orderBy('order', 'asc')->paginate(20),
        ];
    }

    public function commandBar(): array
    {
        return [
            Link::make('Add Section')
                ->icon('bs.plus-lg')
                ->route('platform.content.widgets.create'),
        ];
    }

    public function layout(): iterable
    {
        return [HomeWidgetListLayout::class];
    }

    public function remove(Request $request)
    {
        HomeWidget::findOrFail($request->get('id'))->delete();
        Toast::info('Section deleted successfully.');
    }
}
