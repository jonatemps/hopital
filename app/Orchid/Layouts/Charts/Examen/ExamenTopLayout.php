<?php

namespace App\Orchid\Layouts\Charts\Examen;

use Orchid\Screen\Layouts\Chart;

class ExamenTopLayout extends Chart
{
    /**
     * Add a title to the Chart.
     *
     * @var string
     */
    protected $title = "Examens les Plus Démandés";
    protected $height  = 300;

    /**
     * Available options:
     * 'bar', 'line',
     * 'pie', 'percentage'.
     *
     * @var string
     */
    protected $type = 'pie';

    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the chart.
     *
     * @var string
     */
    protected $target = 'examensTypeTop';

    /**
     * Determines whether to display the export button.
     *
     * @var bool
     */
    protected $export = true;
}
