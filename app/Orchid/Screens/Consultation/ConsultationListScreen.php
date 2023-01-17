<?php

namespace App\Orchid\Screens\Consultation;

use App\Models\Consultation;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ConsultationListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Liste des consultations';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'La liste des consultations enregistées';

    public $permission = [
        'voirTous','platformSystemsConsultationAfficher','platformSystemsConsultationCréer'
    ];
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            "consultations" => Consultation::all()
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
                ->route('platform.consultation.create')
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
            Layout::table('consultations',[
                TD::make('id_patient','Patient')
                    ->render(function($consultation){
                        return $consultation->patient['nomComplet'];
                    }),
                TD::make('id_medecin','Medecin')
                    ->render(function($consultation){
                        return $consultation->medecin->name.' '.$consultation->medecin->postnom.' '.$consultation->medecin->prenom;
                    }),
                TD::make('updated_at','Date')
                    ->render(function($consultation){
                        return $consultation->formatDate();
                    }),

                TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Consultation $consultation) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Madifier'))
                                ->route('platform.consultations.liste', $consultation->id)
                                ->icon('pencil'),

                            Button::make(__('Supprimer'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__('Une fois la consultation supprimé, toutes ses ressources et ses données seront supprimées définitivement. Avant de supprimer la consultation, téléchargez les données ou informations que vous souhaitez conserver.'))
                                ->parameters([
                                    'id' => $consultation->id,
                                ]),
                        ]);
                }),

            ])
        ];
    }

    public function remove(Consultation $consultation){
        $consultation->remove();

        Toast::info('La consultation a été supprimée !');
    }
}
