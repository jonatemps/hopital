<?php

namespace App\Orchid\Screens\Charts;

use App\Models\Consultation;
use App\Models\Examen;
use App\Models\VueExamen;
use App\Models\VueExamenTop;
use App\Models\VueExamRent;
use App\Orchid\Layouts\Charts\Examen\ExamenRentLayout;
use App\Orchid\Layouts\Charts\Examen\ExamenTopLayout;
use App\Orchid\Layouts\Charts\Examen\ExamenTypeLayout;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Orchid\Screen\Screen;

class ExamenChartsScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = "Les Graphiques d'examens Efféctués.";

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Les Différentes Graphiques des examens.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        // dd(Consultation::limit(5)->orderby('created_at','desc')->get());
        $exams = VueExamenTop::distinct()->get('nom');
        // dd($exams);
        foreach ($exams as $key => $value) {
            // dd();
           $tab[$key] = VueExamenTop::where('nom',$value->nom)->countByDays()->toChart("$value->nom");
        }
        // dd($tab);
        // dd(VueExamenTop::distinct()->get());
        // for ($i=0; $i < $exams->count(); $i++) {
        //     $data[$i] = VueExamRent::all()[$i]->countByDays()->toChart('Vieillard');
        // }

        return [
            'examensType' => VueExamen::countForGroup('type')->toChart(),
            'examensTypeTop' => VueExamenTop::countForGroup('nom')->toChart(),
            'examensRentTop' => $tab,
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
            ExamenTypeLayout::class,
            ExamenTopLayout::class,
            ExamenRentLayout::class
        ];
    }
}
