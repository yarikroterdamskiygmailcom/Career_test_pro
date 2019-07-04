<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LevelDescription extends Model
{
    protected $table = 'levels_description';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'level_id', 'name', 'language_id'
    ];
}
