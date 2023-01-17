<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;

class Vue extends Model
{

    use HasFactory;
    use AsSource, Filterable, Attachable,Chartable;

    protected $table = 'vue_patient_entreprise';
}
