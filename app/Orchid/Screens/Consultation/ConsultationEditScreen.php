<?php

namespace App\Orchid\Screens\Consultation;

use App\Models\Acte;
use App\Models\Appointment;
use App\Models\Bon;
use App\Models\Consultation;
use App\Models\Examen;
use App\Models\Ordonence;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\resultat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ConsultationEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Modifier une consultation';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Renseignez les champs pour Modifier une consultation';

    public $patinetNom = '';
    public $patinetId = 0;

    /**
     * Query data.
     *
     * @return array
     */
    public function query($id,Consultation $consultation): array
    {

        if (! $consultation->exists) {
            $this->name = 'creer une consultation';
            $this->description = 'Renseignez les champs pour creer une consultation';
        }

        $id ? $this->patinetNom = Patient::find($id)->nomComplet : '';
        $id ? $this->patinetId = $id : '';

        // dd($this->patinetNom);

        return [];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Sauvegarder')
                ->icon('check')
                ->method('save')
                ->parameters([
                    'id_patient' => $this->patinetId ?? 0
                ])
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
            Layout::rows([

                Group::make([

                    Select::make('id_patient')
                        ->empty($this->patinetNom,$this->patinetId)
                        ->title('Patient')
                        ->fromQuery(Patient::where('nomComplet',$this->patinetNom ?'==':'!=',$this->patinetNom), 'nomComplet', 'id'),

                    TextArea::make('observation')
                        ->title('Observations')
                        ->placeholder('Inserez y les symptômes et autres.')
                        ->rows(8),
                    Input::make('poids')
                        ->title('Poids')
                        ->placeholder('le poids du patient')
                        ->required(),
                ]),

                Input::make('id_medecin')
                        ->value(Auth::user()->id)
                        ->type('hidden'),
            ])->title('Patient et Observations'),


            Layout::block(
                layout::rows([
                    Group::make([
                        Select::make('actes')
                            ->title('Actes')
                            ->fromModel(Acte::class, 'nom', 'id')
                            ->multiple(),
                    ])
                ])
            )
                ->title('Actes sur le patient')
                ->description('Selectionnez les actes'),

            Layout::block(
                layout::rows([
                    Group::make([
                        Relation::make('examens')
                            ->title('Examen')
                            ->fromModel(Examen::class, 'nom', 'id')
                            ->displayAppend('full')
                            ->multiple(),
                        ])
                    ])
                )
                ->title('Examen sur le patient')
                ->description('Selectionnez les examens'),

            Layout::rows([
                Matrix::make('prescriptions')
                    ->columns([
                        'prescription',
                        'Pise',
                        'Quantité',
                    ]),
            ])->title('Prescription medicale'),
        ];
    }

    public function save($id_patient,Request $request,Consultation $consultation,Prescription $prescription){

        $actes = $request->input('actes');
        $examens = $request->input('examens');
        $prescriptions = $request->input('prescriptions');

        $this->validate($request,[
            'id_patient' => 'integer|min:1'
        ]);

        // dd($request);
        $consultation = $consultation->create([
            'id_patient' => $request->input('id_patient'),
            'id_medecin' => $request->input('id_medecin'),
            'observation' => $request->input('observation'),
            'poids' => $request->input('poids'),

        ]);

        if ($actes) {
            foreach ($actes as $acte) {
                DB::table('acte_consultation')->insert([
                    'id_acte' => $acte,
                    'id_consultation' => $consultation->id,
                ]);
            }
        }

        if ($examens) {
            $bon = Bon::create([
                'consultation_id' => $consultation->id
            ]);

            foreach ($examens as $examen) {
               resultat::create([
                   'id_bon' => $bon->id,
                   'id_examen' => $examen,
               ]);
            }
        }

        if ($prescriptions) {
            $ordo = Ordonence::create([
                'consultation_id' => $consultation->id
            ]);

            foreach ($prescriptions as $medicament) {

                  $prescription =  Prescription::create([
                        'id_ordo' => $ordo->id,
                        'medicament' => $medicament['prescription'],
                        'prise' => $medicament['Pise'],
                        'quantite' => $medicament['Quantité'],
                    ]);

            }
        }

        if ($id_patient) {
            $this->appoinrtement($id_patient);
        }
        // dd([
        //     'actes' => $request->input('actes'),
        //     'examens' => $request->input('examens'),
        //     'matrix' => $request->input('matrix'),
        // ]);

            Toast::info("La consultation a été enregistrée !");
            if ($id_patient) {

                return redirect()->route("platform.appointments.liste");

            } else {

                return redirect()->route("platform.consultations.liste");

            }


    }

    public function appoinrtement($id_patient){
        $appointment = Appointment::where('id_patient',$id_patient)
                                ->where('id_medecin',Auth::user()->id)
                                ->where('recu',null)
                                ->first();

        if ($appointment) {
            $appointment->update([
                'recu' => 1,
            ]);
        }
    }
}
