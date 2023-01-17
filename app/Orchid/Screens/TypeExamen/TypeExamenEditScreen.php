<?php

namespace App\Orchid\Screens\TypeExamen;

use App\Models\TypeExamen;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class TypeExamenEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Modifier type examen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = "Modifier le type d'examen";

    private $typeExamen;
    /**
     * Query data.
     *
     * @return array
     */
    public function query(TypeExamen $typeExamen): array
    {
        $this->typeExamen = $typeExamen;

        if (! $typeExamen->exists) {
            $this->name = 'Creer type Examen';
            $this->description = "Creer le type d'examen";
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
                        Input::make('nom')
                            ->title('Nom')
                            ->required()
                            ->placeholder("Saisisez le nom du type."),
                        Input::make('detail')
                            ->title('Detail')
                            ->required()
                            ->placeholder("Saisisez le detail du type."),
                    ])
                ])
            ])
        ];
    }

    public function save(Request $request){
        TypeExamen::create([
            'nom' => $request->input('nom'),
            'detail' => $request->input('detail'),
        ]);

        Toast::info('Le type a été sauvegardé avec succes !');

        return redirect()->route('platform.types_examens.liste');
    }
}
