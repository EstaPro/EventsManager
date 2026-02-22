<?php

namespace App\Orchid\Layouts\Dashboard;

use Orchid\Screen\Layouts\Chart;

class RegistrationLineChart extends Chart
{
    /**
     * Add a title to the Chart to explain what it is.
     */
    protected $title = 'Visitor Registrations (Last 14 Days)';

    /**
     * height of the chart.
     */
    protected $height = 250;

    /**
     * Available options:
     * 'bar', 'line', 'pie', 'percentage', 'axis-mixed'
     */
    protected $type = 'line';
}
