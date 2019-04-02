<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReportBlock extends Model
{
    protected $table = 'report_blocks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    protected $with = ['report_block_description'];

    public function report_block_description()
    {
        return $this->hasOne('App\Model\ReportBlockDescription', 'report_block_id');
    }
}
