<?php

namespace App\Orchid\Screens\Patient;

use App\Models\Consultation;
use App\Models\Patient;
use App\Models\resultat;
use App\Orchid\Layouts\Patient\DossierMedicalSLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class DossierMedicalScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name ;

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Tout information chronologique du patient';

    public $consultTotl;
    public $patient;
    public $patient_id;

    /**
     * Query data.
     *
     * @return array
     */
    public function query($id): array
    {
        $this->patient_id = $id;
        $tabConsults = [];
        $this->consultTotl = Consultation::where('id_patient',$this->patient_id)->count();
        $consult = Consultation::where('id_patient',$this->patient_id)->first();
        $this->patient = Patient::findOrfail($id);
        // dd($this->patient->nomComplet);
        $this->name = 'Dossier Medical du Patient'.' '. $this->patient->nomComplet;

        $consults = Consultation::where('id_patient',$this->patient_id)
                                ->orderBy('updated_at','ASC')->get();

        foreach ($consults as $key => $value) {
            // dd($value->ordonance->prescriptions);
            // dd($value->bon->resultats);
            $tabConsults['cons'.++$key.'tation'] = $value;
        }

        // for ($i=0; $i < $this->consultTotl; $i++) {
        //     $tabConsults["cons$i"."tations"] = Consultation::where('id_patient',$this->patient_id)->get()->toarray()[$i];
        // }
        // dd($tabConsults);
        // dd(Consultation::where('id_patient',$this->patient_id)->get()->toarray()[$this->patient_id]);
        return $tabConsults;
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
        $i=1;
        $tabConsults = Consultation::where('id_patient',$this->patient_id)
                                    ->orderBy('updated_at','DESC')->get();

            foreach ($tabConsults as $key => $value) {
                // $tabkey['cons'.++$key.'tation'] = $value;
                $tab[$i.". Consultation d' ".$value->formatDate()] = Layout::tabs([
                    'Medecin et Observetion' => Layout::rows([
                        Group::make([
                            Label::make('medecin')
                                ->title('Medecin:')
                                ->value($value->medecin->name),

                            TextArea::make('observations')
                                ->title('Observations')
                                ->value($value->observation)
                                ->rows(6),
                        ]),
                        Link::make('Voir les details')
                            ->type(Color::INFO())
                            ->route('platform.dossier.more',[
                                'id' => $value->id,
                            ])
                            ->icon('full-screen')
                    ]),
                    // 'Bon de Laboratoire' => Layout::table('cons'.$i.'tation.bon.resultats',[
                    //     TD::make('id','Nom examen')
                    //         ->render(function(resultat $resultat){
                    //             return $resultat->examen->nom;
                    //         }),
                    //         TD::make('decision')
                    //         ->render(function(resultat $resultat){
                    //             return $resultat->decision.' '.$resultat->examen->unite;
                    //         })
                    // ]),
                    // 'Ordonances' => Layout::table('cons'.$i.'tation.ordonance.prescriptions',[
                    //     TD::make('medicament'),
                    //     TD::make('prise'),
                    //     TD::make('quantite')
                    // ]),
                    // 'Actes démandés' => Layout::table('cons'.$i.'tation.actes',[
                    //     TD::make('nom',"Nom de l'acte")
                    // ]),
                ]);

                $i++;
            }
            // dd($tabConsults->first());
        if ($tabConsults->first()) {
            return [
                Layout::accordion($tab),
            ];
        } else {
            return [
                Layout::rows([
                    Group::make([
                        Label::make('medecin')
                            ->title('PAS DE CONSULTATION ENCORE ENREGISTRE POUR CE PATIENT.')
                            // ->value('eeeeeeeeeeeee'),
                    ]),
                ])
            ];
        }

    }

    public function asyncGetInfos(Consultation $consultation){

        // dd($consultation);
        return [
            'consultation' =>1
        ];
    }
}
