<template>
    <div>
        <menu-component :list="list"></menu-component>
        test
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
                        path:'/panel/test/home'
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

</style>
