<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;


class Ordonence extends Model
{
    use HasFactory;
    use AsSource;

    protected $fillable = [
        'consultation_id'
    ];

    protected $with = [
        'prescriptions',
        // 'consultation'
    ];

    public function prescriptions(){
        return $this->hasMany(Prescription::class,'id_ordo');
    }

    public function consultation(){
        return $this->belongsTo(Consultation::class);
    }
}
