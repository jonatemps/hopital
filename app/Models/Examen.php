<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;


class Examen extends Model
{
    use HasFactory;
    use AsSource;

    protected $fillable =[
        'id_type',
        'nom',
        'unite',
        'tarif',
    ];

    public function type(){
        return  $this->belongsTo(TypeExamen::class,'id_type');
    }

    public function getFullAttribute(): string
    {
        return $this->attributes['nom'].' du type '.$this->type['nom'];
    }
}
