<?php

namespace App\Orchid\Layouts\Appointment;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Listener;
use Orchid\Screen\Repository;
use Orchid\Support\Facades\Layout;

class AppointmentBookingListener extends Listener
{
    /**
     * The field that triggers the update.
     */
    protected $targets = [
        'appointment.company_select_id',
    ];

    /**
     * The Screen method to call.
     */
    protected $asyncMethod = 'asyncUpdateExhibitorList';

    public function handle(Repository $repository, Request $request): Repository
    {
        return $repository;
    }

    protected function layouts(): iterable
    {
        // Get the list passed from the Screen, or empty default
        $exhibitorOptions = $this->query->get('exhibitors_list', []);

        return [
            Layout::rows([
                // 1. VISITOR
                Relation::make('appointment.booker_id')
                    ->title('Select Visitor')
                    ->fromModel(User::class, 'name')
                    ->applyScope('visitors')
                    ->searchColumns('name', 'email')
                    ->required()
                    ->help('The person requesting the meeting.'),

                // 2. COMPANY (The Trigger)
                Relation::make('appointment.company_select_id')
                    ->title('Select Company')
                    ->fromModel(Company::class, 'name')
                    ->required()
                    ->help('Select this first to see the team list.'),

                // 3. TEAM MEMBER (Dynamic)
                Select::make('appointment.target_user_id')
                    ->title('Select Exhibitor Team Member')
                    ->options($exhibitorOptions) // Populated dynamically
                    ->empty('← Please select a company above')
                    ->required(),

                // 4. OTHER FIELDS
                DateTimer::make('appointment.scheduled_at')
                    ->title('Date & Time')
                    ->enableTime()
                    ->format24hr()
                    ->required(),

                Input::make('appointment.table_location')
                    ->title('Location')
                    ->placeholder('e.g. Booth B12'),

                TextArea::make('appointment.notes')
                    ->title('Notes')
                    ->rows(2),
            ]),
        ];
    }
}
