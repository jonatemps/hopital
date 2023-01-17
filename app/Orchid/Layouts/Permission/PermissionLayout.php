<?php

namespace App\Orchid\Layouts\Permission;

use App\Models\Permission;
use App\Models\User;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class PermissionLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {

        $permissions = Permission::all();
        $tabChekBox = [];
        $i=1;
        foreach ($permissions as $permission => $value) {

            // dd($value->purview);
            $check = CheckBox::make($value->purview)
                ->sendTrueOrFalse()
                ->placeholder($value->name);


            // dd($check);
            $tabChekBox[$i] = $check;

            $i++;
        }

        // dd($tabChekBox);

        return [Group::make($tabChekBox)];

        // return [
        //     // Select::make('permis')
        //     //     ->fromModel(Permission::class, 'name','id')
        //     //     ->multiple()
        //     //     ->title('Choisisez les permissions du rôle.')
        //     Group::make([
        //         CheckBox::make('free')
        //         ->value(1)
        //         ->sendTrueOrFalse()
        //         ->placeholder('dormir')
        //         ,

        //     CheckBox::make('free')
        //         ->value(1)
        //         ->sendTrueOrFalse()
        //         ->placeholder('reveil')
        //         ,

        //     CheckBox::make('free')
        //         ->value(1)
        //         ->sendTrueOrFalse()
        //         ->placeholder('partir')

        //     ])
        // ];
    }
}
