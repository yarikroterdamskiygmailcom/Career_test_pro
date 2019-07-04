<template>
    <div>
        <h3>
            Text for Scores
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
            <template v-for="(item, index) in text_for_scores">
                <v-list-tile
                        @click="open_modal(item,
                     index + 1)">
                    <v-list-tile-content>
                        <v-list-tile-title>{{ index+1}}</v-list-tile-title>
                        <v-list-tile-sub-title v-if="item.result_description">
                            {{ item.result_description.text }}
                        </v-list-tile-sub-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-divider
                        v-if="index + 1 < text_for_scores.length"
                        :key="index">
                </v-divider>
            </template>
        </v-list>
        <v-dialog v-model="dialog" width="500">
            <v-card>
                <v-card-title class="headline grey lighten-2" primary-title>
                    <div style="margin-right: 20px" >{{data_modal.number}}</div>
                </v-card-title>
                <v-card-text>
                    <v-textarea
                            v-model="data_modal.text"
                            label="Career"
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
    import {Settings} from "../../../../api/panel_settings/settings";
    import {Scoretext} from "../../../../api/report/text_for_scores";


    export default {
        name: "career_pages",
        data(){
            return {
                page:false,
                languages:[],
                languages_list:[],
                language_name:'',
                language_id:'',
                text_for_scores: [],
                dialog: false,
                data_modal:{
                    text: '',
                    number:'',
                    language_id:'',
                    result_id:'',
                },
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
                    this.get_scoretext(this.language_id)
                });
        },
        methods:{
            get_scoretext(id){
                Scoretext.get_scoretext(id)
                    .then(res => {
                        this.text_for_scores = res.body
                    })
                    .catch(err => console.log(err));
            },
            select_lang(){
                this.languages_list.forEach(item => {
                    if(item.language == this.language_name) this.language_id = item.id;
                });
                if(this.language_id){
                    this.get_scoretext(this.language_id)
                }
            },
            open_modal(item, number){
                this.data_modal.text = item.result_description ? item.result_description.text : '';
                this.data_modal.result_id = item.result_description ? item.result_id : item.id;
                this.data_modal.language_id  = this.language_id;
                this.data_modal.number = number;
                this.dialog = true
            },
            open_modal_add(){
                Object.keys(this.data_modal).forEach(item => {
                    item != 'number' && item == 'language_id'? this.data_modal[item] = '' : null;
                    console.log(item == 'language_id')
                    item == 'language_id' ? this.data_modal[item] = this.language_id : null
                });
                this.dialog = true
            },
            save(){
                Scoretext.save_scoretext(this.data_modal.result_id, this.data_modal)
                    .then(res => {
                        this.get_scoretext(this.language_id);
                        this.dialog = false
                    });
            }
        },
    }
</script>

<style scoped>

</style>
