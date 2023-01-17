<?php

namespace App\Orchid\Screens\Charts;

use App\Models\User;
use App\Models\VueAgent;
use App\Models\VueAgentTop;
use App\Orchid\Layouts\Charts\Agent\AgentGenreLayout;
use App\Orchid\Layouts\Charts\Agent\AgentRoleLayout;
use App\Orchid\Layouts\Charts\Agent\docTopLayout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class AgentChartsLayout extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Les Statistique Des Agents';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Les Différents Diagrames Des Agents';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'agentsRoles' => VueAgent::countForGroup('role')->toChart(),
            'agentsGenres' => User::countForGroup('sexe')->toChart(),
            'agentsTop' => VueAgentTop::countForGroup('agent')->toChart(),
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        // dd(VueAgent::countForGroup('role')->toChart());
        return [

        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::columns([
                AgentRoleLayout::class,
                AgentGenreLayout::class
            ]),
            Layout::columns([
                docTopLayout::class
            ]),
        ];
    }
}
