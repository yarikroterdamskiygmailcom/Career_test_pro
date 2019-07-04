<template>
    <div>
        <h3>
            Users
        </h3>
        <table cellspacing="0" >
            <thead>
            <tr>
                <td width="15">#</td>
                <td width="200">Admins</td>
                <td width="300">Email</td>
                <td width="150">Data</td>
            </tr>
            </thead>
            <tbody style="width: 915px">
            <tr v-for="(item, index) in user_list">
                <td>{{index + 1}}</td>
                <td>{{item.name}}</td>
                <td>{{item.email}}</td>
                <td>{{item.created_at}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import {Settings} from "../../../../api/panel_settings/settings";

    export default {
        name: "users",
        data(){
            return{
                user_list:[]
            }
        },
        created(){
            Settings.get_all_admin()
                .then(res => this.user_list = res.body)
        }
    }
</script>

<style scoped>
    table {
        border-collapse: collapse;
    }
     td {
         padding: 5px 0;
         border-bottom: 1px solid #cecece;
    }
    tr:hover{
        background: #ececec;
    }
    thead tr td {
        padding: 5px;
        font-weight: bold;
    }
</style>
