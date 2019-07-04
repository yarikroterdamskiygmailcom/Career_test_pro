<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LangBuffer extends Model
{
    protected $table = 'lang_buffer';
    protected $fillable = [
        'lang_id'
    ];
}
