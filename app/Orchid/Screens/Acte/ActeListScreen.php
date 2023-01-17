<?php

namespace App\Orchid\Screens\Acte;

use App\Models\Acte;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class ActeListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Actes';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'La liste des actes medicaux';


    public $permission = [
        'voirTous','gererActe'
    ];
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'actes' => Acte::all()
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
                ->route('platform.acte.create')
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
            Layout::table('actes',[
                TD::make('nom','Nom'),
                TD::make('tarif','Tarif'),
                TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Acte $acte) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Madifier'))
                                ->route('platform.patients.liste', $acte->id)
                                ->icon('pencil'),

                            Button::make(__('Supprimer'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__('Une fois le type supprimé, toutes ses ressources et ses données seront supprimées définitivement. Avant de supprimer le type, téléchargez les données ou informations que vous souhaitez conserver.'))
                                ->parameters([
                                    'id' => $acte->id,
                                ]),
                        ]);
                }),

            ])
        ];
    }
}
