<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Appointment extends Model
{
    use HasFactory;
    use AsSource, Filterable, Attachable;

    protected $fillable = ['id_medecin','id_patient','recu'];

    protected $with = ['patient','medecin'];

    protected $allowedFilters = [
        'id',
        'id_medecin',
        'id_patient',
        'recu',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'id_medecin',
        'id_patient',
        'recu',
        'created_at',
        'updated_at',
    ];

    public function formatDate(){
        $date = $this->updated_at;
        return Carbon::parse($date)->diffForHumans();
    }

    public function patient(){
        return $this->belongsTo(Patient::class,'id_patient','id');
    }

    public function medecin(){
        return $this->belongsTo(User::class,'id_medecin','id');
    }
}
