<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'price';

    protected $fillable = [
        'value', 'language_id', 'currency'
    ];
}
