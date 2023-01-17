<?php

namespace App\Orchid\Screens\Entreprise;

use App\Models\Entreprise;
use App\Orchid\Layouts\Entreprise\EntrepriseListLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class EntrepriseListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Entreprises';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'La liste des entreprises';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'entreprises' => Entreprise::filters()->defaultSort('id')->paginate()
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
                ->icon('plus')
                ->route('platform.entreprise.create')

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
            EntrepriseListLayout::class,
        ];
    }

    public function remove(Entreprise $entreprise){
        $entreprise->delete();

        Toast::info("L'entreprise a été supprimée avec succes");

        return redirect()->route('platform.entreprises.liste');
    }
}
