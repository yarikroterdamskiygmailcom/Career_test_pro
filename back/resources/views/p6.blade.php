<div>
    @include('header')

    <div>
        <div style="width: 30px; height: 30px; border: 2px solid #FDC572; border-radius: 50%; float: left; font-family: sans;">
            <table>
                <tr>
                    <td style="width: 30px; height: 30px; text-align: center; font-family: montsersemibold; ">E</td>
                </tr>
            </table>
        </div>

        <table><tr><td style="font-family: montsersemibold; height: 30px; width: 300px; padding-left: 15px;">{!! $reportIds[4] !!}</td></tr></table>
    </div>

    <p style="margin: 15px 0; line-height: 20px;">
        {{$skillsO}}
    </p>

    <div>
        <div style="width: 30px; height: 30px; border: 2px solid #F9892E; border-radius: 50%; float: left; font-family: sans;">
            <table>
                <tr>
                    <td style="width: 30px; height: 30px; text-align: center; font-family: montsersemibold; ">C</td>
                </tr>
            </table>
        </div>

        <table><tr><td style="font-family: monserrmedium; height: 30px; width: 300px; padding-left: 15px;">{!! $reportIds[5] !!}</td></tr></table>
    </div>

    <p style="margin: 15px 0; line-height: 20px;">
        {{$skillsC}}
    </p>

    <div>
        <div style="width: 30px; height: 30px; border: 2px solid #85B1F5; border-radius: 50%; float: left; font-family: sans;">
            <table>
                <tr>
                    <td style="width: 30px; height: 30px; text-align: center; font-family: monserrmedium;">S</td>
                </tr>
            </table>
        </div>

        <table><tr><td style="font-family: monserrmedium; height: 30px; width: 300px; padding-left: 15px;">{!! $reportIds[6] !!}</td></tr></table>
    </div>

    <p style="margin: 15px 0; line-height: 20px;">
        {{$skillsS}}
    </p>

    <div>
        <div style="width: 30px; height: 30px; border: 2px solid #77DCC1; border-radius: 50%; float: left; font-family: sans;">
            <table>
                <tr>
                    <td style="width: 30px; height: 30px; text-align: center; font-family: monserrmedium;">A</td>
                </tr>
            </table>
        </div>

        <table><tr><td style="font-family: montsersemibold; height: 30px; width: 300px; padding-left: 15px;">{!! $reportIds[226] !!}</td></tr></table>
    </div>

    <p style="margin: 15px 0; line-height: 20px;">
        {{$skillsA}}
    </p>

    <div>
        <div style="width: 30px; height: 30px; border: 2px solid #4876D0; border-radius: 50%; float: left; font-family: sans;">
            <table>
                <tr>
                    <td style="width: 30px; height: 30px; text-align: center; font-family: montsersemibold;">I</td>
                </tr>
            </table>
        </div>

        <table><tr><td style="font-family: montsersemibold; height: 30px; width: 300px; padding-left: 15px;">{!! $reportIds[7] !!}</td></tr></table>
    </div>

    <p style="margin: 15px 0; line-height: 20px;">
        {{$skillsI}}

    </p>

    <div>
        <div style="width: 30px; height: 30px; border: 2px solid #F59A9A; border-radius: 50%; float: left; font-family: sans;">
            <table>
                <tr>
                    <td style="width: 30px; height: 30px; text-align: center; font-family: montsersemibold;">R</td>
                </tr>
            </table>
        </div>

        <table><tr><td style="font-family: montsersemibold; height: 30px; width: 300px; padding-left: 15px;">{!! $reportIds[8] !!}</td></tr></table>
    </div>

    <p style="margin: 15px 0; line-height: 20px;">
        {{$skillsR}}

    </p>

    <div style="margin-top: 97px;">
        @include('footer')
    </div>
</div>
