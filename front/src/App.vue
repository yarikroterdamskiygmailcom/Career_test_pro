<template>
    <div id="app" class="text_style">
        <header-component></header-component>
        <div class="router">
            <router-view></router-view>
        </div>
        <footer-component></footer-component>
    </div>
</template>

<script>
    import Footer from './common/other_elements/footer/footer.vue'
    import Header from './common/other_elements/header/index.vue'

    export default {
        data() {
            return {
                msg: 'Welcome to Your Vue.js App'
            }
        },
        components: {
            'footer-component': Footer,
            'header-component': Header,
        }
    }
</script>

<style lang="scss">
    .content_tab > p {
        margin-bottom: 32px;
    }
    .body{
        background: #E5E5E5;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }
    .router{
        padding-top: 86px;
    }
    .text_style{
        font-family: Montserrat;
        font-style: normal;
    }
    .small_text{
        font-weight: 500;
        line-height: 29px;
        font-size: 16px;
        color: #333333;
        margin-top: 10px;
        margin-bottom: 20px;
    }
    .button_to{
        cursor: pointer;
        color:black;
        background: #85B1F5;
        height: 44px;
        padding: 0 30px;
        border-radius: 22px;
        box-shadow: 0 3px 7px rgba(0, 0, 0, 0.2);
    }
    .title_block{
        font-weight: 800;
        line-height: 51px;
        font-size: 28px;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        color: #333333;
    }
    .background_image{
        background-position: center;
        background-repeat: no-repeat;
    }
    .container_margin {
        width: 1140px;
        margin: 0 15px;
    }
    .elem_elipse{
        display: inline-block;
        position: absolute;
        content: '';
        right: 0;
        left: 0;
        width: 100%;
        height: 400px;
        background: white;
        background-position: -100px 0;
        background-repeat: no-repeat;
        -webkit-clip-path: ellipse(90% 70% at 0% 50%);
        clip-path: ellipse(65% 59% at 50% -30%);
        -webkit-shape-outside: ellipse(90% 70% at 0% 50%);
        shape-outside: ellipse(90% 56% at 0% 50%);
        -webkit-shape-margin: 2em;
        shape-margin: 2em;
    }
    .elem_elipse1{
        bottom: 0;
        transform: rotate(180deg);
    }


    .have-any-questions_block_input input, .have-any-questions_block_input textarea {
        background: #FFFFFF;
        border: 1px solid #DFDFDF;
        height: 44px;
        padding: 0 30px;
        width: 400px;
        box-sizing: border-box;
        border-radius: 22px;
        margin-bottom: 24px;
        color: #8B8B8B;
    }

    .have-any-questions_block_input textarea {
        height: 250px;
        padding-top: 10px;
    }
</style>
