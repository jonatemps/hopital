<?php

namespace App\Orchid\Layouts\Charts\Patient;

use Orchid\Screen\Layouts\Chart;

class PatientTranceAgeLayout extends Chart
{
    /**
     * Add a title to the Chart.
     *
     * @var string
     */
    protected $title = "les Patients Par tranche D'âge";

    /**
     * Available options:
     * 'bar', 'line',
     * 'pie', 'percentage'.
     *
     * @var string
     */
    protected $type = 'pie';

    protected $height = 300;


    protected $colors = [
        '#54D0D7',
        '#D77847',
        '#8D67D7'
    ];
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the chart.
     *
     * @var string
     */
    protected $target = 'patientsTrancheAge';

    /**
     * Determines whether to display the export button.
     *
     * @var bool
     */
    protected $export = true;
}
