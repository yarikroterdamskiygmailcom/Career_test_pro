<template>
    <div>
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
                        path:'/panel/home'
                    },{
                        name:'Questions',
                        path:'/panel/test'
                    }
                ]
            }
        },
        components:{
            'menu-component':menu
        }
    }
</script>

<style scoped>

</style>
