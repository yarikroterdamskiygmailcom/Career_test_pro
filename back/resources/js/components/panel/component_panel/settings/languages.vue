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
                <td>
                    <v-btn color="primary" v-if="item.id == 1" flat @click="exportCSV(item.id)">
                        Export CSV
                    </v-btn>
                </td>
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
        <v-dialog v-model="dialog1" width="500">
            <v-card>
                <v-card-title class="headline grey lighten-2" primary-title>
                    <div style="margin-right: 20px">Download CSV</div>
                </v-card-title>
                <v-card-text>
                    <v-btn color="primary" flat @click="download('report')">
                        Download report
                    </v-btn>
                    <v-btn color="primary" flat @click="download('site')">
                        Download site
                    </v-btn>
                </v-card-text>

                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" flat @click="dialog1 = !dialog1">
                        Close
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
                dialog1:false,
                dialog1_data: {},
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
            },
            exportCSV(id){
                Settings.export(id)
                    .then(res => {
                        this.dialog1_data = res.data.data;
                        this.dialog1 = !this.dialog1;
                    })
            },
            download(name){
                window.location.href = this.dialog1_data[name]
                this.dialog1 = !this.dialog1;
            }
        }
    }
</script>

<style scoped>

</style>
