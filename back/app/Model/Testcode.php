<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Testcode extends Model
{
    protected $table = 'testcodes';

    protected $fillable = [
        'value', 'admin'
    ];
}
