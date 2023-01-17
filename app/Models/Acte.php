<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;


class Acte extends Model
{
    use HasFactory;
    use AsSource;

    protected $fillable = [
        'nom',
        'tarif',
    ];

    public function consultations(){
        return $this->belongsToMany(Consultation::class);
    }
}
