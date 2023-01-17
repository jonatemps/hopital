<?php

namespace App\Orchid\Layouts\Patient;

use App\Models\Patient;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PatientListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'patients';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('nomComplet','nomComplet')
                ->sort()
                ->filter(TD::FILTER_TEXT),
            TD::make('sexe', 'Sexe')
                ->sort()
                ->filter(TD::FILTER_TEXT),
            TD::make('telephone','telephone'),
            TD::make('agent','Agent')
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function($patient){
                    return $patient->agent->name;
                    }
                ),
            TD::make('dateNaissance','Naissance')
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function($patient){
                    return $patient->naissance();
                    }
                ),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Patient $patient) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Madifier'))
                                ->route('platform.patients.liste', $patient->id)
                                ->icon('pencil'),

                            Button::make(__('Supprimer'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__('Une fois le patient supprimé, toutes ses ressources et ses données seront supprimées définitivement. Avant de supprimer le patient, téléchargez les données ou informations que vous souhaitez conserver.'))
                                ->parameters([
                                    'id' => $patient->id,
                                ]),

                            Link::make(__('Dossier'))
                                ->route('platform.dossier.show',['id' =>  $patient->id])
                                ->icon('pencil'),
                        ]);
                }),
        ];
    }
}
