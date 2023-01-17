<?php

namespace App\Orchid\Layouts\Charts\Consultation;

use Orchid\Screen\Layouts\Chart;

class PatientGenreLayout extends Chart
{
    /**
     * Add a title to the Chart.
     *
     * @var string
     */
    protected $title = "Consultation d'après les genres";

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
        '#D7B3C6',
        '#D75CBF',
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
    protected $target = 'patientsGenres';

    /**
     * Determines whether to display the export button.
     *
     * @var bool
     */
    protected $export = true;
}
