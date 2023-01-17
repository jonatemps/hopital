<?php

namespace App\Orchid\Screens\Charts\Patient;

use App\Models\Patient;
use App\Models\User;
use App\Models\Vue;
use App\Models\VueCosnEntreprise;
use App\Models\VuePatient;
use App\Orchid\Layouts\Charts\Patient\PatientCoissanceLayout;
use App\Orchid\Layouts\Charts\Patient\PatientConsultationLayout;
use App\Orchid\Layouts\Charts\Patient\PatientEntrepriseLayout;
use App\Orchid\Layouts\Charts\Patient\PatientGenderLayout;
use App\Orchid\Layouts\Charts\Patient\PatientTranceAgeLayout;
use Illuminate\Support\Facades\DB;
use Orchid\Platform\Models\Role;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class PatientGenderScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Nos Patients';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Les différents diagrames du des Patients';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        // dd(Vue::countForGroup('nomComplet')->toChart());
        // dd(Patient::countForGroup('nomComplet')->toChart());
        return [
            'patientsGender' => Patient::countForGroup('sexe')->toChart(),
            // 'patientsEntreprise' => Patient::countForGroup('id_entreprise')->toChart(),
            'patientsEntreprise' => Vue::countForGroup('entreprise')->toChart(),
            'patientsConsEntreprise' => VueCosnEntreprise::countForGroup('entreprise')->toChart(),
            'patientsTrancheAge' => VuePatient::countForGroup('statut')->toChart(),
            'members' => [
                User::countByDays()->toChart('Users'),
                Role::countByDays()->toChart('Roles'),
                Patient::countByDays()->toChart('Patients'),
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
                PatientConsultationLayout::class,
                PatientCoissanceLayout::class
            ]),
            Layout::columns([
               PatientTranceAgeLayout::class,
               PatientEntrepriseLayout::class,
            ])
        ];
    }
}
