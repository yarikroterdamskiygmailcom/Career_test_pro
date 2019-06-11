<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'title', 'body', 'language_id', 'meta_title', 'meta_description', 'meta_keywords', 'tags', 'image', 'category_id'
    ];

}
