<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;


class Bon extends Model
{
    use HasFactory;
    use AsSource;

    protected $fillable = [
        'consultation_id'
    ];

    // protected $with = [
    //     'consultation',
    //     // 'resultats'
    // ];


    public function consultation(){
        return $this->belongsTo(Consultation::class,'consultation_id','id');
    }

    public function resultats(){
        return $this->hasMany(resultat::class,'id_bon');
    }

}
