<?php

namespace App\Orchid\Screens\Examen;

use App\Models\Examen;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class ExamenListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Examens';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'La liste des examens';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'examens' => Examen::all()
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Ajouter')
                ->icon('plus')
                ->route('platform.examen.create')
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
            Layout::table('examens',[
                TD::make('id_type','Type examen')
                    ->render(function($examen){
                        return $examen->type->nom;
                    }),
                TD::make('nom'),
                TD::make('tarif'),
                TD::make('unite'),
            ])
        ];
    }
}
