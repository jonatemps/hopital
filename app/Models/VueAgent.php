<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;

class VueAgent extends Model
{
    use HasFactory;
    use AsSource, Filterable, Attachable,Chartable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vue_agent';
}
