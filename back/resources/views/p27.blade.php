
<div style="height: 98%; border: 1px dotted white">
    @include('header')

    <div>
        <div style="width: 40%; float: left;">
            <div style="width: 117px; margin: auto;">
                <div style="width: 35px; height: 35px; border-radius: 50%; border: 2px solid #FDC572; float: left;">
                    <table>
                        <tr>
                            <td style="width: 35px; height: 35px; text-align: center; font-family: montsersemibold;">{{ $total[1] }}</td>
                        </tr>
                    </table>
                </div>

                <div style="width: 35px; height: 35px; border-radius: 50%; border: 2px solid #F9892E; float: left;">
                    <table>
                        <tr>
                            <td style="width: 35px; height: 35px; text-align: center; font-family: montsersemibold;">{{ $total[2] }}</td>
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

            <div style="font-size: 12px; line-height: 22px; width: 85%; float: left; margin-top: 15px;">
                @foreach($profListTwo as $secondListCareer)
                    {{ $secondListCareer['career_description']['career'] }}<br>
                @endforeach
            </div>

            <div style="font-size: 12px; line-height: 22px; text-align: right;">
                @foreach($profListTwo as $secondListLevel)
                    {{ $secondListLevel['level'] }}<br>
                @endforeach
            </div>
        </div>

        <div style="width: 40%; float: right;">
            <div style="width: 117px; margin: auto;">
                <div style="width: 35px; height: 35px; border-radius: 50%; border: 2px solid #F9892E; float: left;">
                    <table>
                        <tr>
                            <td style="width: 35px; height: 35px; text-align: center; font-family: montsersemibold;">{{ $total[2] }}</td>
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

                <div style="width: 35px; height: 35px; border-radius: 50%; border: 2px solid #FDC572; float: left;">
                    <table>
                        <tr>
                            <td style="width: 35px; height: 35px; text-align: center; font-family: montsersemibold;">{{ $total[1] }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div style="font-size: 12px; line-height: 22px; width: 85%; float: left; margin-top: 15px;">
                @foreach($profListThree as $thirdListCareer)
                    {{ $thirdListCareer['career_description']['career'] }}<br>
                @endforeach
            </div>

            <div style="font-size: 12px; line-height: 22px; text-align: right;">
                @foreach($profListThree as $thirdListLevel)
                    {{ $thirdListLevel['level'] }}<br>
                @endforeach
            </div>
        </div>
    </div>

</div>

@include('footer')

<p style="text-align: center">27</p>