<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReportDescription extends Model
{
    protected $table = 'report_description';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'report_id', 'value', 'language_id'
    ];
}
