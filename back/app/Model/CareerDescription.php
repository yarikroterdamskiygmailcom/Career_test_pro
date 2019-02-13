<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CareerDescription extends Model
{
    protected $table = 'careers_description';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'career_id', 'career', 'language_id'
    ];
}
