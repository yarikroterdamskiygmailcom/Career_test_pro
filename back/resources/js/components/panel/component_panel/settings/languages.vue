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
                <td width="300">Status</td>
                <td width="300">Edit status</td>
                <td width="300" style="padding-left: 50px">Import</td>
                <td width="300" style="padding-left: 50px">Export</td>
            </tr>
            </thead>
            <tbody style="width: 915px">
            <tr v-for="(item, index) in languages_list">
                <td>{{index + 1}}</td>
                <td>{{item.language}}</td>
                <td >{{item.code}}</td>
                <td :style="{color: item.status ? 'green' : 'red'}">{{item.status}}</td>
                <td>
                    <v-btn color="primary"
                           v-if="index != 0"
                        flat
                        @click="edit_status(item.language, item.code,  item.status ? 0 : 1)">
                        Edit status
                    </v-btn>
                </td>
                <td>
                    <v-btn color="primary"
                       flat
                       @click="importCSV(item.id)">
                       Import CSV
                    </v-btn>
                </td>
                <td>
                    <v-btn color="primary"
                        v-if="item.id == 1"
                        flat
                        @click="exportCSV(item.id)">
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
        <v-dialog v-model="dialog2" width="500">
            <v-card>
                <v-card-title class="headline grey lighten-2" primary-title>
                    <div style="margin-right: 20px">Download CSV</div>
                </v-card-title>
                <v-card-text>
                    <v-flex xs12 class="text-xs-center text-sm-center text-md-center text-lg-center">
                        <v-text-field
                                label="Report"
                                @click="pickFile('Report')"
                                v-model='dialog2_data.report.imageName'
                                prepend-icon='attach_file'></v-text-field>
                        <input
                                type="file"
                                style="display: none"
                                ref="Report"
                                @change="onFilePicked($event, 'report')"
                        >
                    </v-flex>
                    <v-flex xs12 class="text-xs-center text-sm-center text-md-center text-lg-center">
                        <v-text-field
                                label="Site"
                                @click="pickFile('Site')"
                                v-model='dialog2_data.site.imageName'
                                prepend-icon='attach_file'></v-text-field>
                        <input
                                type="file"
                                style="display: none"
                                ref="Site"
                                @change="onFilePicked($event, 'site')"
                        >
                    </v-flex>
                </v-card-text>

                <v-divider></v-divider>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" flat @click="ImportFinalCSV()">
                        Import Final CSV
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
                dialog2:false,
                dialog1_data: {},
                dialog2_data: {
                    id:'',
                    report:{
                        imageName: '',
                        imageUrl: '',
                        imageFile: ''
                    },
                    site:{
                        imageName: '',
                        imageUrl: '',
                        imageFile: ''
                    }
                },
                docs:new FormData(),
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
                    .then(res =>{
                        this.dialog = false;
                        this.getLanguage()
                    })
            },
            edit_status(language, code, status){
                this.data.language = language;
                this.data.code = code;
                this.data.status = status;
                this.addOrUpdateLanguage()
                    .then(res => {
                        this.data.language = '';
                        this.data.code = '';
                        this.data.status = 0;
                        this.getLanguage()
                    })
            },
            addOrUpdateLanguage(){
                return Settings.add_language(this.data)
            },
            ImportFinalCSV(){
                let data = new FormData();
                data.append('import_report', this.dialog2_data.report.imageFile);
                data.append('import_site',   this.dialog2_data.site.imageFile);

                Settings.add_Document(data, this.dialog2_data.id)
                    .then(res => {
                        Object.keys(this.dialog2_data.report).forEach(item => {
                            this.dialog2_data.report[item] = null;
                            this.dialog2_data.site[item] = null;
                        });
                        this.dialog2 = false;
                    })
            },
            exportCSV(id){
                Settings.export(id)
                    .then(res => {
                        this.dialog1_data = res.data.data;
                        this.dialog1 = !this.dialog1;
                    })
            },
            download(name){
                window.location.href = this.dialog1_data[name];
                this.dialog1 = !this.dialog1;
            },
            pickFile (name) {
                this.$refs[name].click()
            },
            onFilePicked (e, type) {
                const files = e.target.files;
                if(files[0] !== undefined) {
                    this.dialog2_data[type].imageName = files[0].name;
                    if(this.dialog2_data[type].imageName.lastIndexOf('.') <= 0) {
                        return
                    }
                    this.dialog2_data[type].imageFile = files[0]
                } else {
                    this.dialog2_data[type].imageName = '';
                    this.dialog2_data[type].imageFile = '';
                    this.dialog2_data[type].imageUrl = '';
                }
            },
            importCSV(id){
                this.dialog2 = !this.dialog2;
                this.dialog2_data.id = id;
            }
        }
    }
</script>

<style scoped>

</style>
