<?php

namespace App\Orchid\Layouts\Appointment;

use App\Models\Company;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\DateRange;
use Orchid\Screen\Fields\Relation;

class AppointmentSelection extends Selection
{
    public function filters(): iterable
    {
        return [
            // Filter 1: Search Text
            'search' => Input::make('search')
                ->title('Search')
                ->placeholder('Name or Location...'),

            // Filter 2: Status
            'status' => Select::make('status')
                ->title('Status')
                ->options([
                    'pending' => 'Pending',
                    'confirmed' => 'Confirmed',
                    'cancelled' => 'Cancelled',
                ])
                ->empty('All'),

            // Filter 3: Company
            'company_id' => Relation::make('company_id')
                ->title('Company')
                ->fromModel(Company::class, 'name')
                ->empty('All Companies'),

            // Filter 4: Date
            'scheduled_at' => DateRange::make('scheduled_at')
                ->title('Date Range'),
        ];
    }
}
