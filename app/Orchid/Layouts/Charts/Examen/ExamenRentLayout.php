<?php

namespace App\Orchid\Layouts\Charts\Examen;

use Orchid\Screen\Layouts\Chart;

class ExamenRentLayout extends Chart
{
    /**
     * Add a title to the Chart.
     *
     * @var string
     */
    protected $title = 'Evolution Des examens les Plus Démandés';

    /**
     * Available options:
     * 'bar', 'line',
     * 'pie', 'percentage'.
     *
     * @var string
     */
    protected $type = 'line';
    protected $height  = 300;

    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the chart.
     *
     * @var string
     */
    protected $target = 'examensRentTop';

    /**
     * Determines whether to display the export button.
     *
     * @var bool
     */
    protected $export = true;
}
