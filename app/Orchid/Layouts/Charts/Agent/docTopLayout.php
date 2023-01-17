<?php

namespace App\Orchid\Layouts\Charts\Agent;

use Orchid\Screen\Layouts\Chart;

class docTopLayout extends Chart
{
    /**
     * Add a title to the Chart.
     *
     * @var string
     */
    protected $title = 'Top des agents en consultations';

    /**
     * Available options:
     * 'bar', 'line',
     * 'pie', 'percentage'.
     *
     * @var string
     */
    protected $type = 'bar';

    protected $colors = [
        '#4ED78B',
        '#D77433',
        '#A88BD7',
        '#D7CE54'
    ];

    protected $height = 400;
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the chart.
     *
     * @var string
     */
    protected $target = 'agentsTop';

    /**
     * Determines whether to display the export button.
     *
     * @var bool
     */
    protected $export = true;
}
