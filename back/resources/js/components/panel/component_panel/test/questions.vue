<template>
    <div>
        <h3>Questions</h3>
        <v-flex xs12 sm6 d-flex data-app style="width: 200px;  margin: 10px 0">
            <v-select @change="select_lang()"
                      :items="languages"
                      v-model="language_name"
                      label="Select language"
            ></v-select>
        </v-flex>
        <v-list two-line>
            <template v-for="(item, index) in questions">
                <v-list-tile
                    @click="open_modal(item.questions_description,
                     item.category_id,
                     index + 1,
                     item.id)">
                    <v-list-tile-content>
                        <v-list-tile-title>{{ index + 1 }}</v-list-tile-title>
                        <v-list-tile-sub-title v-if="item.questions_description">
                            {{ item.questions_description.question }}
                        </v-list-tile-sub-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-divider
                        v-if="index + 1 < questions.length"
                        :key="index">
                </v-divider>
            </template>
        </v-list>
        <v-dialog v-model="dialog" width="500">
            <v-card>
                <v-card-title class="headline grey lighten-2" primary-title>
                    <div style="margin-right: 20px">№ {{data_modal.number}}</div>
                </v-card-title>
                <v-card-text>
                    <h2 style="margin-bottom: 20px">Category: {{data_modal.category}} </h2>
                    <v-textarea
                            outline
                            name="input-7-4"
                            label="Text questions"
                            v-model="data_modal.question"
                    ></v-textarea>
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
    import { Test } from "../../../../api/panel_test/test";
    import { Settings } from "../../../../api/panel_settings/settings";

    export default {
        data(){
            return {
                languages:[],
                languages_list:[],
                language_name:'',
                questions:[],
                categories:[],
                dialog:false,
                language_id: null,
                data_modal:{
                    question: '',
                    category:'',
                    number:'',
                    id:'',
                    language_id:''
                },
            }
        },
        computed:{
            alert_color(){
                return  this.alert.status ? 'green' : 'red'
            }
        },
        created(){
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
                    this.get_questions(this.languages_list[0].id)
                });
        },
        methods:{
            find_name_category(id){
                let name = null;
                this.categories.forEach(item => {
                    if(item.category_id == id) name = item.name
                });
                return name ? name : '';
            },
            get_questions(id){
                Test.get_questions(id)
                    .then(res => {
                        this.questions = res.body.questions;
                        this.categories = res.body.categories;
                    })
                    .catch(err => console.log(err));
            },
            select_lang(){
                this.languages_list.forEach(item => {
                    if(item.language == this.language_name) this.language_id = item.id;
                });
                if(this.language_id){
                    this.get_questions(this.language_id)
                }
            },
            open_modal(text, category_id, number_questions, id){
                this.data_modal.question =    text ? text.question : '';
                this.data_modal.category =    this.find_name_category(category_id);
                this.data_modal.number =      number_questions;
                this.data_modal.language_id = this.language_id;
                this.data_modal.id =          id;
                this.dialog = true
            },
            save(){
                Test.save_questions(this.data_modal.id, this.data_modal)
                    .then(res => {
                        if(this.language_id){
                            this.get_questions(this.language_id)
                        }
                        this.dialog = false
                    })
                    .catch(err => {
                        this.alert.active_alert = true;
                        this.alert.text = 'Test change don`t save';
                        this.alert.status = false;
                        setTimeout(() => {
                            this.alert.active_alert = false;
                            this.dialog = false
                        }, 3000);
                    });
            }
        }
    }
</script>

<style scoped>

</style>
