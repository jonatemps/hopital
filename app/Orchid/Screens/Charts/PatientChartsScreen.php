<?php

namespace App\Orchid\Screens\Charts;

use App\Models\Patient;
use App\Models\Vue;
use App\Models\VueCosnEntreprise;
use App\Models\VuePatient;
use App\Orchid\Layouts\Charts\Patient\PatientCoissanceLayout;
use App\Orchid\Layouts\Charts\Patient\PatientCoissanceSexeLayout;
use App\Orchid\Layouts\Charts\Patient\PatientConsultationLayout;
use App\Orchid\Layouts\Charts\Patient\PatientEntrepriseLayout;
use App\Orchid\Layouts\Charts\Patient\PatientGenderLayout;
use App\Orchid\Layouts\Charts\Patient\PatientSanguinLayout;
use App\Orchid\Layouts\Charts\Patient\PatientTranceAgeLayout;
use Illuminate\Support\Facades\DB;
use Orchid\Crud\CrudServiceProvider;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class PatientChartsScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Les statistiques des Patients';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Les différents diagrames des Patients';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        // dd(Patient::select(DB::raw("count(*)"))->whereRaw('substring(now(),1,4)-substring(dateNaissance,1,4) >= 75')->get());
        return [
            'patientsGender' => VuePatient::countForGroup('sexe')->toChart(),
            // 'patientsEntreprise' => Patient::countForGroup('id_entreprise')->toChart(),
            'patientsEntreprise' => Vue::countForGroup('entreprise')->toChart(),
            'patientsTrancheAge' => VuePatient::countForGroup('statut')->toChart(),
            'patientsSanguin' => VuePatient::countForGroup('groupeSanguin')->toChart(),
            'patientsTranche' => [
                            Patient::select(DB::raw("count(*)"))
                                                            ->whereRaw('substring(now(),1,4)-substring(dateNaissance,1,4) >= 75')
                                                            ->countByDays()->toChart('Vieillard'),
                            Patient::select(DB::raw("count(*)"))
                                                        ->whereRaw('substring(now(),1,4)-substring(dateNaissance,1,4) >= 18 AND substring(now(),1,4)-substring(dateNaissance,1,4) < 75')
                                                        ->countByDays()->toChart('Adulte'),

                            Patient::select(DB::raw("count(*)"))
                                                ->whereRaw('substring(now(),1,4)-substring(dateNaissance,1,4) < 18')
                                                ->countByDays()->toChart('Enfant'),
            ],
            'patientsSexe' => [
                Patient::select(DB::raw("count(*)"))
                                                ->where('sexe','M')
                                                ->countByDays()->toChart('Masculin'),
                Patient::select(DB::raw("count(*)"))
                                            ->where('sexe','F')
                                            ->countByDays()->toChart('Feminin'),
                ]
        ];
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
        return [
            Layout::columns([
                PatientGenderLayout::class,
                PatientTranceAgeLayout::class
            ]),
            Layout::columns([
                // PatientConsultationLayout::class,
                // PatientCoissanceSexeLayout::class,
                PatientCoissanceLayout::class
            ]),
            Layout::columns([
                // PatientConsultationLayout::class,
                PatientSanguinLayout::class
                // PatientCoissanceLayout::class
            ]),
            Layout::columns([
                PatientCoissanceSexeLayout::class,
            ]),
            Layout::columns([
               PatientEntrepriseLayout::class,
            ])
        ];
    }
}
