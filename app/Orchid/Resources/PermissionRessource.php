<?php

namespace App\Orchid\Resources;

use App\Models\Permission;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class PermissionRessource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = Permission::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Group::make([
                Input::make('name','Nom')
                    ->title('Nom')
                    ->placeholder('Le nom de la premision')
                    ->help('Saisisez le nom de la permission. EX: Users'),
                Input::make('purview','Portée')
                    ->title('Portée')
                    ->placeholder('La portée de la premision')
                    ->help('Saisisez la portée de la permission. EX: platform.systems.users'),
            ])
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

            TD::make('name', 'Nom de la permission')
                ->render(function ($model) {
                    return $model->name;
                }),

            TD::make('purview', 'La portée')
                ->render(function ($model) {
                    return $model->purview;
                }),

            TD::make('updated_at', 'Date de mise à jour')
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
}
