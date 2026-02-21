<?php

namespace App\Orchid\Screens\Feature;

use App\Models\AwardCategory;
use App\Models\AwardNominee;
use App\Models\Company;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;

class AwardListScreen extends Screen
{
    public $name = 'HCE Awards Management';
    public $description = 'Manage Categories and Nominees.';

    public function query(): array
    {
        return [
            'categories' => AwardCategory::with('nominees')->get(),
            'nominees' => AwardNominee::with('company')->paginate()
        ];
    }

    public function commandBar(): array
    {
        return [
            ModalToggle::make('Add Category')
                ->modal('categoryModal')
                ->method('saveCategory')
                ->icon('list'),

            ModalToggle::make('Add Nominee')
                ->modal('nomineeModal')
                ->method('saveNominee')
                ->icon('trophy'),
        ];
    }

    public function layout(): array
    {
        return [
            Layout::table('nominees', [
                TD::make('product_name', 'Product Name'),
                TD::make('company.name', 'Company')->render(fn($n) => $n->company->name ?? 'N/A'),
                TD::make('category.name', 'Category')->render(fn($n) => $n->category->name ?? '-'),
                TD::make('is_winner', 'Winner')->render(fn($n) => $n->is_winner ? '🏆 WINNER' : ''),

                TD::make('Actions')->render(fn($n) =>
                ModalToggle::make('Edit')
                    ->modal('nomineeModal')
                    ->method('saveNominee')
                    ->asyncParameters(['nominee' => $n->id])
                )
            ])->title('Current Nominees'),

            // Modals
            Layout::modal('categoryModal', Layout::rows([
                Input::make('category.name')->title('Category Name')->required(),
                Input::make('category.description')->title('Description'),
            ])),

            Layout::modal('nomineeModal', Layout::rows([
                Input::make('nominee.id')->type('hidden'),

                Relation::make('nominee.award_category_id')
                    ->fromModel(AwardCategory::class, 'name')
                    ->title('Category')
                    ->required(),

                Relation::make('nominee.company_id')
                    ->fromModel(Company::class, 'name')
                    ->title('Company'),

                Input::make('nominee.product_name')->title('Product Name'),
                Input::make('nominee.image')->title('Image URL'),

                CheckBox::make('nominee.is_winner')
                    ->title('Is this the Winner?')
                    ->sendTrueOrFalse(),
            ]))->async('asyncGetNominee')
        ];
    }

    public function asyncGetNominee(AwardNominee $nominee): array
    {
        return ['nominee' => $nominee];
    }

    public function saveCategory(Request $request)
    {
        AwardCategory::create($request->input('category'));
        Toast::info('Category created');
    }

    public function saveNominee(Request $request)
    {
        AwardNominee::updateOrCreate(
            ['id' => $request->input('nominee.id')],
            $request->input('nominee')
        );
        Toast::info('Nominee saved');
    }
}
