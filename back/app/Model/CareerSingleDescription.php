<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CareerSingleDescription extends Model
{
    protected $table = 'careers_single_description';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'career_single_id', 'career', 'language_id'
    ];}
