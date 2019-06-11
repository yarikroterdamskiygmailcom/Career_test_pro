<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostCategoryDescription extends Model
{
    protected $table = 'posts_categories_description';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'posts_category_id', 'name', 'description', 'language_id'
    ];
}
