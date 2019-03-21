<template>
    <div>
        <menu-component :list="list"></menu-component>
        report
    </div>
</template>

<script>
    import menu from './../../common/menu.vue'
    export default {
        data(){
            return{
                list:[
                    {
                        name:'Report',
                        path:'/panel/report'
                    },{
                        name:'Text for Scores',
                        path:'/panel/report/text-for-Scores'
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
