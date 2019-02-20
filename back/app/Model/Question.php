<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'letter'
    ];

    protected $with = 'questions_description';

    public function questions_description() {
        return $this->hasOne('App\Model\QuestionDescription');
    }
}
