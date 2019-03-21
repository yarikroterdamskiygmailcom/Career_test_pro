<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $with = 'categories_description';

    public function categories_description()
    {
        return $this->hasOne('App\CategoryDescription');
    }
}
