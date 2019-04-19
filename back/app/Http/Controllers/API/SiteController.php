<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;

use App\Model\Site;
use App\Model\SiteDescription;

class SiteController extends BaseController
{
    public function siteBlocks(Request $request) {
        $languageId = $request->language_id;
        $getSiteBlocks = Site::with(['site_description' => function ($query) use ($languageId){
            return $query->where('language_id', $languageId);
        }])->get();
        return response()->json($getSiteBlocks, 200);

    }

    public function siteBlocksUpdate(Request $request, $id) {
        //return $request->all();
        $validator = Validator::make($request->all(), [
            'language_id' => 'required|numeric',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 202);
        }

        $siteBlock = SiteDescription::updateOrCreate(
             ['language_id' => $request->language_id, 'site_id' => $id],
             ['site_id' => $id, 'value' => $request->value, 'language_id' => $request->language_id]
        );

        return $this->sendResponse($siteBlock, 'Site block modified successfully.');
    }
}
