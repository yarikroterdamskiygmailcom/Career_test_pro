<template>
    <div style="display: flex; justify-content: space-between">
        <ul :class="{submenu:!router, headmenu: router}">
            <li v-for="item in list">
                <router-link
                        :to="item.path"
                        class="child_menu"
                        :class="{child_menu_list:!router}">{{item.name}}</router-link>
            </li>
        </ul>
        <ul class="headmenu" v-if="router">
            <li>
                <a @click="logout()" style="cursor: pointer">Logout</a>
            </li>
        </ul>
    </div>
</template>

<script>
    import {Auth} from "../../api/auth";
    import {Token} from "../../store/localStorage";

    export default {
        name: 'menu-component',
        props: ['list'],
        computed:{
            router(){
                return this.$parent.$options._componentTag == 'header_component'
            }
        },
        methods:{
            logout(){
                const token = Token.getToken();
                if(token){
                    Auth.logout({token:token})
                        .then(res => this.log(res))
                        .catch(err => console.log(err))
                }
            },
            log(res){
                console.log(res)
                Token.destroyToken();
                this.$router.push('/login')
            }
        }
    }
</script>

<style scoped>
    @import "./../../style/menu.css";
</style>
