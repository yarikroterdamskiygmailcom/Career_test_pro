<template>
    <div class="container_confirm d-flex justify-content-center">
        <div class="content">
            <div class="step">
                <router-link to="tests/10">Test Page (Step 10)</router-link>
                /
                <a>Proceed to Confirm</a>
            </div>
            <div class="title_block text-center custom-title">
                Congratulations!
            </div>
            <div class="small_text text-center custom-small">
                Get report on your email
            </div>
            <div class="small_text custom_small_text text-center">
                To get report on your email, please, fill in fields below
            </div>

            <input_information_component></input_information_component>

        </div>
    </div>
</template>

<script>
    import Input_information from './input_information/index.vue'
    export default {
        name: "ProcessConfirmPage",
        components:{
            'input_information_component': Input_information,
        }
    }
</script>

<style scoped>
    .container_confirm{
         width: 100%;
        margin-bottom: 510px;
    }
    .container_payment{

    }
    .step{
        width: 100%;
        margin-top: 30px;
        margin-bottom: 45px;
    }
    .step a {
        font-size: 12px;
        color: #333333;
        text-decoration: none;
    }
    .step a:first-child {
        margin-right: 10px;
    }.step a:last-child {
        margin-left: 10px;
    }
    .custom_small_text{
        font-weight: 600;
        font-size: 16px;
        margin-bottom: 90px;
    }
    .content{
        width: 1140px;
    }
    .custom-title{
        font-weight: 800;
        margin-bottom: 20px
    }
    .custom-small{
        margin-bottom: 70px;
    }
</style>
