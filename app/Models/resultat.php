<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Orchid\Screen\AsSource;

class resultat extends Model
{
    use HasFactory;
    use AsSource;


    protected $fillable = [
        'id_bon',
        'id_examen',
        'decision',
        'aquite',
    ];

    protected $with = [
        'bon',
        'examen'
    ];

    public function formatDate(){
        $date = $this->created_at;
        return Carbon::parse($date)->diffForHumans();
    }

    public function bon(){
        return $this->belongsTo(Bon::class,'id_bon','id');
    }
    // public function bon(){
    //     return $this->belongsTo(Bon::class,'id_bon');
    // }

    public function examen(){
        return $this->belongsTo(Examen::class,'id_examen');
    }


}
