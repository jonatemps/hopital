<?php

namespace App\Orchid\Layouts\Charts\Consultation;

use Orchid\Screen\Layouts\Chart;

class PatientEntrepriseLayout extends Chart
{
   /**
     * Add a title to the Chart.
     *
     * @var string
     */
    protected $title = 'Les consulations des patients pour chaque entreprise';

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
    protected $target = 'patientsConsEntreprise';

    /**
     * Determines whether to display the export button.
     *
     * @var bool
     */
    protected $export = true;
}
