<?php

namespace App\Orchid\Layouts\Appointment;

use App\Orchid\Filters\StatusFilter;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;
use Orchid\Screen\Fields\Input;

class AppointmentFiltersLayout extends Selection
{
    public function filters(): iterable
    {
        return [
            StatusFilter::class,
        ];
    }

    // This allows adding a simple text search input alongside filters
    public function template(): string
    {
        return self::TEMPLATE_SELECTION;
    }
}
