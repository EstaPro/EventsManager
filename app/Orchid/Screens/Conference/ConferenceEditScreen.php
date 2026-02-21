<?php

namespace App\Orchid\Screens\Conference;

use App\Models\Conference;
use App\Models\Speaker;
use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;

class ConferenceEditScreen extends Screen
{
    public $name = 'Edit Session';
    public $conference;

    public function query(Conference $conference): array
    {
        $conference->load('speakers');
        return ['conference' => $conference];
    }

    public function commandBar(): array
    {
        return [
            Button::make('Save')->icon('check')->method('save'),
            Button::make('Delete')->icon('trash')->method('remove')->canSee($this->conference->exists),
        ];
    }

    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('conference.title')->title('Session Title')->required(),

                Select::make('conference.type')
                    ->options([
                        'conference' => 'Conference',
                        'workshop' => 'Workshop',
                        'panel' => 'Panel Discussion',
                        'keynote' => 'Keynote',
                    ])
                    ->title('Session Type'),

                DateTimer::make('conference.start_time')->title('Start Time')->enableTime()->required(),
                DateTimer::make('conference.end_time')->title('End Time')->enableTime()->required(),

                Input::make('conference.location')->title('Room / Location'),

                TextArea::make('conference.description')->title('Description')->rows(5),

                // Relation to Speakers
                Relation::make('conference.speakers.')
                    ->fromModel(Speaker::class, 'full_name')
                    ->multiple()
                    ->title('Speakers'),
            ])
        ];
    }

    public function save(Conference $conference, Request $request)
    {
        $conference->fill($request->get('conference'))->save();
        // Sync speakers
        $conference->speakers()->sync($request->input('conference.speakers', []));

        Toast::info('Session saved.');
        return redirect()->route('platform.conferences.list');
    }

    public function remove(Conference $conference)
    {
        $conference->delete();
        Toast::info('Session deleted.');
        return redirect()->route('platform.conferences.list');
    }
}
