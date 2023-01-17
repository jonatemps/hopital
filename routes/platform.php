<?php

declare(strict_types=1);

use App\Orchid\Layouts\Entreprise\EntrepriseListLayout;
use App\Orchid\Layouts\Patient\PatientListLayout;
use App\Orchid\Layouts\Resultat\ResultatListLayout;
use App\Orchid\Screens\Acte\ActeEditScreen;
use App\Orchid\Screens\Acte\ActeListScreen;
use App\Orchid\Screens\Appointment\AppointmentEditScreen;
use App\Orchid\Screens\Appointment\AppointmentListScreen;
use App\Orchid\Screens\Charts\AgentChartsLayout;
use App\Orchid\Screens\Charts\ConsultationChartsScreen;
use App\Orchid\Screens\Charts\ExamenChartsScreen;
use App\Orchid\Screens\Charts\Patient\PatientChartsScreen;
use App\Orchid\Screens\Charts\Patient\PatientGenderScreen;
use App\Orchid\Screens\Charts\PatientChartsScreen as ChartsPatientChartsScreen;
use App\Orchid\Screens\Consultation\ConsultationEditScreen;
use App\Orchid\Screens\Consultation\ConsultationListScreen;
use App\Orchid\Screens\Entreprise\EntrepriseEditScreen;
use App\Orchid\Screens\Entreprise\EntrepriseListScreen;
use App\Orchid\Screens\Examen\ExamenEditScreen;
use App\Orchid\Screens\Examen\ExamenListScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\Patient\DossierMedicalMoreScreen;
use App\Orchid\Screens\Patient\DossierMedicalScreen;
use App\Orchid\Screens\Patient\PatientEditScreen;
use App\Orchid\Screens\Patient\PatientListScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Resultat\ResultatListScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\TypeExamen\TypeExamenEditScreen;
use App\Orchid\Screens\TypeExamen\TypeExamenListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Profile'), route('platform.profile'));
    });

// Platform > System > Users
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit');

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('Create'), route('platform.systems.users.create'));
    });

// Platform > System > Users > User
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Users'), route('platform.systems.users'));
    });

// Platform > System > Roles > Role
Route::screen('roles/{roles}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(function (Trail $trail, $role) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Role'), route('platform.systems.roles.edit', $role));
    });

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Create'), route('platform.systems.roles.create'));
    });

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Roles'), route('platform.systems.roles'));
    });

// Example...
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Example screen'));
    });

Route::screen('example-fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('example-layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('example-charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('example-editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('example-cards', ExampleCardsScreen::class)->name('platform.example.cards');
Route::screen('example-advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');

//Route::screen('idea', 'Idea::class','platform.screens.idea');

Route::screen('patients/list', PatientListScreen::class)->name('platform.patients.liste');
Route::screen('patient/create', PatientEditScreen::class)->name('platform.patient.create');

Route::screen('patient/dossier/{id}', DossierMedicalScreen::class)->name('platform.dossier.show');
Route::screen('patient/patient/{id}', DossierMedicalMoreScreen::class)->name('platform.dossier.more');

Route::screen('actes/list', ActeListScreen::class)->name('platform.actes.liste');
Route::screen('acte/create', ActeEditScreen::class)->name('platform.acte.create');

Route::screen('appointments/list', AppointmentListScreen::class)->name('platform.appointments.liste');
Route::screen('appointment/create', AppointmentEditScreen::class)->name('platform.appointment.create');
Route::screen('consultations/list', ConsultationListScreen::class)->name('platform.consultation.liste');
Route::screen('consultation/create/{id}', ConsultationEditScreen::class)->name('platform.consultation.create');
Route::screen('entreprises/list', EntrepriseListScreen::class)->name('platform.entreprises.liste');
Route::screen('entreprise/create', EntrepriseEditScreen::class)->name('platform.entreprise.create');
Route::screen('examens/list', ExamenListScreen::class)->name('platform.examens.liste');
Route::screen('examen/create', ExamenEditScreen::class)->name('platform.examen.create');
Route::screen('type-examen/list', TypeExamenListScreen::class)->name('platform.type_examen.liste');
Route::screen('type-examen/create', TypeExamenEditScreen::class)->name('platform.types_examens.create');
Route::screen('resultats/list', ResultatListScreen::class)->name('platform.resultats.liste');
Route::screen('Chart/pateit/gender', PatientGenderScreen::class)->name('platform.patient.gender');

// Charts
Route::screen('patient/chart', ChartsPatientChartsScreen::class)->name('platform.patient.chart');
Route::screen('Consultatoin/chart', ConsultationChartsScreen::class)->name('platform.consultation.chart');
Route::screen('examen/chart', ExamenChartsScreen::class)->name('platform.examen.chart');
Route::screen('agent/chart', AgentChartsLayout::class)->name('platform.agent.chart');







