<template>
    <div>
        <header-component></header-component>
        <banner-component></banner-component>
        <div id="content">
           <router-view></router-view>
        </div>
        <footer-component></footer-component>
    </div>
</template>

<script>
    //this.$http.get('/someUrl')
    import header from './common/header.vue'
    import banner from './common/banner_container.vue'
    import footer from './common/footer.vue'
    export default {
        components:{
            'header-component': header,
            'banner-component': banner,
            'footer-component': footer
        }
    }
</script>
<style>
    body{
        background: #fff;
        font-family: Arial;
        font-size: 12px;
        line-height: 20px;
        margin: 0px;
        padding: 0px;
    }
    #content{
        width: 1000px;
        margin: 0px auto;
    }
</style>
