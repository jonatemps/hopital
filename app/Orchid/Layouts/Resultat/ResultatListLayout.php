<?php

namespace App\Orchid\Layouts\Resultat;

use App\Models\resultat;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ResultatListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'resultats';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [

            TD::make('Patient')
            ->render(function (resultat $resultat) {
                // dd($resultat);
                return ModalToggle::make($resultat->bon->consultation->patient['nomComplet'])
                    ->modal('AddInfos')
                    ->modalTitle($resultat->bon->consultation->patient['nomComplet'])
                    ->method('saveConsultation')
                    // ->confirm('Voulez vous modifier ?')
                    ->asyncParameters([
                        'id_bon' => $resultat->id_bon,
                    ]);
                // return $resultat->decision ? '<i class="text-success">●</i>'.' '.$resultat->decision.' '.$resultat->examen['unite'] : '<i class="text-danger">●</i> Vide';

            }),

            TD::make('Date')
                ->render(function($resultat){
                    // dd($resultat->examen->id);
                    return $resultat->formatDate();
                }),

            TD::make('Examen')
                ->render(function($resultat){
                    // dd($resultat->examen->id);
                    return $resultat->examen['nom'];
                }),

            TD::make('Resultat')
                ->render(function (resultat $resultat) {
                    return ModalToggle::make($resultat->decision ? $resultat->decision.' ('.$resultat->examen['unite'].')' : 'Vide')
                        ->modal('oneAsyncModal')
                        ->modalTitle($resultat->bon->consultation->patient['nomComplet'])
                        ->method('saveResultat')
                        // ->confirm('Voulez vous modifier ?')
                        ->asyncParameters([
                            'resultat' => $resultat->id,
                        ]);
                    // return $resultat->decision ? '<i class="text-success">●</i>'.' '.$resultat->decision.' '.$resultat->examen['unite'] : '<i class="text-danger">●</i> Vide';

                }),

            TD::make('Aquité')
                ->render(function($resultat){
                    // dd($resultat->examen->id);
                    return $resultat->aquite == 1 ? '<i class="text-success">●</i> Aquité' : '<i class="text-danger">●</i> Non Aquité';
                })


        ];
    }

    // public  function saveResultat(){
    //     dd('okkkkkkkkkkk');
    // }

}
