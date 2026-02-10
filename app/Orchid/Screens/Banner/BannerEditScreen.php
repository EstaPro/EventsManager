<?php

namespace App\Orchid\Screens\Banner;

use App\Models\AppBanner;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class BannerEditScreen extends Screen
{
    public $banner;

    public function query(AppBanner $banner): iterable
    {
        return [
            'banner' => $banner,
        ];
    }

    public function name(): ?string
    {
        return $this->banner->exists ? 'Edit Item' : 'Add Home Item';
    }

    public function commandBar(): array
    {
        return [
            Button::make('Save')->icon('bs.check-circle')->method('save'),
            Button::make('Delete')->icon('bs.trash3')->method('remove')->canSee($this->banner->exists),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::rows([
                Select::make('banner.section')
                    ->title('Section')
                    ->options(AppBanner::SECTIONS)
                    ->help('Where should this image appear on the home screen?')
                    ->required(),

                Cropper::make('banner.image_path')
                    ->title('Image / Logo')
                    ->targetRelativeUrl()
                    ->width(1000) // General width, user can crop
                    ->required(),

                Input::make('banner.title')
                    ->title('Title (Optional)')
                    ->placeholder('e.g. Sponsor Name'),

                Input::make('banner.link_url')
                    ->title('External Link (Optional)')
                    ->placeholder('https://...'),

                Input::make('banner.order')
                    ->type('number')
                    ->title('Sort Order')
                    ->value(0)
                    ->help('Lower numbers appear first.'),

                CheckBox::make('banner.is_active')
                    ->title('Visible')
                    ->sendTrueOrFalse()
                    ->value(1),
            ])
        ];
    }

    public function save(AppBanner $banner, Request $request)
    {
        $banner->fill($request->get('banner'))->save();
        Toast::info('Saved successfully.');
        return redirect()->route('platform.banners.list');
    }

    public function remove(AppBanner $banner)
    {
        $banner->delete();
        Toast::info('Deleted.');
        return redirect()->route('platform.banners.list');
    }
}
