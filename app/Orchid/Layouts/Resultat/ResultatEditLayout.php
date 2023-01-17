<?php

namespace App\Orchid\Layouts\Resultat;

use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class ResultatEditLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        return [

            Input::make('resultat.bon.consultation.patient.nomComplet')
                ->type('text')
                ->max(255)
                ->disabled()
                ->title(__('Nom du patient'))
                ->placeholder(__('nom du patient')),

            Input::make("resultat.examen.nom")
                ->type('text')
                ->max(255)
                ->disabled()
                ->title(__('Examen démandé'))
                ->placeholder(__('Examen démandé')),

            Input::make('resultat.examen.tarif')
                ->type('text')
                ->max(255)
                ->disabled()
                ->title(__("Tarif de l'examen"))
                ->placeholder(__("tarif de l'examen")),

            Input::make('resultat.decision')
                ->type('text')
                ->max(255)
                ->disabled(!Auth::user()->inRole('laborantin'))
                ->title(__('Decison'))
                ->placeholder(__('Decision'))
                ->help('Decision après examen'),

            CheckBox::make('resultat.aquite')
                ->title('Aquité')
                ->sendTrueOrFalse()
                ->disabled(!Auth::user()->inRole('caissier'))
                ->placeholder('Si le client a payé')
                ->help('Cohez la case en cas de solvabilité du client.')
        ];
    }
}
