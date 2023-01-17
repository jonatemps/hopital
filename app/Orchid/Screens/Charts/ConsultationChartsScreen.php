<?php

namespace App\Orchid\Screens\Charts;

use App\Models\Patient;
use App\Models\VueConsultation;
use App\Models\VueCosnEntreprise;
use App\Orchid\Layouts\Charts\Consultation\PatientEntrepriseLayout;
use App\Orchid\Layouts\Charts\Consultation\PatientGenreLayout;
use App\Orchid\Layouts\Charts\Consultation\PatientMedecinLayout;
use App\Orchid\Layouts\Charts\Consultation\PatientTranchesLayout;
use App\Orchid\Layouts\Charts\Patient\PatientConsultationLayout;
use Illuminate\Support\Facades\DB;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class ConsultationChartsScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Les statistiques des Consultations';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Les différents diagrames des Consultations';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'patientsConsEntreprise' => VueConsultation::countForGroup('entreprise')->toChart(),
            'patientsGenres' => VueConsultation::countForGroup('sexe')->toChart(),
            'patientstranches' => VueConsultation::countForGroup('statut')->toChart(),
            'patientsmedecin' => VueConsultation::countForGroup('medecin')->toChart(),

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
                PatientEntrepriseLayout::class,
            ]),
            Layout::columns([
                PatientTranchesLayout::class,
                PatientGenreLayout::class,
            ]),
            Layout::columns([
                PatientMedecinLayout::class
            ]),
        ];
    }
}
