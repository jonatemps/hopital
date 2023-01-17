<?php

namespace App\Orchid\Layouts\Charts\Patient;

use Orchid\Screen\Layouts\Chart;

class PatientEntrepriseLayout extends Chart
{
    /**
     * Add a title to the Chart.
     *
     * @var string
     */
    protected $title = "Nos Patients d'après chaque Entreprise";

    /**
     * Available options:
     * 'bar', 'line',
     * 'pie', 'percentage'.
     *
     * @var string
     */
    protected $type = 'bar';

    protected $height = 300;

    protected $colors = [
        '#2274A5',
        '#F75C03',
        '#F1C40F',
        '#D90368',
        '#00CC66',
        '#D7AA23',
        '#0215D7',
        '#21D72B',
        '#CB2ED7',
        '#FFC901',
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
    protected $target = 'patientsEntreprise';

    /**
     * Determines whether to display the export button.
     *
     * @var bool
     */
    protected $export = true;
}
