<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ResultDescription extends Model
{
    protected $table = 'results_description';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'result_id', 'text', 'language_id'
    ];
}
