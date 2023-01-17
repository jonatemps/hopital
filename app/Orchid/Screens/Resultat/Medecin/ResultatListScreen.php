<?php

namespace App\Orchid\Screens\Resultat\Medecin;

use Orchid\Screen\Screen;

class ResultatListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'ResultatListScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'ResultatListScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [];
    }
}
