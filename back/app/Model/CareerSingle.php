<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CareerSingle extends Model
{
    protected $table = 'careers_single';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'letter'
    ];
}
