<?php

namespace App\Orchid\Screens\Patient;

use App\Models\Consultation;
use App\Models\resultat;
use Illuminate\Cache\RateLimiting\Limit;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNan;

class DossierMedicalMoreScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name;

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Consultation du patient en une date donnée';
    public $consultation;
    /**
     * Query data.
     *
     * @return array
     */
    public function query($consultation_id): array
    {
        // dd($consultation->with([
        //     'medecin',
        //     'bon.resultats',
        //     'ordonance.prescriptions',
        //     'actes',
        // ])->Limit(5)->get());
        $this->consultation = Consultation::with([
            'medecin',
            'bon.resultats',
            'ordonance.prescriptions',
            'actes',
        ])->find($consultation_id);
        // dd($this->consultation);
        $this->name = "Consultation d' ".$this->consultation->formatDate().' de ( '.$this->consultation->patient->nomComplet.' )';

        return [
            'consultation' => $this->consultation
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
            Link::make('Les consultations')
                    ->icon('check')
                    ->type(Color::WARNING())
                    ->route('platform.dossier.show',['id' => $this->consultation->id_patient])
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        // dd($this->consultation->ordonance);

        if ($this->consultation->ordonance && $this->consultation->bon->count()) {
            return [
                Layout::tabs([
                    'Medecin et Observetion' => Layout::rows([
                        Group::make([
                            Label::make('consultation.medecin.name')
                                ->title('Medecin:'),

                            Label::make('consultation.observation')
                                ->title('Observations')
                                ->rows(6),
                        ]),
                    ]),
                    'Bon de Laboratoire' => Layout::table('consultation.bon.resultats',[
                        TD::make('id','Nom examen')
                            ->render(function(resultat $resultat){
                                return $resultat->examen->nom;
                            }),
                            TD::make('decision')
                            ->render(function(resultat $resultat){
                                return $resultat->decision.' =>'.$resultat->examen->unite;
                            })
                    ]),
                    'Ordonances' => Layout::table('consultation.ordonance.prescriptions',[
                        TD::make('medicament'),
                        TD::make('prise'),
                        TD::make('quantite')
                    ]),
                    'Actes démandés' => Layout::table('consultation.actes',[
                        TD::make('nom',"Nom de l'acte")
                    ]),
                ]),
            ];
        } else {
            return [
                Layout::tabs([
                    'Medecin et Observetion' => Layout::rows([
                        Group::make([
                            Label::make('consultation.medecin.name')
                                ->title('Medecin:'),

                            Label::make('consultation.observation')
                                ->title('Observations')
                                ->rows(6),
                        ]),
                    ]),
                    'Actes démandés' => Layout::table('consultation.actes',[
                        TD::make('nom',"Nom de l'acte")
                    ]),
                ]),
            ];
        }

    }
}
