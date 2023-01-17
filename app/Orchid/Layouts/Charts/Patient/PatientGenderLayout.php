<?php

namespace App\Orchid\Layouts\Charts\Patient;

use Orchid\Screen\Layouts\Chart;

class PatientGenderLayout extends Chart
{
    /**
     * Add a title to the Chart.
     *
     * @var string
     */
    protected $title = 'Nos Patient Par Genre';

    /**
     * Available options:
     * 'bar', 'line',
     * 'pie', 'percentage'.
     *
     * @var string
     */
    protected $type = 'pie';

    protected $height = 300;
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the chart.
     *
     * @var string
     */
    protected $target = 'patientsGender';

    /**
     * Determines whether to display the export button.
     *
     * @var bool
     */
    protected $export = true;
}
