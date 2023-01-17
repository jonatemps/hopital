<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;


class Patient extends Model
{
    use HasFactory,Chartable,AsSource,Filterable, Attachable;

    public function vieillard(){
        $date = $this->dateNaissance;
        return Carbon::parse($date)->shortAbsoluteDiffForHumans() >= 75 ;
    }

    public function adulte(){
        $date = $this->dateNaissance;
        return (Carbon::parse($date)->shortAbsoluteDiffForHumans() >18 && Carbon::parse($date)->shortAbsoluteDiffForHumans() < 75);
    }
    public function enfant(){
        $date = $this->dateNaissance;
        return Carbon::parse($date)->shortAbsoluteDiffForHumans() < 18;
    }

    protected $fillable = [
        'id_agent',
        'id_entreprise',
        'nomComplet',
        'sexe',
        'dateNaissance',
        'adresse',
        'telephone',
        'matriculeAgent',
        'groupeSanguin',
    ];

    protected $allowedFilters = [
        'id',
        'id_agent',
        'id_entreprise',
        'nomComplet',
        'sexe',
        'dateNaissance',
        'adresse',
        'telephone',
        'matriculeAgent',
        'groupeSanguin',
        'created_at',
        'deleted_at',
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'id_agent',
        'id_entreprise',
        'nomComplet',
        'sexe',
        'dateNaissance',
        'adresse',
        'telephone',
        'matriculeAgent',
        'groupeSanguin',
        'created_at',
        'deleted_at',
    ];

    protected $with = [
        'agent',
        'entreprise',
    ];
    public function naissance(){
        $date = $this->dateNaissance;
        return Carbon::parse($date)->diffForHumans();
    }


    public function agent(){
        return $this->belongsTo(User::class,'id_agent');
    }

    public function entreprise(){
        return $this->belongsTo(Entreprise::class,'id_agent');
    }

    public function getFullAttribute(): string
    {
        return $this->attributes['nomComplet'];
    }
}
