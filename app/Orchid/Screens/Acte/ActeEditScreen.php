<?php

namespace App\Orchid\Screens\Acte;

use App\Models\Acte;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ActeEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Modifier Acte';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = "Remplisez les champs pour Modifier l'acte";

    public $permission = [
        'voirTous','gererActe'
    ];
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Acte $acte): array
    {
        if (! $acte->exists) {
            $this->name = 'Creer Acte';
            $this->description = "Remplisez les champs pour Creer l'acte";
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
            Button::make('Sauvegarder')
                ->icon('check')
                ->method('save')
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
                    Input::make('nom')
                        ->title('Nom')
                        ->required(),
                    Input::make('tarif')
                        ->title('Tarif')
                        ->required(),
                ])
            ])
        ];
    }


    public function save(Acte $acte, Request $request){
        $this->validate($request,[
            'tarif' => 'numeric'
        ]);

        $acte->fill($request->input())->save();

        Toast::info('Acte sauvegardé avec succes !');

        return redirect()->route('platform.actes.liste');
    }
}
