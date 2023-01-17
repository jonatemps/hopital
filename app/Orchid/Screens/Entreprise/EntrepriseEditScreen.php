<?php

namespace App\Orchid\Screens\Entreprise;

use App\Models\Entreprise;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class EntrepriseEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'EntrepriseEditScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'EntrepriseEditScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
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
                ->method('save'),
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
            Layout::columns([
                layout::rows([
                    Group::make([
                        Input::make('nomComplet')
                            ->title('Nom Complet')
                            ->required()
                            ->placeholder("Saisisez le nom de l'entreprise."),
                        Input::make('sigle')
                            ->title('Sigle')
                            ->required()
                            ->placeholder("Saisisez le sigle de l'entreprise."),
                    ])
                ])
            ])
        ];
    }

    public function save(Request $request){
        // dd($request->input());*

        Entreprise::create([
            'nomComplet' => $request->input('nomComplet'),
            'sigle' => $request->input('sigle'),
        ]);

        Toast::info(__("L'entreprise a été enregistrée avec succes !"));

        return redirect()->route('platform.entreprises.liste');
    }
}
