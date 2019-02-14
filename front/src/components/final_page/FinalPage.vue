<template>
    <div id="final" class="d-flex flex-column align-items-center">
        <div class="title_block custom_title">
            Check Your <span style="color:#F9892E">Email</span>
        </div>
        <div class="small_text custom_small_title">
            We’ve sent a report on it
        </div>
        <div class="check_block d-flex justify-content-between">
            <div class="check_block_img position-relative">
                <div class="check_ellipse"></div>
                <div class="check_image position-absolute"></div>
            </div>
            <div class="check_content d-flex align-items-center flex-column">
                <div class="title_block title_check text-center">
                    Thanks for using our service!
                </div>
                <div class="title_small">
                    You will receive an email soon, regarding your payment.<br><br>

                    If you have any questions - don’t hesitate to ask our team.
                </div>
                <div class="d-flex check_button
                 justify-content-between flex-grow-1 align-items-end">
                    <router-link :to="'contact-us'" class="button_to d-flex justify-content-center
                    align-items-center text-decoration-none
                    custom_button orange_style">
                        Contact Us
                    </router-link>
                    <router-link :to="'tests'" class="button_to d-flex justify-content-center
                    align-items-center text-decoration-none
                    custom_button">
                        Take the Test
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "FinalPage"
    }
</script>

<style scoped>
    #final{
        margin-top: 90px;
        margin-bottom: 354px;
    }
    .custom_title{
        margin-bottom: 20px;
    }
    .custom_small_title{
        margin-bottom: 112px;
    }
    .check_block{
        box-shadow: 0px 0px 7px rgba(0, 0, 0, 0.1);
        border-radius: 20px;
        width: 910px;
        height: 420px;
    }
    .custom_button{
        width: 193px;
    }
    .check_content{
        padding: 70px 63px 70px 55px;
    }
    .check_ellipse{
        width: 312px;
        height: 312px;
        background: #F4F8FF;
        margin: 54px 0 54px 67px;
        border-radius: 50%;
    }
    .check_image{
        width: 243.85px;
        height: 459.65px;
        background-image: url("./../../assets/check_email/check_email.png");
        background-repeat: no-repeat;
        background-position: center;
        top: -53px;
        left: 89px;
    }
    .title_check{
        font-weight: 600;
        font-size: 20px;
        letter-spacing: 0;
    }
    .title_small{
        line-height: 23px;
        font-size: 14px;
        margin-top: 47px;
    }
    .check_button{
        width: 100%;
    }
</style>

