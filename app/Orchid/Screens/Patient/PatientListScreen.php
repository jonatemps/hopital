<?php

namespace App\Orchid\Screens\Patient;

use App\Models\Patient;
use App\Models\User;
use App\Orchid\Layouts\Patient\PatientListLayout;
use App\Orchid\Layouts\User\UserFiltersLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Toast;

class PatientListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Patients';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'La list des patient';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            // 'patients' => Patient::with('agent')
            //     ->filters()
            //     ->filtersApplySelection(UserFiltersLayout::class)
            //     ->defaultSort('id', 'desc')
            //     ->paginate(),

            'patients' => Patient::filters()
                // ->filtersApplySelection(UserFiltersLayout::class)
                ->defaultSort('id')
                ->paginate(),
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
            Link::make(__('Ajouter'))
                ->icon('plus')
                ->route('platform.patient.create'),
        ];;
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            PatientListLayout::class
        ];
    }

    public function savePatient(Patient $patient, Request $request): void
    {
        $request->validate([
            'patient.email' => 'required|unique:patients,email,'.$patient->id,
        ]);

        $patient->fill($request->input('patient'))
            ->save();

        Toast::info(__('Le patient a été enregistré.'));
    }

    /**
     * @param Request $request
     */
    public function remove(Request $request): void
    {
        Patient::findOrFail($request->get('id'))
            ->delete();

        Toast::info(__('Le patient a été supprimé.'));
    }
}
