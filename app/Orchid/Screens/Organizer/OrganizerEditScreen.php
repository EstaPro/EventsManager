<?php

namespace App\Orchid\Screens\Organizer;

use App\Models\Organizer;
use App\Models\Event;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class OrganizerEditScreen extends Screen
{
    public $organizer;

    public function query(Organizer $organizer): iterable
    {
        $organizer->load('events');
        return [
            'organizer' => $organizer
        ];
    }

    public function name(): ?string
    {
        return $this->organizer->exists ? 'Edit Organizer' : 'Add Organizer';
    }

    public function commandBar(): iterable
    {
        return [
            Button::make('Save')->icon('bs.check-circle')->method('save'),
            Button::make('Remove')->icon('bs.trash3')->method('remove')->canSee($this->organizer->exists),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::rows([
                Cropper::make('organizer.photo')
                    ->title('Photo')
                    ->targetRelativeUrl(),

                Input::make('organizer.first_name')->title('First Name')->required(),
                Input::make('organizer.last_name')->title('Last Name')->required(),
                Input::make('organizer.job_function')->title('Job Function / Role'),

                TextArea::make('organizer.description')->title('Bio / Description'),

                Relation::make('organizer.events')
                    ->title('Assigned Events')
                    ->fromModel(Event::class, 'name')
                    ->multiple(),
            ])
        ];
    }

    public function save(Organizer $organizer, Request $request)
    {
        $request->validate([
            'organizer.first_name' => 'required',
            'organizer.last_name' => 'required',
        ]);

        $organizer->fill($request->get('organizer'))->save();
        $organizer->events()->sync($request->input('organizer.events', []));

        Toast::info('Organizer saved.');
        return redirect()->route('platform.organizers');
    }

    public function remove(Organizer $organizer)
    {
        $organizer->delete();
        Toast::info('Organizer removed.');
        return redirect()->route('platform.organizers');
    }
}
