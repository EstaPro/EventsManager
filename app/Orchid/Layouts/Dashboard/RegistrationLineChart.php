<?php

namespace App\Orchid\Layouts\Dashboard;

use Orchid\Screen\Layouts\Chart;

class RegistrationLineChart extends Chart
{
    /**
     * Add a title to the Chart to explain what it is.
     *
     * @var string
     */
    protected $title = 'Visitor Registrations (Last 14 Days)';

    /**
     * height of the chart.
     *
     * @var int
     */
    protected $height = 250;

    /**
     * Available options:
     * 'bar', 'line', 'pie', 'percentage', 'axis-mixed'
     *
     * @var string
     */
    protected $type = 'line';
}
