<?php

namespace App\Orchid\Screens\Appointment;

use App\Models\Appointment;
use App\Models\User;
use App\Orchid\Screens\User\UserListScreen;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class AppointmentListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Les Rendez-vous';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'La liste des rendez-vous entre medecins et patients';

    public $permission = [
        'voirTous','gererRendezVous'
    ];

    public $doctors;
    public $data;
    public $accordion;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
       if (Auth::user()->inRole('administrateur')) {
           $appointments =  Appointment::filters()
                            ->defaultSort('id')
                            ->paginate();
       } else {
           $appointments = Appointment::where('id_medecin',Auth::user()->id)
           ->filters()
           ->defaultSort('id')
                           ->paginate();
       }




        return [
            // 'users' =>User::all(),
            'appointments' => $appointments
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
                ->route('platform.appointment.create')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return[
            Layout::table('appointments',[
                TD::make('id_patient','Patient')
                    ->sort()
                    ->filter(TD::FILTER_TEXT)
                    ->render(function($appointment){
                        // dd($appointment);
                        return $appointment->patient->nomComplet;
                    }),

                TD::make('id_medecin','Medecin')
                    ->sort()
                    ->filter(TD::FILTER_TEXT)
                    ->render(function($appointment){
                        return $appointment->medecin->name;
                    }),

                TD::make('updated_at','Date')
                    ->sort()
                    ->render(function($appointment){
                        return $appointment->formatDate();
                    }),

                TD::make('recu','Reçu ?')
                    ->sort()
                    ->render(function($appointment){
                        return $appointment->recu == 1 ? '<i class="text-success">●</i> Déjà' : '<i class="text-danger">●</i> Pas encore';
                    }),

                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(function (Appointment $appointment) {
                        return DropDown::make()
                            ->icon('options-vertical')
                            ->list([

                                Link::make(__('Consulter'))
                                    ->route('platform.consultation.create', $appointment->id_patient)
                                    ->icon('pencil')
                                    ->canSee(Auth::user()->id == $appointment->id_medecin),

                                Button::make(__('Supprimer'))
                                    ->icon('trash')
                                    ->method('remove')
                                    ->canSee(Auth::user()->id == $appointment->id_medecin)
                                    ->confirm(__('Une fois le type supprimé, toutes ses ressources et ses données seront supprimées définitivement. Avant de supprimer le type, téléchargez les données ou informations que vous souhaitez conserver.'))
                                    ->parameters([
                                        'id' => $appointment->id,
                                    ]),
                            ]);
                    }),
            ])
                ];
    }

    public function remove(Appointment $appointment)
    {
        $appointment->delete();

        Toast::info('Le rendez-vous a été enregistré avec succes !');

        return redirect()->route('platform.appointments.liste');
    }
}
