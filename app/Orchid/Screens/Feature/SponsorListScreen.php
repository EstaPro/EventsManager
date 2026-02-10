<?php

namespace App\Orchid\Screens\Feature;

use App\Models\Sponsor;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;

class SponsorListScreen extends Screen
{
    public $name = 'Sponsors & Partners';
    public $description = 'Manage logos on home page.';

    public function query(): array
    {
        return ['sponsors' => Sponsor::paginate()];
    }

    public function commandBar(): array
    {
        return [
            ModalToggle::make('Add Sponsor')
                ->modal('sponsorModal')
                ->method('createOrUpdate')
                ->icon('plus'),
        ];
    }

    public function layout(): array
    {
        return [
            Layout::table('sponsors', [
                TD::make('logo', 'Logo')->render(fn($s) =>
                $s->logo ? "<img src='{$s->logo}' width='50'>" : ''),
                TD::make('name', 'Name'),
                TD::make('category_type', 'Category'),
                TD::make('Actions')->render(fn($s) =>
                ModalToggle::make('Edit')
                    ->modal('sponsorModal')
                    ->method('createOrUpdate')
                    ->asyncParameters(['sponsor' => $s->id])
                )
            ]),

            Layout::modal('sponsorModal', Layout::rows([
                Input::make('sponsor.id')->type('hidden'),
                Input::make('sponsor.name')->title('Name')->required(),
                Input::make('sponsor.logo')->title('Logo URL'),
                Input::make('sponsor.website')->title('Website'),

                Select::make('sponsor.category_type')
                    ->options([
                        'platinum' => 'Platinum Sponsor',
                        'gold' => 'Gold Sponsor',
                        'institutional' => 'Institutional Partner',
                        'media' => 'Media Partner',
                    ])
                    ->title('Category')
                    ->required(),
            ]))->async('asyncGetSponsor')
        ];
    }

    public function asyncGetSponsor(Sponsor $sponsor): array
    {
        return ['sponsor' => $sponsor];
    }

    public function createOrUpdate(Request $request)
    {
        Sponsor::updateOrCreate(
            ['id' => $request->input('sponsor.id')],
            $request->input('sponsor')
        );
        Toast::info('Sponsor saved.');
    }
}
