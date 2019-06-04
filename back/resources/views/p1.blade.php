<style>
    p {
        margin: 0;
        font-size: 12px;
    }
    .logo-phrase td {
        height: 50px;
        width: 50px;
        text-align: center;
        font-family:montsersemibold;
    }

    .author-box .author {
        font-family: montsersemibold;
    }
    .circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        float: left;
        margin: 0px 8px;
    }
</style>

<div>
    @include('header')

    <div style="width: 395px; height: 100px; margin: 191px auto">
        <h2 style="margin: 0; font-family: monserrmedium; text-align: center; text-transform: uppercase; line-height: 24px; font-size: 16px;"> <!-- careertest
            <span style="color: #4876D0; font-family: montsersemibold;">report</span> -->
            {!! $reportIds[15] !!}
        </h2>

        <p style="margin: 48px; text-align: center; font-size: 12px; font-family: monserrmedium;">{!! $reportIds[16] !!}</p>

        <div style="margin-top: 39px;">
            <div class="circle" style=" border: 2px solid #F59A9A; margin-left: 0">
                <table class="logo-phrase"><tr><td>R</td></tr></table>
            </div>

            <div class="circle" style="border: 2px solid #4876D0">
                <table class="logo-phrase"><tr><td>I</td></tr></table>
            </div>

            <div class="circle" style="border: 2px solid #77DCC1">
                <table class="logo-phrase"><tr><td>A</td></tr></table>
            </div>

            <div class="circle" style="border: 2px solid #85B1F5">
                <table class="logo-phrase"><tr><td>S</td></tr></table>
            </div>

            <div class="circle" style="border: 2px solid #FDC572">
                <table class="logo-phrase"><tr><td>E</td></tr></table>
            </div>

            <div class="circle" style="border: 2px solid #F9892E">
                <table class="logo-phrase"><tr><td>C</td></tr></table>
            </div>
        </div>

        <p style="text-align: center; margin-top: 39px; font-size: 12px; font-family: monserrmedium;">{!! $reportIds[17] !!}</p>
    </div>
</div>
