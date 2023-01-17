<?php

namespace App\Orchid\Layouts\Charts\Agent;

use Orchid\Screen\Layouts\Chart;

class AgentRoleLayout extends Chart
{
    /**
     * Add a title to the Chart.
     *
     * @var string
     */
    protected $title = "Les Agents D'après Les rôles";

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
    protected $target = 'agentsRoles';
    protected $colors = [
        '#4ED78B',
        '#D77433',
        '#A88BD7',
        '#D7CE54'
    ];
    /**
     * Determines whether to display the export button.
     *
     * @var bool
     */
    protected $export = true;

}
