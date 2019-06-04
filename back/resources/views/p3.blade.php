<style>
    @font-face {
        font-family: 'Montserrat';
        src: url('fonts/Montserrat-ExtraBold.ttf') format('ttf'),
        url('fonts/Montserrat-ExtraBold.ttf') format('ttf');
        font-weight: 800;
        font-style: normal;}
</style>
<div >
    @include('header')

    <h2 style="margin: 0; text-align: center; text-transform: uppercase; font-size: 12px; font-family: monserrmedium;">{!! $reportIds[34] !!}
    </h2>

    <div style="margin-top: 24px;">
        <div style="font-size: 12px; font-family: montserbold; border-bottom: 1px solid #DFDFDF; padding-bottom: 5px;">
            1. {!! $reportIds[35] !!}
        </div>

        <div style="margin-top: 21px;">
            <div style="width: 44px; height: 44px; border-radius: 50%; background: #F4F8FF; float: left;">
                <table style="color: #4876D0; font-size: 14px; font-family: montsersemibold; text-align: center;">
                    <tr>
                        <td style="width: 44px; height: 44px;">JS</td>
                    </tr>
                </table>
            </div>

            <div style="margin-top: 2px; margin-left: 60px;">
                <table style="font-size: 12px;">
                    <tr>
                        <td style="font-family: montsersemibold;">{!! $reportIds[36] !!}</td>
                        <td style="font-family: montsersemibold; padding-left: 40px;">{!! $reportIds[37] !!}</td>
                        <td style="font-family: montsersemibold; padding-left: 40px;">{!! $reportIds[38] !!}</td>
                        <td style="font-family: montsersemibold; padding-left: 40px;">{!! $reportIds[39] !!}</td>
                    </tr>

                    <tr>
                        <td>{{ $customerName }}</td>
                        <td style="padding-left: 40px;">{{ $customerAge }}</td>
                        <td style="padding-left: 40px;">{{ $customerGender }}</td>
                        <td style="padding-left: 40px;">{{ $datestamp }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div style="font-size: 13px; color:#333333; font-family: montserbold; font-weight: 600 !important; border-bottom: 1px solid #DFDFDF; padding-bottom: 5px; margin-top: 21px;">
            2. {!! $reportIds[40] !!}
        </div>

        <p style="margin: 15px 0; line-height: 22px">
            {!! $reportIds[41] !!}
        </p>
        <p style="margin: 15px 0; line-height: 22px">
            {!! $reportIds[42] !!}
        </p>
        <p style="margin: 15px 0; line-height: 22px">
            {!! $reportIds[43] !!}
        </p>

        <div style="font-family: sans;">
            <div style="width: 30px; height: 30px; border-radius: 50%; border: 2px solid #F59A9A; float: left">
                <table>
                    <tr>
                        <td style=" font-family: montsersemibold; width: 30px; height: 30px; text-align: center">R</td>
                    </tr>
                </table>
            </div>

            <table style="margin-left: 15px; width: 70%">
                <tr>
                    <td style="height: 30px">
                        {!! $reportIds[8] !!} - <span style="font-family: monserrmedium;">{!! $reportIds[44] !!}</span>;
                    </td>
                </tr>
            </table>
        </div>

        <div style="margin-top: 10px; font-family: sans;">
            <div style="width: 30px; height: 30px; border-radius: 50%; border: 2px solid #4876D0; float: left">
                <table><tr><td style="font-family: montsersemibold; width: 30px; height: 30px; text-align: center">I</td></tr></table>
            </div>

            <table style="margin-left: 15px; width: 70%">
                <tr>
                    <td style="height: 30px">{!! $reportIds[7] !!} -
                        <span style="font-family: monserrmedium;">{!! $reportIds[45] !!}</span>;
                    </td>
                </tr>
            </table>
        </div>

        <div style="margin-top: 10px; font-family: sans;">
            <div style="width: 30px; height: 30px; border-radius: 50%; border: 2px solid #77DCC1; float: left">
                <table>
                    <tr>
                        <td style="font-family: montsersemibold; width: 30px; height: 30px; text-align: center">A</td>
                    </tr>
                </table>
            </div>

            <table style="margin-left: 15px; width: 70%"><tr><td style="height: 30px">{!! $reportIds[226] !!} - <span style="font-family: monserrmedium;">{!! $reportIds[46] !!}</span>;</td></tr></table>
        </div>

        <div style="margin-top: 10px; font-family: sans;">
            <div style="width: 30px; height: 30px; border-radius: 50%; border: 2px solid #85B1F5; float: left">
                <table><tr><td style="font-family: montsersemibold; width: 30px; height: 30px; text-align: center">S</td></tr></table>
            </div>

            <table style="margin-left: 15px; width: 70%">
                <tr>
                    <td style="height: 30px">{!! $reportIds[6] !!} - <span style="font-family: monserrmedium;">{!! $reportIds[47] !!}</span>;
                    </td>
                </tr>
            </table>
        </div>

        <div style="margin-top: 10px; font-family: sans;">
            <div style="width: 30px; height: 30px; border-radius: 50%; border: 2px solid #FDC572; float: left">
                <table><tr><td style="font-family: montsersemibold; width: 30px; height: 30px; text-align: center">E</td></tr></table>
            </div>

            <table style="margin-left: 15px; width: 70%">
                <tr>
                    <td style="height: 30px">{!! $reportIds[4] !!} -
                        <span style="font-family: monserrmedium;">{!! $reportIds[48] !!}</span>;
                    </td>
                </tr>
            </table>
        </div>

        <div style="margin-top: 10px; font-family: sans;">
            <div style="width: 30px; height: 30px; border-radius: 50%; border: 2px solid #F9892E; float: left">
                <table><tr><td style="font-family: montsersemibold; width: 30px; height: 30px; text-align: center">C</td></tr></table>
            </div>

            <table style="margin-left: 15px; width: 70%">
                <tr>
                    <td style="height: 30px">{!! $reportIds[5] !!} -
                        <span style="font-family: monserrmedium;">{!! $reportIds[49] !!}</span>.
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <p style="margin-top: 13px; line-height: 22px">
        {!! $reportIds[50] !!}
    </p>

    <p style="margin-top: 20px; line-height:22px">
        {!! $reportIds[51] !!}
    </p>

    <p style="margin-top: 65px;">{!! $reportIds[2] !!}</p>
</div>
