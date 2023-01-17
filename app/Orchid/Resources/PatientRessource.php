<?php

namespace App\Orchid\Resources;

use App\Models\Entreprise;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class PatientRessource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = Patient::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    /**
 * Get the permission key for the resource.
 *
 * @return string|null
 */
// public static function permission(): ?string
// {
//     return 'private-post-resource';
// }


    public function fields(): array
    {
        return [
            // Layout::rows([

                Group::make([

                    Input::make('nomComplet')
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
                ]),

            // ])->title('Identité du patient'),

            // layout::rows([
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
                ]),

            // ])->title('Contacts du patient'),

            // Layout::rows([
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

            // ])->title('Autres informations'),
        ];
    }

    /**
     * Get the columns displayed by the resource.
     *
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id'),
            TD::make('nomComplet')
                ->sort()
                ->filter(TD::FILTER_TEXT),
            TD::make('created_at', 'Date of creation')
                ->render(function ($model) {
                    return $model->created_at->toDateTimeString();
                }),

            TD::make('updated_at', 'Update date')
                ->render(function ($model) {
                    return $model->updated_at->toDateTimeString();
                }),
        ];
    }

    /**
     * Get the sights displayed by the resource.
     *
     * @return Sight[]
     */
    public function legend(): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(): array
    {
        return [];
    }

//     public function onSave(ResourceRequest $request, Model $model)
// {
//     $model->forceFill($request->all())->save();
// }


}
