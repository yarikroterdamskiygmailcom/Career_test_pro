<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Model\Metatag;

class MetatagsController extends BaseController
{
    public function index(Request $request) {
        $languageId = $request->language_id;
        $getTags = Metatag::where('language_id', $languageId)->get();
        return response()->json($getTags, 200);
    }

    public function getPage($id) {
        $page = Metatag::where('id', $id)->first();
        return response()->json($page, 200);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'language_id' => 'required|numeric',
            'page_alias' => 'required|string'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 202);
        }
        $newTags = Metatag::create($request->all());

        return $this->sendResponse($newTags, 'New metatags created successfully.');
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'page_alias' => 'required|string'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 202);
        }

        $metatags = Metatag::where('id', $id)->update($request->all());
        return $this->sendResponse('Success', 'Metatags modified successfully.');
    }

    public function destroy($id) {
        Metatag::where('id', $id)->delete();
        return $this->sendResponse('Success', 'Metatags deleted successfully.');
    }



}
