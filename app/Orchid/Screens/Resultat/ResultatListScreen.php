<?php

namespace App\Orchid\Screens\Resultat;

use App\Models\Bon;
use App\Models\resultat;
use App\Orchid\Layouts\Consultation\AddInfoLayout;
use App\Orchid\Layouts\Resultat\ResultatEditLayout;
use App\Orchid\Layouts\Resultat\ResultatListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ResultatListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Resultats';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'la liste des résultats';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        // dd(Bon::limit(5)->with('consultation.bon.consultation')->orderby('created_at','desc')->get());
        return [
            'resultats' => resultat::orderBy('created_at','DESC')->get()
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            ResultatListLayout::class,

            Layout::modal('oneAsyncModal', ResultatEditLayout::class)
                ->async('asyncGetResult'),
            Layout::modal('AddInfos', AddInfoLayout::class)
                ->async('asyncGetConsult'),
        ];
    }

    public function asyncGetResult(resultat $resultat): array
    {
        return [
            'resultat' => $resultat,
        ];
    }

    public function asyncGetConsult($id_bon): array
    {

        $bon = Bon::where('id',$id_bon)->with('consultation.ordonance')->first();

        dd($bon);
        return [
            'bon' => $bon,
        ];
    }

    public function saveResultat(resultat $resultat, Request $request): void
    {
        // $request->validate([
        //     'resultat.aquite' => 'boolean',
        // ]);

        $resultat->fill($request->input('resultat'))
            ->save();

        Toast::info(__("Le resultat a été modifié !"));
    }


    public function saveConsultation(resultat $resultat, Request $request): void
    {
        dd($request,$resultat);
        // $request->validate([
        //     'resultat.aquite' => 'boolean',
        // ]);

        $resultat->fill($request->input('resultat'))
            ->save();

        Toast::info(__("Le resultat a été modifié !"));
    }
}
