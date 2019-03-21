<template>
    <div>
        <menu-component :list="list"></menu-component>
        <h1>Test</h1>
        <router-view></router-view>
    </div>
</template>

<script>
    import menu from './../../common/menu.vue'
    export default {
        data(){
            return{
                list:[
                    {
                        name:'Categories',
                        path:'/panel/test/categories'
                    },{
                        name:'Questions',
                        path:'/panel/test/questions'
                    }
                ]
            }
        },
        components:{
           'menu-component': menu
        }
    }
</script>

<style scoped>
    h1 {
        font-size: 20px;
        margin: 20px 0;
    }
</style>
