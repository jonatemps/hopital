<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;


class Entreprise extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $fillable = [
        'nomComplet',
        'sigle',
    ];

    protected $allowedFilters = [
        'id',
        'nomComplet',
        'sigle',
        'created_at',
        'deleted_at',
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'nomComplet',
        'sigle',
        'created_at',
        'deleted_at',
    ];
}
