<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Customer;
use App\Model\Result;
use App\Model\Career;


use Carbon\Carbon;

class PdfController extends Controller
{

    public function getResultText($categoryId, $letter, $letterValue, $languageId = '1') {
        if($letterValue >= 0 &&  $letterValue < 10) {
            $level = 1;
        } elseif($letterValue >= 10 &&  $letterValue < 25) {
            $level = 2;
        } elseif($letterValue >= 25 &&  $letterValue < 40) {
            $level = 3;
        } elseif($letterValue >= 40 &&  $letterValue < 60) {
            $level = 4;
        } elseif($letterValue >= 60 &&  $letterValue < 75) {
            $level = 5;
        } elseif($letterValue >= 75 &&  $letterValue < 90) {
            $level = 6;
        } elseif($letterValue >= 90 &&  $letterValue <= 100) {
            $level = 7;
        }
        dd($letterValue);
        $getResults = Result::whereHas('result_description', function ($query) use ($categoryId, $letter, $languageId, $level) {
            return $query->where('language_id', $languageId)
                         ->where('category_id', $categoryId)
                         ->where('level_id', $level)
                         ->where('letter', $letter);
        })->first();
        $search = ['&#39;', '&nbsp;'];
        $replace = ['\'', " "];
        return str_replace($search, $replace, $getResults['result_description']->text);
    }

    public function getProfessions($lettersCombination, $languageId = '1') {
//        $getCareers = Career::whereHas('career_description', function ($query) use ($lettersCombination, $languageId) {
//            return $query->where('language_id', 1)
//                         ->where('code', $lettersCombination);
//        })->get();
        $getCareers = Career::with(['career_description' => function ($query) use ($languageId) {
            return $query->where('language_id', $languageId);
        }])->where('code', $lettersCombination)->get();
        return $getCareers->toArray();
    }

    public function pdfCr(Request $request, $id){
        $filename = md5(time());
        function base64_to_jpeg( $base64_string, $output_file ) {
            $ifp = fopen( $output_file, "wb" );
            $data = explode( ',', $base64_string );

            fwrite( $ifp, base64_decode( $data[1]) );
            fclose( $ifp );
            rename($output_file, storage_path('images/'.$output_file));
            $output_file = storage_path('images/'.$output_file);
            return( $output_file );
        }
        $image1 = base64_to_jpeg( $request->all()['image'], $request->all()['count'].$id.'.png' );
        return response()->json([
            'id' => $id.'.png',
            "img"=> $image1
        ]);
    }

