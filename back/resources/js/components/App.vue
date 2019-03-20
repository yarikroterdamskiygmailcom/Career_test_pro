<template>
    <div>
        <header_component></header_component>
        <banner_component></banner_component>
        <div id="content">
           <router-view></router-view>
        </div>
        <footer_component></footer_component>
    </div>
</template>

<script>
    //this.$http.get('/someUrl')
    import header from './common/header.vue'
    import banner from './common/banner_container.vue'
    import footer from './common/footer.vue'
    export default {
        components:{
            'header_component': header,
            'banner_component': banner,
            'footer_component': footer
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
