<?php

namespace App\Orchid\Screens\App;

use App\Constants\AppSections;
use App\Models\HomeSection;
use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;

class HomeSectionEditScreen extends Screen
{
    public $name = 'Edit Home Section';
    public $section;

    public function query(HomeSection $section): array
    {
        return ['section' => $section];
    }

    public function commandBar(): array
    {
        return [
            Button::make('Save')
                ->icon('bs.check-circle')
                ->method('save'),

            Button::make('Delete')
                ->icon('bs.trash3')
                ->method('remove')
                ->canSee($this->section->exists)
                ->confirm('Are you sure you want to delete this section?'),
        ];
    }

    public function layout(): array
    {
        return [
            Layout::rows([
                // 1. TYPE SELECTION
                Select::make('section.section_key')
                    ->title('Section Type')
                    ->options(AppSections::getOptions()) // <--- CLEANER
                    ->help('Select the type of content to display in this slot.')
                    ->required(),

                // 2. DISPLAY TITLE
                Input::make('section.title')
                    ->title('Display Title')
                    ->placeholder('e.g. Featured Exhibitors')
                    ->help('This title will appear above the section or inside the tile.'),

                // 3. VISUAL SETTINGS (Grouped)
                Group::make([
                    Input::make('section.background_color')
                        ->type('color')
                        ->title('Background Color / Tint')
                        ->value('#1E3A8A') // Default to Deep Blue
                        ->help('Used as a gradient overlay or fallback color.'),

                    Input::make('section.order')
                        ->type('number')
                        ->title('Display Order')
                        ->value(0)
                        ->help('Lower numbers appear first (e.g. 0, 10, 20).'),
                ]),

                // 4. IMAGE UPLOAD
                // Using Picture is much better than pasting a URL
                Picture::make('section.background_image')
                    ->title('Background Image')
                    ->targetRelativeUrl() // Saves as /storage/...
                    ->help('Upload a background image for the Tile or Header.'),

                // 5. VISIBILITY
                Switcher::make('section.is_active')
                    ->title('Visible in App')
                    ->help('Toggle to show or hide this section immediately on the mobile app.')
                    ->sendTrueOrFalse(),
            ])
        ];
    }

    public function save(HomeSection $section, Request $request)
    {
        // Validation could be added here
        $section->fill($request->get('section'))->save();

        Toast::info('Home section updated successfully.');

        return redirect()->route('platform.app.sections.list');
    }

    public function remove(HomeSection $section)
    {
        $section->delete();

        Toast::info('Section deleted.');

        return redirect()->route('platform.app.sections.list');
    }
}
