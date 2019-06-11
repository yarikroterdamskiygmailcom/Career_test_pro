<template>
    <div>
        <menu-component :list="list"></menu-component>
        <h1>Careers</h1>
        <router-view></router-view>
    </div>
</template>

<script>
    import menu from './../../common/menu.vue'
    export default {
        data() {
            return {
                list: [
                    {
                        name: 'List',
                        path: '/panel/careers/list'
                    }, {
                        name: 'Career pages',
                        path: '/panel/careers/career_pages'
                    }
                ]
            }
        },
        components: {
            'menu-component': menu
        }
    }
</script>

<style scoped>
    h1{
        margin:  20px 0;
    }
</style>
