<template>
    <div>
        <h3>
            Languages
        </h3>
        <v-btn color="blue" flat @click="dialog = !dialog">
            Create language
        </v-btn>
        <table cellspacing="0" >
            <thead>
            <tr>
                <td width="15">#</td>
                <td width="200">Language</td>
                <td width="300">Code</td>
                <td width="300">status</td>
            </tr>
            </thead>
            <tbody style="width: 915px">
            <tr v-for="(item, index) in languages_list">
                <td>{{index + 1}}</td>
                <td>{{item.language}}</td>
                <td>{{item.code}}</td>
                <td>{{item.status}}</td>
            </tr>
            </tbody>
        </table>
        <v-dialog v-model="dialog" width="500">
            <v-card>
                <v-card-title class="headline grey lighten-2" primary-title>
                    <div style="margin-right: 20px">Add Language</div>
                </v-card-title>
                <v-card-text>
                    <v-text-field
                            v-model="data.language"
                            :rules="rules"
                            label="Language"
                            required
                    ></v-text-field>
                    <v-text-field
                            v-model="data.code"
                            :rules="rules"
                            label="Code"
                            required
                    ></v-text-field>
                </v-card-text>

                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" flat @click="save()">
                        Save
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
    import {Settings} from "../../../../api/panel_settings/settings";

    export default {
        name: "languages",
        data() {
            return {
                languages_list: [],
                dialog:false,
                rules: [
                    v => !!v || 'Field is required',
                ],
                data:{
                    language:'',
                    code:    '',
                    status:  0
                },
                docs:new FormData()
            }
        },
        created() {
            this.getLanguage()
        },
        methods:{
            getLanguage(){
                Settings.list_language()
                    .then(res => this.languages_list = res.body)
            },
            save(){
                if(!this.data.language && !this.data.code) return;
                this.addOrUpdateLanguage()
                    .then(res => {
                        console.log(res);
                        // return this.addDocument()
                    })
                    .then(res => {
                        // this.dialog = !this.dialog;
                        // this.getLanguage()
                    })
            },
            addOrUpdateLanguage(){
                return Settings.add_language(this.data)
            },
            addDocument(){
                return Settings.add_Document(this.docs)
            }
        }
    }
</script>

<style scoped>

</style>
