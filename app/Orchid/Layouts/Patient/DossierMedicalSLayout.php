<?php

namespace App\Orchid\Layouts\Patient;

use App\Models\resultat;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class DossierMedicalSLayout extends Rows
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
            Layout::view('platform::dummy.block'),


            // Layout::accordion([
            //     'Bon de Laboratoire' => Layout::table('consultation.bon.resultats',[
            //         TD::make('id','Nom examen')
            //             ->render(function(resultat $resultat){
            //                 return $resultat->examen->nom;
            //             }),
            //             TD::make('decision')
            //             ->render(function(resultat $resultat){
            //                 return $resultat->decision.' '.$resultat->examen->unite;
            //             })
            //     ]),
            //     'Ordonances' => Layout::table('consultation.ordonance.prescriptions',[
            //         TD::make('medicament'),
            //         TD::make('prise'),
            //         TD::make('quantite')
            //     ]),
            //     'Actes démandés' => Layout::table('consultation.actes',[
            //         TD::make('nom',"Nom de l'acte")
            //     ]),
            // ])
        ];
    }
}
