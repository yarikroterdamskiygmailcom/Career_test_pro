<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryDescription extends Model
{
    protected $table = 'categories_description';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'name', 'description', 'language_id'
    ];
}
