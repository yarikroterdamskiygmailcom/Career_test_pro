<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'results';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'letter', 'level_id'
    ];

    /**
     * Get the result value record associated with the result id.
     */

    protected $with = ['result_description'];

    public function result_description()
    {
        return $this->hasOne('App\Model\ResultDescription');
    }
}
