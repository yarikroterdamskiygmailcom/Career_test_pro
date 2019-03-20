<template>
    <div>
        <menu-component :list="list"></menu-component>
        careers
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

</style>
