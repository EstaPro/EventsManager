<?php

namespace App\Orchid\Screens\Banner;

use App\Models\AppBanner;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\Select;

class BannerListScreen extends Screen
{
    /**
     * Query data.
     */
    public function query(): iterable
    {
        return [
            'banners' => AppBanner::filters()
                ->defaultSort('section')
                ->orderBy('order', 'asc')
                ->paginate(20),
        ];
    }

    /**
     * Display header name.
     */
    public function name(): ?string
    {
        return 'Home Content Manager';
    }

    /**
     * Button commands.
     */
    public function commandBar(): array
    {
        return [
            Link::make('Add New Item')
                ->icon('bs.plus-circle')
                ->route('platform.banners.create'),
        ];
    }

    /**
     * Views.
     */
    public function layout(): iterable
    {
        return [
            Layout::table('banners', [

                // 1. IMAGE PREVIEW
                TD::make('image_path', 'Preview')
                    ->width('100px')
                    ->align(TD::ALIGN_CENTER)
                    ->render(fn (AppBanner $banner) => $banner->image_url
                        ? "<div class='p-1 border rounded bg-white'>
                             <img src='{$banner->image_url}'
                                  style='height:50px; width:auto; display:block; margin:0 auto;'>
                           </div>"
                        : '<span class="text-muted text-xs">No Image</span>'),

                // 2. SECTION (With Filter)
                TD::make('section', 'Section')
                    ->sort()
                    ->filter(
                        Select::make()
                            ->options(AppBanner::SECTIONS)
                            ->empty('All Sections')
                    )
                    ->render(function (AppBanner $banner) {
                        $label = AppBanner::SECTIONS[$banner->section] ?? $banner->section;
                        // Color coding simply based on hash of string, or static mapping
                        return "<span class='badge bg-info text-dark'>{$label}</span>";
                    }),

                // 3. TITLE
                TD::make('title', 'Title')
                    ->sort()
                    ->render(fn ($b) => $b->title
                        ? "<span class='fw-bold'>{$b->title}</span>"
                        : '<span class="text-muted">—</span>'),

                // 4. ORDER
                TD::make('order', 'Sort')
                    ->sort()
                    ->align(TD::ALIGN_CENTER)
                    ->width('80px'),

                // 5. STATUS (Green/Red Badge)
                TD::make('is_active', 'Status')
                    ->sort()
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(fn ($b) => $b->is_active
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-danger">Hidden</span>'),

                // 6. ACTIONS (Edit / Delete)
                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(fn (AppBanner $banner) => DropDown::make()
                        ->icon('bs.three-dots-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.banners.edit', $banner->id)
                                ->icon('bs.pencil'),

                            Button::make(__('Delete'))
                                ->icon('bs.trash3')
                                ->confirm(__('Are you sure you want to delete this item?'))
                                ->method('remove', [
                                    'id' => $banner->id,
                                ]),
                        ])),
            ]),
        ];
    }

    /**
     * Remove method handles the Delete button action from the list.
     */
    public function remove(Request $request)
    {
        $banner = AppBanner::findOrFail($request->get('id'));
        $banner->delete();

        Toast::info('Item deleted successfully.');

        return redirect()->back();
    }
}
