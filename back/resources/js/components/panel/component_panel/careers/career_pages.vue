<template>
    <div>
        <h3>
            {{page ? 'List' : 'Career pages'}}
        </h3>
        <div>
            <v-flex xs12 sm6 d-flex data-app style="width: 200px;  margin: 10px 0">
                <v-select @change="select_lang()"
                          :items="languages"
                          v-model="language_name"
                          label="Select language"
                ></v-select>
            </v-flex>
            <v-btn color="green" v-if="page" flat @click="open_modal_add('add')">
                Add new career
            </v-btn>
        </div>

        <v-list two-line >
            <template v-for="(item, index) in careers">
                <v-list-tile
                        @click="open_modal(item.career_description,
                     index + 1,
                     item)">
                    <v-list-tile-content>
                        <v-list-tile-title>{{ item.id }}</v-list-tile-title>
                        <v-list-tile-sub-title v-if="item.career_description">
                            {{ item.career_description.career }}
                        </v-list-tile-sub-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-divider
                        v-if="index + 1 < careers.length"
                        :key="index">
                </v-divider>
            </template>
        </v-list>
        <v-btn color="blue" v-if="paginate.current_page != paginate.last_page" @click="download_career()">
            Download careers
        </v-btn>
        <v-dialog v-model="dialog" width="500">
            <v-card>
                <v-card-title class="headline grey lighten-2" primary-title>
                    <div style="margin-right: 20px" v-if="!dialog_status.value">№ {{data_modal.id}}</div>
                </v-card-title>
                <v-card-text>
                    <v-list-tile-title>
                        {{dialog_status.text}}
                    </v-list-tile-title>
                    <v-text-field
                            v-if="!page || page || dialog_status.value"
                            v-model="data_modal.career"
                            label="Career"
                    ></v-text-field>
                    <div v-if="error.career && error.career.status && dialog_status.value"
                         style="color:red; margin: 2px 0">
                        <div v-for="item in error.career.text">{{item}}</div>
                    </div>
                    <v-text-field
                            v-if="page || dialog_status.value"
                            v-model="data_modal.level"
                            label="Level"
                    ></v-text-field>
                    <div v-if="error.level && error.level.status && dialog_status.value"
                         style="color:red; margin: 2px 0">
                        <div v-for="item in error.level.text">{{item}}</div>
                    </div>
                    <v-text-field
                            v-if="page || dialog_status.value"
                            v-model="data_modal.education"
                            label="Education"
                    ></v-text-field>
                    <div v-if="error.education && error.education.status && dialog_status.value"
                         style="color:red; margin: 2px 0">
                        <div v-for="item in error.education.text">{{item}}</div>
                    </div>
                    <v-text-field
                            v-if="page || dialog_status.value"
                            v-model="data_modal.training"
                            label="Training"
                    ></v-text-field>
                    <div v-if="error.training && error.training.status && dialog_status.value"
                         style="color:red; margin: 2px 0">
                        <div v-for="item in error.training.text">{{item}}</div>
                    </div>
                    <v-text-field
                            v-if="page || dialog_status.value"
                            v-model="data_modal.code"
                            label="Code"
                    ></v-text-field>
                    <div v-if="error.code && error.code.text && dialog_status.value"
                         style="color:red; margin: 5px 0">
                        <div v-for="item in error.code.text">{{item}}</div>
                    </div>
                </v-card-text>

                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" flat @click="save(dialog_status.value ? 'add' :'update')">
                        Save
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
    import {Settings} from "../../../../api/panel_settings/settings";
    import {Careers} from "../../../../api/careers/career_pages";

    export default {
        name: "career_pages",
        data(){
            return {
                page:false,
                languages:[],
                languages_list:[],
                language_name:'',
                language_id:'',
                careers: [],
                paginate:{
                    current_page: 0,
                    last_page: 1
                },
                dialog: false,
                dialog_status: {
                    text: '',
                    value: false
                },
                data_modal:{
                    career: '',
                    number:'',
                    id:'',
                    language_id:'',
                    level:'',
                    education:'',
                    training: '',
                    code:''
                },
                error:{

                }
            }
        },
        created(){
            this.page = this.$router.history.current.path.split('/')[3] == 'list';
            Settings.list_language()
                .then(res => {
                    this.languages = res.body.map(item => item.language);
                    this.languages_list = res.body;
                    this.languages_list.forEach(item => {
                        if(item.id == this.languages_list[0].id) {
                            this.language_name = item.language;
                            this.language_id = item.id
                        }
                    });

                    this.get_careers(this.language_id)
                });
        },
        methods:{
            get_careers(id, status){
                Careers.get_careers(id, Number(this.paginate.current_page) + 1)
                    .then(res => {
                        this.paginate.current_page = res.body.current_page;
                        this.paginate.last_page = res.body.last_page;
                        this.careers = status == 'add' ?this.careers.concat(res.body.data) : res.body.data;
                    })
                    .catch(err => console.log(err));
            },
            download_career(){
                this.get_careers(this.language_id, 'add')
            },
            select_lang(){
                this.languages_list.forEach(item => {
                    if(item.language == this.language_name) this.language_id = item.id;
                });
                if(this.language_id){
                    this.get_careers(this.language_id, 'change')
                }
            },
            open_modal(item, number, career){
                this.dialog_status.value = false;
                this.dialog_status.text = 'Edit careers';
                this.data_modal.career = item ? item.career : '';
                this.data_modal.language_id  = this.language_id;
                this.data_modal.number = number;
                this.data_modal.id =  item ? item.career_id : '';
                this.data_modal.level = career.level;
                this.data_modal.education = career.education;
                this.data_modal.training = career.training;
                this.data_modal.code = career.code;
                this.dialog = true
            },
            open_modal_add(){
                this.dialog_status.text = 'Add careers';
                this.dialog_status.value = true;
                Object.keys(this.data_modal).forEach(item => {
                    item != 'number' && item == 'language_id'? this.data_modal[item] = '' : null;
                    console.log(item == 'language_id')
                    item == 'language_id' ? this.data_modal[item] = this.language_id : null
                });
                this.dialog = true
            },
            save(status){debugger;
                if(this.page){
                    if(status == 'update'){
                        Careers.save_career(this.data_modal.id, this.data_modal)
                            .then(res => {
                                this.careers[this.data_modal.number -1].career_description = res.body.data;
                                this.dialog = false
                            })
                    } else {
                        Careers.add_list(this.data_modal)
                            .then(res => {
                                Object.keys(this.error).forEach(item => {
                                    this.error[item] = {};
                                    this.error[item].text = '';
                                    this.error[item].status = false;
                                });
                                if(!res.body.success){
                                    let obj = {};
                                    Object.keys(res.body.data).forEach(item =>{
                                        obj[item] = {};
                                        obj[item].text = res.body.data[item];
                                        obj[item].status = true;
                                    });
                                    this.error = obj;
                                } else {
                                    res.body.data.id = res.body.data.career_id;
                                    this.careers.unshift(res.body.data);
                                    this.dialog = false
                                }
                            })
                    }
                } else {
                    Careers.save_career(this.data_modal.id,  this.data_modal)
                        .then(res => {
                            this.careers[this.data_modal.number -1].career_description = res.body.data;
                            this.dialog = false
                        })
                }

            }
        },
        watch:{
            '$route'(to, from){
                this.page = to.path.split('/')[3] == 'list';
            }
        }
    }
</script>

<style scoped>

</style>
