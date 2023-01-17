<?php

namespace App\Orchid\Layouts\Charts\Patient;

use Orchid\Screen\Layouts\Chart;

class PatientCoissanceSexeLayout extends Chart
{
    /**
     * Add a title to the Chart.
     *
     * @var string
     */
    protected $title = 'La Croissance Par Sexe';

    /**
     * Available options:
     * 'bar', 'line',
     * 'pie', 'percentage'.
     *
     * @var string
     */
    protected $lineOptions = [
        'spline'     => 1,
        'regionFill' => 1,
        'hideDots'   => 0,
        // 'hideLine'   => 0,
        'heatline'   =>1,
        'dotSize'    => 3,
    ];

    /**
     * To highlight certain values on the Y axis, markers can be set.
     * They will shown as dashed lines on the graph.
     */
    // protected function markers(): ?array
    // {
    //     return [
    //         [
    //             'label'   => 'Medium',
    //             'value'   => 40,
    //         ],
    //     ];
    // }
    
    protected $type = 'line';
    protected $height = 300;

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

    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the chart.
     *
     * @var string
     */
    protected $target = 'patientsSexe';

    /**
     * Determines whether to display the export button.
     *
     * @var bool
     */
    protected $export = true;
}
