<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Model\Language;
use App\Model\SiteDescription;
use App\Model\ReportBlockDescription;

use Validator;


class LanguagesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::all();
        return response()->json($languages, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'language' => 'required|string',
            'code'     => 'required|string',
            'status'   => 'required|integer|max:1',

        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 202);
        }

        $newLanguage = Language::updateOrCreate(
            ['language' => $request->language, 'code' => $request->code],
            ['language' => $request->language, 'code' => $request->code, 'status' => $request->status]
        );

        return $this->sendResponse($newLanguage, 'New language added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function exportCSV($id) {
        $siteContent = SiteDescription::where('language_id', $id)->get()->toArray();
        $csvFolder = public_path('export_csv');
        $siteOut = fopen($csvFolder.'/site.csv', 'w');
        foreach($siteContent as $row) {
            fputcsv($siteOut, $row, chr(9));
        }
        fclose($siteOut);

        $reportContent = ReportBlockDescription::where('language_id', $id)->get()->toArray();
        $csvFolder = public_path('export_csv');
        $reportOut = fopen($csvFolder.'/report.csv', 'w');
        foreach($reportContent as $row) {
            fputcsv($reportOut, $row, chr(9));
        }
        fclose($reportOut);
        $csvUrls['site']  = url('/export_csv/site.csv');
        $csvUrls['report'] = url('/export_csv/report.csv');
        return $this->sendResponse($csvUrls, 'CSV exported successfully.');
    }

    public function importCSV(Request $request, $id) {
        $siteFile = $request->file('import_site');
        $reportFile = $request->file('import_report');

        if($siteFile != '') {
            $destinationSite = storage_path('import_csv');
            $siteFile->move($destinationSite, $siteFile->getClientOriginalName());
            $siteData   = array_map(function($datas) { return str_getcsv($datas,"\t"); }, file($destinationSite.'/'.$siteFile->getClientOriginalName()));
            foreach($siteData as $siteRow) {
                //$inputs = ['site_id' => $row[1], 'value' => $row[2], 'language_id' => $id];
                //SiteDescription::create($inputs);
                $siteBlock = SiteDescription::updateOrCreate(
                    ['language_id' => $id, 'site_id' => $siteRow[1]],
                    ['value' => $siteRow[2], 'language_id' => $id, 'site_id' => $siteRow[1]]
                );
            }
        }

        if($reportFile != '') {
            $destinationReport = storage_path('import_csv');
            $reportFile->move($destinationReport, $reportFile->getClientOriginalName());
            $reportData   = array_map(function($datas) { return str_getcsv($datas,"\t"); }, file($destinationReport.'/'.$reportFile->getClientOriginalName()));
            foreach($reportData as $reportRow) {
                $reportBlock = ReportBlockDescription::updateOrCreate(
                    ['language_id' => $id, 'report_block_id' => $reportRow[1]],
                    ['value' => $reportRow[2], 'language_id' => $id, 'report_block_id' => $reportRow[1]]
                );
            }
        }

        return $this->sendResponse('', 'CSV imported successfully.');

    }
}
