<template>
    <div>
        <div>
            <v-flex xs12 sm6 d-flex data-app style="width: 200px;  margin: 10px 0">
                <v-select @change="select_lang()"
                          :items="languages"
                          v-model="language_name"
                          label="Select language"
                ></v-select>
            </v-flex>
        </div>

        <v-list two-line v-for="(item, index) in blocks" :key="item + index">
            <template >
                <v-list-tile
                        @click="open_modal(item, index)">
                    <v-list-tile-content>
                        <v-list-tile-title>
                            <span style="color: red">
                                <strong>{{ item.name }}</strong>
                            </span>
                        </v-list-tile-title>
                        <v-list-tile-sub-title
                                v-if="item.site_description && item.site_description.value"
                                v-html="item.site_description.value">
                        </v-list-tile-sub-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-divider
                        v-if="index + 1 < blocks.length"
                        :key="index">
                </v-divider>
            </template>
        </v-list>
        <v-dialog v-model="dialog" width="1000">
            <v-card>
                <v-card-title class="headline grey lighten-2" primary-title>
                    <div style="margin-right: 20px">{{data_modal.name}}</div>
                </v-card-title>
                <v-card-text>
                    <v-flex v-if="data_modal.dropdown"
                            xs12 sm6 d-flex data-app style="width: 200px;  margin: 10px 0">
                        <v-select @change="select_item_letter()"
                                  :items="letters"
                                  v-model="data_modal.letter"
                                  label="Select language"
                        ></v-select>
                    </v-flex>
                    <vue-editor
                            :editorToolbar="customToolbar"
                            v-model="data_modal.value">
                    </vue-editor>
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
    import { VueEditor } from 'vue2-editor'
    import Editor from '@tinymce/tinymce-vue';
    import {Report} from "../../../../api/report/report";
    import {Settings} from "../../../../api/panel_settings/settings";
    export default {
        name: "site",
        data(){
            return {
                customToolbar: [
                    [{ 'font': [] }],
                    [{ 'header': [false, 1, 2, 3, 4, 5, 6, ] }],
                    [{ 'size': ['small', false, 'large', 'huge'] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{'align': ''}, {'align': 'center'}, {'align': 'right'}, {'align': 'justify'}],
                    [{ 'header': 1 }, { 'header': 2 }],
                    ['blockquote', 'code-block'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'list': 'check' }],
                    [{ 'script': 'sub'}, { 'script': 'super' }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],
                    [{ 'color': [] }, { 'background': [] }],
                    ['link', 'image', 'video', 'formula'],
                    [{ 'direction': 'rtl' }],
                    ['clean'],
                ],
                letters:['R','I', 'A', 'S', 'O', 'C'],
                languages:[],
                languages_list:[],
                language_name:'',
                language_id:'',
                blocks: [],
                dialog: false,
                data_modal:{
                    name: '',
                    value:'',
                    language_id:'',
                    index:'',
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
                    this.get_blocks(this.language_id)
                });
        },
        methods:{
            get_blocks(index){
                Settings.get_site(index)
                    .then(res => {
                        console.log(res)
                        this.blocks = res.body
                    })
            },
            select_lang(){
                this.languages_list.forEach(item => {
                    if(item.language == this.language_name) this.language_id = item.id;
                });
                if(this.language_id){
                    this.get_blocks(this.language_id)
                }
            },
            open_modal(item, index){
                this.data_modal.name = item ? item.name : '';
                this.data_modal.value = item.site_description ? item.site_description.value : '';
                this.data_modal.language_id  = this.language_id;
                this.data_modal.index  = index;
                this.data_modal.id  = item.id;
                this.dialog = true
            },
            save(){
                Settings.update_site(this.data_modal, this.data_modal.id)
                    .then(res => {
                        this.get_blocks(this.language_id);
                        this.dialog = false;
                    })
            },
        },
        components: {
            VueEditor// <- Important part
        }
    }
</script>

<style scoped>

</style>