    public function pdf(Request $request, $id){
        $customer = Customer::where('secret_link', $request->result_key)->first();
        $userData = json_decode(base64_decode($customer->customer), true);
        $datestamp = Carbon::today()->format('d/m/Y');

        $skillsR = $this->getResultText('1', 'R', $userData['result']['skills']['R']);
        $skillsI = $this->getResultText('1', 'I', $userData['result']['skills']['I']);
        $skillsA = $this->getResultText('1', 'A', $userData['result']['skills']['A']);
        $skillsS = $this->getResultText('1', 'S', $userData['result']['skills']['S']);
        $skillsO = $this->getResultText('1', 'O', $userData['result']['skills']['O']);
        $skillsC = $this->getResultText('1', 'C', $userData['result']['skills']['C']);

        $workValuesR = $this->getResultText('3', 'R', $userData['result']['work_values']['R']);
        $workValuesI = $this->getResultText('3', 'I', $userData['result']['work_values']['I']);
        $workValuesA = $this->getResultText('3', 'A', $userData['result']['work_values']['A']);
        $workValuesS = $this->getResultText('3', 'S', $userData['result']['work_values']['S']);
        $workValuesO = $this->getResultText('3', 'O', $userData['result']['work_values']['O']);
        $workValuesC = $this->getResultText('3', 'C', $userData['result']['work_values']['C']);

        $activitiesR = $this->getResultText('4', 'R', $userData['result']['activities']['R']);
        $activitiesI = $this->getResultText('4', 'I', $userData['result']['activities']['I']);
        $activitiesA = $this->getResultText('4', 'A', $userData['result']['activities']['A']);
        $activitiesS = $this->getResultText('4', 'S', $userData['result']['activities']['S']);
        $activitiesO = $this->getResultText('4', 'O', $userData['result']['activities']['O']);
        $activitiesC = $this->getResultText('4', 'C', $userData['result']['activities']['C']);

        $personalBehaviorR = $this->getResultText('5', 'R', $userData['result']['personal_behavior']['R']);
        $personalBehaviorI = $this->getResultText('5', 'I', $userData['result']['personal_behavior']['I']);
        $personalBehaviorA = $this->getResultText('5', 'A', $userData['result']['personal_behavior']['A']);
        $personalBehaviorS = $this->getResultText('5', 'S', $userData['result']['personal_behavior']['S']);
        $personalBehaviorO = $this->getResultText('5', 'O', $userData['result']['personal_behavior']['O']);
        $personalBehaviorC = $this->getResultText('5', 'C', $userData['result']['personal_behavior']['C']);

        $occupationsProfessionsR = $this->getResultText('6', 'R', $userData['result']['occupations_professions']['R']);
        $occupationsProfessionsI = $this->getResultText('6', 'I', $userData['result']['occupations_professions']['I']);
        $occupationsProfessionsA = $this->getResultText('6', 'A', $userData['result']['occupations_professions']['A']);
        $occupationsProfessionsS = $this->getResultText('6', 'S', $userData['result']['occupations_professions']['S']);
        $occupationsProfessionsO = $this->getResultText('6', 'O', $userData['result']['occupations_professions']['O']);
        $occupationsProfessionsC = $this->getResultText('6', 'C', $userData['result']['occupations_professions']['C']);

        arsort($userData['result']['total']);
        $totals = $userData['result']['total'];
        array_splice($totals, 3);
        $totals = array_values(array_flip($totals));

        $combinationOne = $totals[0].$totals[1].$totals[2];
        $combinationTwo = $totals[1].$totals[2].$totals[0];
        $combinationThree = $totals[2].$totals[0].$totals[1];
        $combinationFour = $totals[2].$totals[1].$totals[0];
        $combinationFive = $totals[1].$totals[0].$totals[2];
        $combinationSix = $totals[0].$totals[2].$totals[1];

        //unset($userData['result']['total']);
        $profListOne = $this->getProfessions($combinationOne);
        $profListTwo = $this->getProfessions($combinationTwo);
        $profListThree = $this->getProfessions($combinationThree);
        $profListFour = $this->getProfessions($combinationFour);
        $profListFive = $this->getProfessions($combinationFive);
        $profListSix = $this->getProfessions($combinationSix);

        //dd($profListOne);

        $customerName = $userData['name'];
        $customerAge = $userData['age'];
        $customerGender = ucfirst($userData['gender']);

//        header('Content-type: application/pdf');
//        header('Content-disposition: attachment; filename=some.pdf');

        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
//dd(__DIR__ . '/storage/fonts');
        $mpdf = new \Mpdf\Mpdf(

            [
                'fontDir' => array_merge($fontDirs, [
                    storage_path('fonts'),
                ]),
                'fontdata' => $fontData + [
                        //400
                        'montserrat' => [
                            'R' => 'Montserrat-Regular.ttf',
                        ],

                        //500
                        'monserrmedium' => [
                            'R' => 'Montserrat-Medium.ttf',
                        ],

                        //600
                        'montsersemibold' => [
                            'R' => 'Montserrat-SemiBold.ttf',
                        ],

                        // 700
                        'montserbold' => [
                            'R' => 'Montserrat-Bold.ttf',
                        ],

                        // 800
                        'montserextrabold' => [
                            'R' => 'Montserrat-ExtraBold.ttf',
                        ],
                    ],
                'default_font' => 'montserrat'
            ]

        );
        $mpdf->SetFont('montserrat');
        $mpdf->SetFont('monserrmedium');
        $mpdf->SetFont('montserbold');
        $mpdf->SetFont('montserextrabold');
        $mpdf->SetFont('montsersemibold');

        function get_image($name){
            $imgPath = storage_path('images/');
            $im = file_get_contents($imgPath.$name.'.png');
            $siz3e = getimagesize($imgPath.$name.'.png');
            $image = base64_encode($im);
            return 'data:'.$siz3e['mime'].';base64,'.$image;
        }
//        $mpdf = new \Mpdf\Mpdf();

        $mpdf->WriteHTML(view('p1', compact('customerName', 'datestamp')));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p2', compact('customerName', 'datestamp')));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p3', compact('customerName', 'datestamp', 'customerAge', 'customerGender')));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p4', compact('customerName', 'datestamp')));

        $mpdf->AddPage();


        $data1 = get_image('1'.$id);
        $mpdf->WriteHTML(view('p5', compact('data1', 'customerName', 'datestamp')));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p6', compact('customerName', 'datestamp', 'skillsR', 'skillsI', 'skillsA', 'skillsS', 'skillsO', 'skillsC')));

        $data2 = get_image('2'.$id);
        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p7', compact('data2', 'customerName', 'datestamp')));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p8', compact('customerName', 'datestamp', 'workValuesR', 'workValuesI', 'workValuesA', 'workValuesS', 'workValuesO', 'workValuesC')));

