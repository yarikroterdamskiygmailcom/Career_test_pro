<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $table = 'careers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'training', 'level', 'education'
    ];
}
