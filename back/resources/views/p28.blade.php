
<div style="height: 100%;">
    @include('header')

    <div>
        <div style="width: 50%; float: left;">
            <div style="width: 118px; margin: auto;">
                <div style="width: 35px; height: 35px; border-radius: 50%; border: 2px solid #F9892E; float: left;">
                    <table>
                        <tr>
                            <td style="width: 35px; height: 35px; text-align: center; font-family: montsersemibold;">{{ $total[2] }}</td>
                        </tr>
                    </table>
                </div>

                <div style="width: 35px; height: 35px; border-radius: 50%; border: 2px solid #FDC572; float: left;">
                    <table>
                        <tr>
                            <td style="width: 35px; height: 35px; text-align: center; font-family: montsersemibold;">{{ $total[1] }}</td>
                        </tr>
                    </table>
                </div>

                <div style="width: 35px; height: 35px; border-radius: 50%; border: 2px solid #85B1F5; float: left;">
                    <table>
                        <tr>
                            <td style="width: 35px; height: 35px; text-align: center; font-family: montsersemibold;">{{ $total[0] }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div style="font-size: 12px; line-height: 22px; width: 85%; float: left; margin-top: 5px;">
                @foreach($profListFour as $fourthListCareer)
                    {{ $fourthListCareer['career_description']['career'] }}<br>
                @endforeach
            </div>

            <div style="font-size: 12px; line-height: 22px; text-align: right;">
                @foreach($profListFour as $fourthListLevel)
                    {{ $fourthListLevel['level'] }}<br>
                @endforeach
            </div>
        </div>

        <div style="width: 40%; float: right;">
            <div style="width: 117px; margin: auto;">
                <div style="width: 35px; height: 35px; border-radius: 50%; border: 2px solid #85B1F5; float: left;">
                    <table>
                        <tr>
                            <td style="width: 35px; height: 35px; text-align: center; font-family: montsersemibold;">{{ $total[1] }}</td>
                        </tr>
                    </table>
                </div>

                <div style="width: 35px; height: 35px; border-radius: 50%; border: 2px solid #F9892E; float: left;">
                    <table>
                        <tr>
                            <td style="width: 35px; height: 35px; text-align: center; font-family: montsersemibold;">{{ $total[0] }}</td>
                        </tr>
                    </table>
                </div>

                <div style="width: 35px; height: 35px; border-radius: 50%; border: 2px solid #FDC572; float: left;">
                    <table>
                        <tr>
                            <td style="width: 35px; height: 35px; text-align: center; font-family: montsersemibold;">{{ $total[2] }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div style="font-size: 12px; line-height: 22px; width: 85%; float: left; margin-top: 45px;">
                @foreach($profListFive as $fifthListCareer)
                    {{ $fifthListCareer['career_description']['career'] }}<br>
                @endforeach
            </div>

            <div style="font-size: 12px; line-height: 22px; text-align: right;">
                @foreach($profListFive as $fifthListLevel)
                    {{ $fifthListLevel['level'] }}<br>
                @endforeach
            </div>
        </div>
    </div>

</div>

@include('footer')