<?php

namespace App\Orchid\Layouts\Charts\Patient;

use Orchid\Screen\Layouts\Chart;

class PatientCoissanceLayout extends Chart
{
    /**
     * Add a title to the Chart.
     *
     * @var string
     */
    protected $title = 'La croissance des patients';

    protected $colors = [
        // '#00CC66',
        '#D7AA23',
        // '#0215D7',
        '#21D72B',
        // '#CB2ED7',
        // '#FFC901',
        '#7271FF',
        '#FF62E8'
    ];

    protected $lineOptions = [
        'spline'     => 1,
        'regionFill' => 1,
        'hideDots'   => 0,
        // 'hideLine'   => 0,
        'heatline'   =>1,
        'dotSize'    => 3,
    ];

    /**
     * Available options:
     * 'bar', 'line',
     * 'pie', 'percentage'.
     *
     * @var string
     */
    protected $type = 'line';
    protected $height = 300;

    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the chart.
     *
     * @var string
     */
    protected $target = 'patientsTranche';

    /**
     * Determines whether to display the export button.
     *
     * @var bool
     */
    protected $export = true;
}
