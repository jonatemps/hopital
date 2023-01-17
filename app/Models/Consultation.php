<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;


class Consultation extends Model
{
    use HasFactory;
    use AsSource;
    // protected $with = [
    //     'patient',
    //     'medecin',
    //     'ordonance',
    //     'actes',
    //     'bon'
    // ];

    protected $fillable = [
        'id_patient',
        'id_medecin',
        'observation',
        'poids'
    ];

    public function formatDate(){
        $date = $this->updated_at;
        return Carbon::parse($date)->diffForHumans();
    }

    public function actes(){
        return $this->belongsToMany(Acte::class,'acte_consultation','id_consultation','id_acte');
    }

    public function patient(){
        return $this->belongsTo(Patient::class,'id_patient');
    }

    public function medecin(){
        return $this->belongsTo(User::class,'id_medecin');
    }

    public function ordonance(){
        return $this->hasOne(Ordonence::class,'consultation_id') ;
    }

    // public function ordonance(){
    //     return $this->hasMany(Ordonence::class,'id_consultation');
    // }

    public function bon(){
        return $this->hasOne(Bon::class,'consultation_id');
    }
}
