<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReportBlockDescription extends Model
{
    protected $table = 'report_blocks_description';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'report_block_id', 'value', 'letter', 'language_id'
    ];
}
