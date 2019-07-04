<template>
    <div>
        <menu-component :list="list"></menu-component>
        <h1>Report</h1>
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
                        name:'Report',
                        path:'/panel/report/report'
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
    h1{
        margin: 20px 0

    }
</style>
