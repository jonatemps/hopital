<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use App\Models\Service;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class UserEditLayout extends Rows
{
    /**
     * Views.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('user.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name')),

            Input::make('user.email')
                ->type('email')
                ->required()
                ->title(__('Email'))
                ->placeholder(__('Email')),
            Select::make('user.user_id')
                ->fromModel(Service::class, 'name', 'id')
                ->multiple()
                ->title(__('Service'))
                ->help('Spécifiez le service de l\'agent.'),
        ];
    }
}
