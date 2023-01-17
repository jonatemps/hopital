<?php

namespace App\Orchid\Screens\Appointment;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class AppointmentEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Creer un Rendez-vous';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Creez un nouveau rendez-vous entre medecin et patient';

    public $permission = [
        'voirTous','gererRendezVous'
    ];

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
                    Relation::make('id_medecin')
                            ->title('Medecin')
                            ->fromModel(User::class,'name','id')
                            ->displayAppend('full')
                            ->required(),

                    Relation::make('id_patient')
                        ->title('Patient')
                        ->fromModel(Patient::class,'nomComplet','id')
                        ->displayAppend('full')
                        ->required(),
                ])
            ])
        ];
    }

    public function save(Appointment $appointment,Request $request){

        $appointment->fill($request->input())->save();

        Toast::info('Le rendez-vous a été enregistré avec succes !');

        return redirect()->route('platform.appointments.liste');
    }
}
