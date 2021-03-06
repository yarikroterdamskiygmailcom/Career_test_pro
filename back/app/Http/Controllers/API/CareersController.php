<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Model\Career;
use App\Model\CareerDescription;


class CareersController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $languageId = $request->language_id;
        $getCareers = Career::with(['career_description' => function($query) use ($languageId) {
            return $query->where('language_id', $languageId);
        }])->orderBy('id', 'DESC')->paginate(100);
        return response()->json($getCareers, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string',
            'training' => 'required|string',
            'level' => 'required|string',
            'education' => 'required|numeric',
            'career' => 'required|string',
            'language_id' => 'required|numeric',

        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 202);
        }
        $careerData = ['code' => $request->code, 'training' => $request->training, 'level' => $request->level, 'education' => $request->education];
        $newCareer = Career::create($careerData);

        $newCareerDescription = ['career_id' => $newCareer->id, 'career' => $request->career, 'language_id' => $request->language_id];
        CareerDescription::create($newCareerDescription);
        $careerTotal['code'] = $request->code;
        $careerTotal['training'] = $request->training;
        $careerTotal['level'] = $request->level;
        $careerTotal['education'] = $request->education;
        $careerTotal['career_id'] = $newCareer->id;
        $careerTotal['career_description']['career'] = $request->career;
        $careerTotal['language_id'] = $request->language_id;
        return $this->sendResponse($careerTotal, 'Career added successfully.');

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
            'career' => 'required|string',
            'language_id' => 'required|numeric',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 202);
        }

        $career = CareerDescription::updateOrCreate(
            ['language_id' => $request->language_id, 'career_id' => $id],
            ['career_id' => $id, 'career' => $request->career, 'language_id' => $request->language_id]
        );
        return $this->sendResponse($career, 'Career modified successfully.');
    }
}
