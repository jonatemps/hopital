<?php

namespace App\Orchid\Screens\Examen;

use App\Models\Examen;
use App\Models\TypeExamen;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ExamenEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Creer un examen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Remplisez les champs pour creer un examen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Examen $examen): array
    {
        if (! $examen->exists) {
            $this->name = "Modifier l'examen";
            $this->description = "Remplisez les champs pour modifier l'examen";

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
            Button::make('sauvegarder')
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
            Layout::columns([
                layout::rows([
                    Group::make([
                        Select::make('id_type')
                            ->title('Type examen')
                            ->fromModel(TypeExamen::class,'nom','id')
                            ->required(),
                        Input::make('nom')
                            ->title('Nom')
                            ->required()
                            ->placeholder("Saisisez le nom de l'examen."),
                    ]),
                    Group::make([
                        Input::make('unite')
                            ->title('Unité (Sigle)')
                            ->required()
                            ->placeholder("Saisisez l'unité ou signe de l'examen."),
                        Input::make('tarif')
                            ->title('Tarif')
                            ->required()
                            ->placeholder("Saisisez le tarif de l'examen."),
                    ])
                ])
            ])
        ];
    }

    public function save(Request $request){
        // dd($request->input());

        $this->validate($request,[
            'tarif' => 'numeric'
        ]);

        Examen::create([
            'id_type' => $request->input('id_type'),
            'nom' => $request->input('nom'),
            'unite' => $request->input('unite'),
            'tarif' => $request->input('tarif'),
        ]);

        Toast::info("L'examen a été enregistré avec succes!");

        return redirect()->route('platform.examens.liste');
    }
}
