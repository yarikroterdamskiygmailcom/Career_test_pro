<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Metatag extends Model
{
    protected $table = 'metatags';

    protected $fillable = [
        'page_alias', 'meta_data', 'meta_keywords', 'meta_title', 'language_id'
    ];
}
