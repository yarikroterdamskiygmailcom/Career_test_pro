<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $table = 'posts_categories';

    protected $with = 'posts_categories_description';

    public function posts_categories_description()
    {
        return $this->hasMany('App\Model\PostCategoryDescription');
    }
}
