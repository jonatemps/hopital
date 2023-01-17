<?php

namespace App\Orchid\Layouts\Consultation;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Facades\Layout;

class AddInfoLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        // dd('ok');
        return [
            Group::make([
                TextArea::make('bon.consultation.observation')
                        ->title('Observations')
                        ->placeholder('Inserez y les symptômes et autres.')
                        ->rows(8),
            ]),
            Group::make([
                Matrix::make('prescriptions')
                    ->columns([
                        'medicament',
                        'prise',
                        'quantite',
                    ])->title('Prescription medicale'),
            ]),

            // Layout::rows([
            //     Matrix::make('bon.consultation.ordonance.prescriptions')
            //         ->columns([
            //             'prescription',
            //             'Pise',
            //             'Quantité',
            //         ]),
            // ])->title('Prescription medicale'),
        ];
    }
}
