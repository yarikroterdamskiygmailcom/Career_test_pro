<?php

namespace App\Http\Controllers\API;

use App\CategoryDescription;
use App\Model\Question;
use App\Model\QuestionDescription;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;


class QuestionsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $languageId = $request->language_id;
        $getCategories = CategoryDescription::select('category_id', 'name')->where('language_id', $languageId)->get();
        $getQuestions = Question::with(['questions_description' => function($query) use ($languageId) {
            return $query->where('language_id', $languageId);
        }])->get();

        return response()->json([ 'questions' => $getQuestions, 'categories' => $getCategories], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string',
            'language_id' => 'required|numeric',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 202);
        }

        $question = QuestionDescription::updateOrCreate(
            ['language_id' => $request->language_id, 'question_id' => $id],
            ['question_id' => $request->id, 'question' => $request->question, 'language_id' => $request->language_id]
        );
        return $this->sendResponse('Success', 'Question modified successfully.');
    }
}
