<template>
    <div>
        <menu-component :list="list"></menu-component>
        <h1>Settings</h1>
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
                        name: 'Price',
                        path: '/panel/settings/price'
                    }, {
                        name: 'Users',
                        path: '/panel/settings/users'
                    }, {
                        name: 'Test Codes',
                        path: '/panel/settings/test-codes'
                    }, {
                        name: 'Invoices',
                        path: '/panel/settings/invoices'
                    }, {
                        name: 'Site',
                        path: '/panel/settings/site'
                    }, {
                        name: 'Languages',
                        path: '/panel/settings/languages'
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
    h1 {
        font-size: 20px;
        margin: 20px 0;
    }
</style>
