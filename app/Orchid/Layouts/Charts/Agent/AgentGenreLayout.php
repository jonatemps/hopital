<?php

namespace App\Orchid\Layouts\Charts\Agent;

use Orchid\Screen\Layouts\Chart;

class AgentGenreLayout extends Chart
{
    /**
     * Add a title to the Chart.
     *
     * @var string
     */
    protected $title = 'Super Chart';

    /**
     * Available options:
     * 'bar', 'line',
     * 'pie', 'percentage'.
     *
     * @var string
     */
    protected $type = 'pie';
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
    protected $target = 'agentsGenres';

    /**
     * Determines whether to display the export button.
     *
     * @var bool
     */
    protected $export = true;
}
