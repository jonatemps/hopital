<?php

namespace App\Orchid\Screens\Patient;

use App\Models\Chambre;
use App\Models\Entreprise;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Radio;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class PatientEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Modifier un patient';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Apporter des modificatins aux données du patient.';

    private $patient;
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Patient $patient): array
    {
        $this->patient = $patient;

        if (! $patient->exists) {
            $this->name = 'Creer un patient';
            $this->description = 'Renseigner les champs pour créer un nouveau patient.';
        }

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

            Button::make(__('Supprimer'))
                ->icon('trash')
                ->confirm(__('Une fois le patient supprimé, toutes ses ressources et ses données seront supprimées définitivement. Avant de supprimer le patient, téléchargez les données ou informations que vous souhaitez conserver.'))
                ->method('remove')
                ->canSee($this->patient->exists)->type(Color::PRIMARY()),

            Button::make(__('Sauvegarder'))
                ->icon('check')
                ->method('save')->type(Color::PRIMARY()),
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

                    Input::make('nomcomplet')
                        ->title('Nom complet')
                        ->placeholder('Entrez le nom complet.')
                        ->required(),

                    Select::make('sexe')
                        ->title('Sexe')
                        ->options([
                            'M' => 'Masculin',
                            'F' => 'Feminin'
                            ])
                            ->required(),
                ]),
                Group::make([
                    Input::make('dateNaissance')
                    ->type('date')
                    ->title('Date de naissance')
                    ->value('2011-08-19')
                    ->required(),

                    Select::make('groupeSanguin')
                        ->title('Groupe sanguin')
                        ->options([
                            'OO' => 'OO',
                            'AA' => 'AA',
                            'AO' => 'AO'
                            ])
                            ->required(),
                    Select::make('chambre_id')
                        ->title('Chambre')
                        ->fromModel(Chambre::class, 'code', 'id'),
                ]),

            ])->title('Identité du patient'),

            layout::rows([
                Group::make([
                    Input::make('adresse')
                        ->title('Adresse')
                        ->placeholder("Entrez l'adresse")
                        ->required(),

                    Input::make('telephone')
                        ->mask('(999) 999-999-999')
                        ->title('Telephone')
                        ->placeholder('Entrer le numero de telephone')
                        ->required(),
                ])

            ])->title('Contacts du patient'),

            layout::rows([
                Group::make([
                    Select::make('id_entreprise')
                        ->title('Entreprise')
                        ->fromModel(Entreprise::class, 'nomComplet', 'id'),

                    Input::make('matriculeAgent')
                    ->title("Matricule de l'agent")
                    ->placeholder("Entrez le matricule de l'agent auquel le patient est affilié."),
                ]),

                Input::make('id_agent')
                        ->value(Auth::user()->id)
                        ->type('hidden'),

            ])->title('Informations de prise en charge'),
        ];
    }

    public function save(Patient $patient, Request $request)
    {
        // dd($request->input());

        Patient::create([
            'id_agent' => $request->input('id_agent'),
            'id_entreprise' => $request->input('id_entreprise'),
            'nomComplet' => $request->input('nomcomplet'),
            'sexe' => $request->input('sexe'),
            'dateNaissance' => $request->input('dateNaissance'),
            'adresse' => $request->input('adresse'),
            'telephone' => $request->input('telephone'),
            'matriculeAgent' => $request->input('matriculeAgent'),
            'groupeSanguin' => $request->input('groupeSanguin'),
        ]);

        Toast::info(__('Le patient a été enregistré !'));

        return redirect()->route('platform.patients.liste');
    }

    /**
     * @param User $user
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Patient $patient)
    {
        $patient->delete();

        Toast::info(__('Le patient a été supprimé'));

        return redirect()->route('platform.systems.users');
    }
}
