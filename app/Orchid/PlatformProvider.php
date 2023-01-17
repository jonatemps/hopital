<?php

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
            // Menu::make('Example screen')
            //     ->icon('monitor')
            //     ->route('platform.example')
            //     ->title('Navigation')
            //     ->badge(function () {
            //         return 6;
            //     }),

            // Menu::make('Dropdown menu')
            //     ->icon('code')
            //     ->list([
            //         Menu::make('Sub element item 1')->icon('bag'),
            //         Menu::make('Sub element item 2')->icon('heart'),
            //     ]),

            // Menu::make('Basic Elements')
            //     ->title('Form controls')
            //     ->icon('note')
            //     ->route('platform.example.fields'),

            // Menu::make('Advanced Elements')
            //     ->icon('briefcase')
            //     ->route('platform.example.advanced'),

            // Menu::make('Text Editors')
            //     ->icon('list')
            //     ->route('platform.example.editors'),

            // Menu::make('Overview layouts')
            //     ->title('Layouts')
            //     ->icon('layers')
            //     ->route('platform.example.layouts'),

            // Menu::make('Chart tools')
            //     ->icon('bar-chart')
            //     ->route('platform.example.charts'),

            // Menu::make('Cards')
            //     ->icon('grid')
            //     ->route('platform.example.cards')
            //     ->divider(),

            // Menu::make('Documentation')
            //     ->title('Docs')
            //     ->icon('docs')
            //     ->url('https://orchid.software/en/docs'),

            // Menu::make('Changelog')
            //     ->icon('shuffle')
            //     ->url('https://github.com/orchidsoftware/platform/blob/master/CHANGELOG.md')
            //     ->target('_blank')
            //     ->badge(function () {
            //         return Dashboard::version();
            //     }, Color::DARK()),

            Menu::make(__('Les Patient Par genre'))
                ->icon('user')
                ->route('platform.patient.gender')
                ->permission('gererPatient')
                ->title(__('Les Graphiques'))
                ->divider(),

            Menu::make(__('Charts agent'))
                ->icon('chart')
                ->route('platform.agent.chart')
                ->title(__('Les Graphiques')),
            Menu::make(__('Charts Patient'))
                ->icon('chart')
                ->route('platform.patient.chart'),
            Menu::make(__('Charts Consultation'))
                ->icon('chart')
                ->route('platform.consultation.chart'),
            Menu::make(__('Charts Examen'))
                ->icon('chart')
                ->route('platform.examen.chart')
                ->divider(),

            Menu::make(__('Les Patients'))
                ->icon('people')
                ->route('platform.patients.liste')
                ->permission('gererPatient')
                ->title(__('Gestion des Patients')),

            Menu::make(__('Les Rendez-vous'))
                ->icon('calendar')
                ->route('platform.appointments.liste')
                ->permission('gererRendezVous')
                ->title(__('Gestion des Rendez-vous')),

            Menu::make(__('Les Actes'))
                ->icon('list')
                ->route('platform.actes.liste')
                ->permission('gererActe')
                ->title(__('Gestion des Actes medicaux')),

            Menu::make(__('Les Entreprises'))
                ->icon('briefcase')
                ->route('platform.entreprises.liste')
                ->permission('gererEntreprise')
                ->title(__('Gestion des Entreprises')),

            Menu::make(__('Les Examens'))
                ->icon('chemistry')
                ->route('platform.examens.liste')
                ->permission('gererExamen')
                ->title(__('Gestion des Examens')),

            Menu::make(__("Les Types d'examen"))
                ->icon('number-list')
                ->route('platform.type_examen.liste')
                ->permission('gererExamen'),

            Menu::make(__('Les Résultats'))
                ->icon('note')
                ->route('platform.resultats.liste')
                ->permission('gererExamen'),

            Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access rights')),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }

    /**
     * @return string[]
     */
    public function registerSearchModels(): array
    {
        return [
            // ...Models
            // \App\Models\User::class
        ];
    }
}
