<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'site';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    protected $with = ['site_description'];

    public function site_description()
    {
        return $this->hasOne('App\Model\SiteDescription', 'site_id');
    }
}
