<template>
    <div id="app">
        <header-component></header-component>
        <div>
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
    .body{
        background: #E5E5E5;
        margin: 0;
        padding: 0;
    }

    .text_style{
        font-family: Montserrat;
        font-style: normal;
        font-weight: 600;
        line-height: normal;
        font-size: 16px;
        text-align: center;
    }
</style>
