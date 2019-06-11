<template>
    <div class="header">
        <div class="logo">
            <router-link to="admin">
                <img src="http://careertestsoft.com/images/logo.png" alt="CareerTestSoft">
            </router-link>
            <menu-component :list="list"></menu-component>
        </div>
    </div>
</template>

<script>
    import menu from './menu.vue'
    export default {
        data(){
            return{
                list:[
                    {
                        name:'Home',
                        path:'/panel/home'
                    },{
                        name:'Test',
                        path:'/panel/test'
                    },{
                        name:'Report',
                        path:'/panel/report'
                    },{
                        name:'Careers',
                        path:'/panel/careers'
                    },{
                        name:'Settings',
                        path:'/panel/settings'
                    },
                ]
            }
        },
        components:{
            'menu-component':menu
        }
    }
</script>

<style scoped>
    .header{
        width: 1000px;
        margin: 0px auto;
        padding: 20px 0px 20px 0px;
    }
</style>
