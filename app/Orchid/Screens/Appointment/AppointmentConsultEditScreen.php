<?php

namespace App\Orchid\Screens\Appointment;

use Orchid\Screen\Screen;
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
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class AppointmentConsultEditScreen extends Screen
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
    public $appointmentId;


    /**
     * Query data.
     *
     * @return array
     */
    public function query($id_patient,$id_appointment,Consultation $consultation): array
    {
        // dd($id_patient,$id_appointment);
        $this->appointmentId = $id_appointment;

        if (! $consultation->exists) {
            $this->name = 'creer une consultation';
            $this->description = 'Renseignez les champs pour creer une consultation';
        }
        $this->appointmentId = $id_appointment;
        $id_patient ? $this->patinetNom = Patient::find($id_patient)->nomComplet : '';
        $id_patient ? $this->patinetId = $id_patient : '';

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
                        Select::make('examens')
                            ->title('Examen')
                            ->fromModel(Examen::class, 'nom', 'id')
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

    public function bd(Request $request,Consultation $consultation){
        dd('ffff');
    }

    public function save(Request $request,Consultation $consultation,Prescription $prescription){

        dd('og');

        dd([
            'actes' => $request->input('actes'),
            'examens' => $request->input('examens'),
            'prescriptions' => $request->input('prescriptions'),
        ]);

        if ($this->appointmentId) {
            dd('og');
            $app = $this->saveAppointment($this->appointmentId);
            dd($app);
        }

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
        ]);

        foreach ($actes as $acte) {
            DB::table('acte_consultation')->insert([
                'id_acte' => $acte,
                'id_consultation' => $consultation->id,
            ]);
        }

        if ($examens) {
            $bon = Bon::create([
                'id_consultation' => $consultation->id
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
                'id_consultation' => $consultation->id
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


        // dd([
        //     'actes' => $request->input('actes'),
        //     'examens' => $request->input('examens'),
        //     'matrix' => $request->input('matrix'),
        // ]);

            Toast::info("La consultation a été enregistrée !");

            return redirect()->route("platform.consultations.liste");
    }

    public function saveAppointment(Appointment $appointment){
        $appointment->fill($this->appointmentId)->save();
    }

}
