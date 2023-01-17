<?php

namespace App\Orchid\Screens\Resultat;

use Orchid\Screen\Screen;

class ResultatEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Les Résultat';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Modifiez les resultats';

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
