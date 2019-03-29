<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Model\Result;
use App\Model\ResultDescription;


class ReportController extends BaseController
{
    public function scoreText(Request $request)
    {
        $languageId = $request->language_id;

        $getScoreText = Result::with(['result_description' => function ($query) use ($languageId){
            return $query->where('language_id', $languageId);
        }])->get();
        return response()->json($getScoreText, 200);

    }

    public function scoreTextUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required|string',
            'result_id' => 'required|numeric',
            'language_id' => 'required|numeric',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 202);
        }

        $scoreText = ResultDescription::updateOrCreate(
            ['language_id' => $request->language_id, 'result_id' => $id],
            ['result_id' => $id, 'text' => $request->text, 'language_id' => $request->language_id]
        );
        return $this->sendResponse($scoreText, 'Score text modified successfully.');
    }


}
