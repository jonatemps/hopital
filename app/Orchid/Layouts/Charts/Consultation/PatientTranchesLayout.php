<?php

namespace App\Orchid\Layouts\Charts\Consultation;

use Orchid\Screen\Layouts\Chart;

class PatientTranchesLayout extends Chart
{
    /**
     * Add a title to the Chart.
     *
     * @var string
     */
    protected $title = "Consultation d'après le tranches d'âge";

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
        '#8D67D7',
        '#A7CED7',
        '#D7D258',
    ];
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the chart.
     *
     * @var string
     */
    protected $target = 'patientstranches';

    /**
     * Determines whether to display the export button.
     *
     * @var bool
     */
    protected $export = true;
}
