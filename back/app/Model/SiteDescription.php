<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SiteDescription extends Model
{
    protected $table = 'site_description';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'site_id', 'value', 'language_id'
    ];
}
