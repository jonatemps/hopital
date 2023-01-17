<?php

namespace App\Orchid\Screens\TypeExamen;

use App\Models\TypeExamen;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class TypeExamenListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = "Types d'Examen";

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = "La liste des types d'examen";

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'type_examens' => TypeExamen::all()
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Ajouter')
                ->icon('check')
                ->route('platform.types_examens.create')
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
            Layout::table('type_examens',[
                TD::make('nom'),
                TD::make('detail'),
                TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (TypeExamen $typeExamen) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Madifier'))
                                ->route('platform.patients.liste', $typeExamen->id)
                                ->icon('pencil'),

                            Button::make(__('Supprimer'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__('Une fois le type supprimé, toutes ses ressources et ses données seront supprimées définitivement. Avant de supprimer le type, téléchargez les données ou informations que vous souhaitez conserver.'))
                                ->parameters([
                                    'id' => $typeExamen->id,
                                ]),
                        ]);
                }),
            ])
        ];
    }

    public function remove(TypeExamen $typeExamen){
        $typeExamen->delete();

        Toast::info('Le type a été supprimé avec succes');

        return redirect()->route('platform.types_examens.liste');
    }
}
