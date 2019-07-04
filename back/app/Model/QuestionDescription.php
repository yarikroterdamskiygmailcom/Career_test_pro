<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class QuestionDescription extends Model
{
    protected $table = 'questions_description';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question_id', 'question', 'language_id'
    ];
}
