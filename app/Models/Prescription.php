<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Prescription extends Model
{
    use HasFactory;
    use AsSource;

    protected $fillable = [
        'id_ordo',
        'medicament',
        'prise',
        'quantite',
    ];
}
