<template>
    <div>
        <h3>
            Test Code
        </h3>
        <v-btn color="blue" flat @click="create_code()">
            Create code
        </v-btn>
        <table cellspacing="0" >
            <thead>
            <tr>
                <td width="15">#</td>
                <td width="300">Code</td>
                <td width="200">Admin</td>
                <td width="200">Customer</td>
                <td width="150">Used</td>
            </tr>
            </thead>
            <tbody style="width: 915px">
            <tr v-for="(item, index) in test_codes">
                <td>{{index + 1}}</td>
                <td>{{item.value}}</td>
                <td>{{item.admin}}</td>
                <td>{{item.customer ? item.customer  : 'not used'}}</td>
                <td>{{item.used ? 'yes' : 'no'}}</td>
            </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
    import {Settings} from "../../../../api/panel_settings/settings";

    export default {
        name: "test_codes",
        data(){
            return {
                test_codes: []
            }
        },
        created(){
            this.get_test_code()
        },
        methods:{
            get_test_code(){
                Settings.get_test_codes()
                    .then(res => this.test_codes = res.body.data)
            },
            create_code(){
                Settings.crate_test_code()
                    .then(res => this.get_test_code())
            }
        }
    }
</script>

<style scoped>

</style>
