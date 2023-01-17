<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;

class VueAgentTop extends Model
{
    use HasFactory;
    use AsSource,Chartable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vue_aget_top_consultations';
}
