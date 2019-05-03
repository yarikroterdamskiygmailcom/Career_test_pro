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
    <!--<div>Welcome to <strong>CareertestPro.com</strong>, the most comprehensive international career-->

        <!--test available online!</div><br>-->



    <!--<div>CareertestPro.com uses a database of over  <strong>3,000 professions</strong>-->

        <!--and corresponding educational levels.</div><br>-->



    <!--<div>Taking the test will take you about 15 minutes.</div><br>-->



    <!--<div>The test consist of  <strong>10 Steps</strong>-->

        <!--with 30 questions in each step,  <strong>regard to skills, work values,-->

            <!--activities, personal behavior and professions:</strong></div><br>-->



    <!--<div> <strong>Step 1</strong>  and  <strong>Step 2</strong> include questions regard-->

        <!--to  <strong>skills.</strong></div>-->

    <!--<div> <strong>Step 3</strong> and  <strong>Step 4</strong> - questions regard to-->

        <!--<strong>work values.</strong></div>-->

    <!--<div> <strong>Step 5</strong> and  <strong>Step 6</strong> - questions regard to-->

        <!--<strong>activities.</strong></div>-->

    <!--<div> <strong>Step 7</strong> and  <strong>Step 8</strong> - questions regard to-->

        <!--<strong>personal behavior.</strong></div>-->

    <!--<div> <strong>Step 9</strong> and  <strong>Step 10</strong> - questions regard to-->

        <!--<strong>occupations (professions).</strong></div><br>-->

    <!--<div>When clicking on the  <strong>“Let’s Go!” button</strong> below, there will be a list of-->

        <!--questions,-->

        <!--which you need to answer one by one.</div><br>-->

    <!--<div>It’s up to you to be as accurate as possible in your answers to the statements.</div><br>-->

    <!--<div>Before every questionnaire there is a  <strong>brief explanation</strong>-->

        <!--<div class="info">i</div>of it purpose and what action-->

        <!--is required from you.</div><br>-->

    <!--<div>It’s important to read the given statements carefully-->

        <!--and follow with your intuition when answering.</div><br>-->

    <!--<div>After completing the test you’ll receive the report.</div>-->
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
                    [{ 'color': ['#F9892E'] },{ 'color': [] }, { 'background': [] }],
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
                this.data_modal.value = item.site_description
                    ? item.site_description.value
                    : '';
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
