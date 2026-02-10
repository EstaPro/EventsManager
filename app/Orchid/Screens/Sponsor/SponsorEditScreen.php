<?php

namespace App\Orchid\Screens\Sponsor;

use App\Models\Sponsor;
use App\Models\Event;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class SponsorEditScreen extends Screen
{
    public $sponsor;

    public function query(Sponsor $sponsor): iterable
    {
        $sponsor->load('events');
        return [
            'sponsor' => $sponsor
        ];
    }

    public function name(): ?string
    {
        return $this->sponsor->exists ? 'Edit Sponsor' : 'Add Sponsor';
    }

    public function commandBar(): iterable
    {
        return [
            Button::make('Save')->icon('bs.check-circle')->method('save'),
            Button::make('Remove')->icon('bs.trash3')->method('remove')->canSee($this->sponsor->exists),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::rows([
                Cropper::make('sponsor.logo')
                    ->title('Sponsor Logo')
                    ->targetRelativeUrl(),

                Input::make('sponsor.name')->title('Name')->required(),

                Select::make('sponsor.type')
                    ->title('Type')
                    ->options([
                        'sponsor' => 'Sponsor',
                        'partner' => 'Partner',
                    ])
                    ->required(),

                Relation::make('sponsor.events')
                    ->title('Sponsored Events')
                    ->fromModel(Event::class, 'name')
                    ->multiple(),
            ])
        ];
    }

    public function save(Sponsor $sponsor, Request $request)
    {
        $request->validate([
            'sponsor.name' => 'required',
            'sponsor.type' => 'required',
        ]);

        $sponsor->fill($request->get('sponsor'))->save();
        $sponsor->events()->sync($request->input('sponsor.events', []));

        Toast::info('Sponsor saved.');
        return redirect()->route('platform.sponsors');
    }

    public function remove(Sponsor $sponsor)
    {
        $sponsor->delete();
        Toast::info('Sponsor removed.');
        return redirect()->route('platform.sponsors');
    }
}