//        $mpdf->AddPage();
//        $mpdf->WriteHTML(view('p9_horizontal'));

        $data3 = get_image('3'.$id);
        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p9_reports', compact('data3', 'customerName', 'datestamp')));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p10', compact('customerName', 'datestamp', 'activitiesR', 'activitiesI', 'activitiesA', 'activitiesS', 'activitiesO', 'activitiesC')));

        $data4 = get_image('4'.$id);
        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p11', compact('data4', 'customerName', 'datestamp')));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p12', compact('customerName', 'datestamp', 'personalBehaviorR', 'personalBehaviorI', 'personalBehaviorA', 'personalBehaviorS', 'personalBehaviorO', 'personalBehaviorC')));

        $data5 = get_image('5'.$id);
        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p13', compact('data5', 'customerName', 'datestamp')));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p14', compact('customerName', 'datestamp', 'occupationsProfessionsR', 'occupationsProfessionsI', 'occupationsProfessionsA', 'occupationsProfessionsS', 'occupationsProfessionsO', 'occupationsProfessionsC')));

        $data6 = get_image('6'.$id);
        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p15', compact('data6', 'customerName', 'datestamp')));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p16', compact('customerName', 'datestamp')));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p17', compact('customerName', 'datestamp')));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p18', compact('customerName', 'datestamp')));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p19', compact('customerName', 'datestamp')));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p20', compact('customerName', 'datestamp')));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p21', compact('customerName', 'datestamp')));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p22', compact('customerName', 'datestamp')));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p23', compact('customerName', 'datestamp')));

        $mpdf->AddPage();
        $width = '120px';
        $mpdf->WriteHTML(view('p24', compact('width', 'customerName', 'datestamp')));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p25', compact('customerName', 'datestamp')));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p26', compact('customerName', 'datestamp'))->with('total', $totals)
                                                                                            ->with('profListOne', $profListOne));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p27', compact('customerName', 'datestamp'))->with('total', $totals)
                                                                                            ->with('profListTwo', $profListTwo)
                                                                                            ->with('profListThree', $profListThree));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p28', compact('customerName', 'datestamp'))->with('total', $totals)
                                                                                            ->with('profListFour', $profListFour)
                                                                                            ->with('profListFive', $profListFive));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p29', compact('customerName', 'datestamp'))->with('total', $totals)
                                                                                            ->with('profListSix', $profListSix));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p30', compact('customerName', 'datestamp')));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p31', compact('customerName', 'datestamp')));
        $mpdf->Output();

//'welcome.pdf', \Mpdf\Output\Destination::DOWNLOAD
//        return $pdf->download('welcome.pdf');
    }
    public function diagrams(Request $request, $id_unicum){
        $customer = Customer::where('secret_link', $request->result_key)->first();
        $userData = json_decode(base64_decode($customer->customer), true);

        $one = implode(',', $userData['result']['skills']);
        $two = implode(',', $userData['result']['work_values']);
        $three = implode(',', $userData['result']['activities']);
        $four = implode(',', $userData['result']['personal_behavior']);
        $five = implode(',', $userData['result']['occupations_professions']);
        $six = implode(',', $userData['result']['total']);
        return view('first_page', compact('id_unicum', 'one', 'two', 'three', 'four', 'five', 'six'));
    }
}
