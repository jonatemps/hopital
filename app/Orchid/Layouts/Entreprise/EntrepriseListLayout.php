<?php

namespace App\Orchid\Layouts\Entreprise;

use App\Models\Entreprise;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class EntrepriseListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'entreprises';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('nomComplet','Nom complet')
                ->sort()
                ->filter(TD::FILTER_TEXT),
            TD::make('sigle','Sigle')
                ->sort()
                ->filter(TD::FILTER_TEXT),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Entreprise $entreprise) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Madifier'))
                                ->route('platform.patients.liste', $entreprise->id)
                                ->icon('pencil'),

                            Button::make(__('Supprimer'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__("Une fois l'entreprise supprimé, toutes ses ressources et ses données seront supprimées définitivement. Avant de supprimer l'entreprise, téléchargez les données ou informations que vous souhaitez conserver."))
                                ->parameters([
                                    'id' => $entreprise->id,
                                ]),
                        ]);
                }),

        ];
    }
}
