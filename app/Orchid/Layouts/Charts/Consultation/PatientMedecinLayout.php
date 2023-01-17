<?php

namespace App\Orchid\Layouts\Charts\Consultation;

use Orchid\Screen\Layouts\Chart;

class PatientMedecinLayout extends Chart
{
    /**
     * Add a title to the Chart.
     *
     * @var string
     */
    protected $title = 'Consultation Par Medecin';

    /**
     * Available options:
     * 'bar', 'line',
     * 'pie', 'percentage'.
     *
     * @var string
     */
    protected $type = 'bar';

    protected $height = 400;

    protected $colors = [
        '#4ED78B',
        '#D77433',
        '#A88BD7',
        '#D7CE54'
    ];
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the chart.
     *
     * @var string
     */
    protected $target = 'patientsmedecin';

    /**
     * Determines whether to display the export button.
     *
     * @var bool
     */
    protected $export = true;
}
