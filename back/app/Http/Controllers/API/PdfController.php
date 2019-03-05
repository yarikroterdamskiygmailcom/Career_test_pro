<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Customer;

class PdfController extends Controller
{

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
        $mpdf->WriteHTML(view('p1'));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p2'));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p3'));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p4'));

        $mpdf->AddPage();


        $data1 = get_image('1'.$id);
        $mpdf->WriteHTML(view('p5', compact('data1')));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p6'));

        $data2 = get_image('2'.$id);
        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p7', compact('data2')));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p8'));

//        $mpdf->AddPage();
//        $mpdf->WriteHTML(view('p9_horizontal'));

        $data3 = get_image('3'.$id);
        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p9_reports', compact('data3')));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p10'));

        $data4 = get_image('4'.$id);
        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p11', compact('data4')));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p12'));

        $data5 = get_image('5'.$id);
        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p13', compact('data5')));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p14'));

        $data6 = get_image('6'.$id);
        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p15', compact('data6')));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p16'));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p17'));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p18'));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p19'));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p20'));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p21'));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p22'));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p23'));

        $mpdf->AddPage();
        $width = '120px';
        $mpdf->WriteHTML(view('p24', compact('width')));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p25'));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p26'));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p27'));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p28'));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p29'));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p30'));

        $mpdf->AddPage();
        $mpdf->WriteHTML(view('p31'));
        $mpdf->Output();

//'welcome.pdf', \Mpdf\Output\Destination::DOWNLOAD
//        return $pdf->download('welcome.pdf');
    }
    public function diagrams(Request $request, $id_unicum){
        $customer = Customer::where('secret_link', $request->result_key)->first();
        dd(json_decode(base64_decode($customer->customer)));
        $one = '10,2,38,42,5, 100';
        $two = '60,30,80,19,70,10';
        $three = '30,90,80,9,10,70';
        $four = '20,90,40,29,60,40';
        $five = '10,90,20,39,80,40';
        $six = '40,30,50,29,70,30';
        return view('first_page', compact('id_unicum', 'one', 'two', 'three', 'four', 'five', 'six'));
    }}
