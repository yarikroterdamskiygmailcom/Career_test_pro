<!--<template>-->
    <!--<div>-->
        <!--<vue-editor id="editor1"></vue-editor>-->
    <!--</div>-->
<!--</template>-->

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
        <v-btn color="blue" flat @click="open_modal(data_modal, 'save')">
            Create Post
        </v-btn>
        <v-list two-line v-for="(item, index) in blocks" :key="item + index">
            <template >
                <v-list-tile>
                    <v-list-tile-content @click="open_modal(item, 'update')">
                        <v-list-tile-title>
                            <span style="color: red">
                                <strong>{{ item.title }}</strong>
                            </span>
                        </v-list-tile-title>
                        <v-list-tile-sub-title
                                v-if="item.body"
                                v-html="item.body.substring(0, 300)">
                        </v-list-tile-sub-title>
                    </v-list-tile-content>
                    <v-btn color="primary" flat @click="delete_post(item.id)">
                        Delete
                    </v-btn>
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
                    <v-text-field

                            v-model="data_modal.title"
                            label="Title"
                            required>
                    </v-text-field>
                    <vue-editor id="editor1" :values="data_modal.body"
                         @input="getDataEditor($event)"></vue-editor>
                    <br>
                    <multiselect
                        v-model="data_modal.meta_title"
                        label="name"
                        trackBy="code"
                        tag-placeholder="Add this as new meta_title"
                        placeholder="Add this as new meta_title"
                        :options="[]"
                        :multiple="true"
                        :taggable="true"
                        @tag="addTag($event, 'meta_title')">
                    </multiselect>
                    <br>
                    <multiselect
                        v-model="data_modal.meta_description"
                        label="name"
                        trackBy="code"
                        tag-placeholder="Add this as new meta_description"
                        placeholder="Add this as new meta_description"
                        :options="[]"
                        :multiple="true"
                        :taggable="true"
                        @tag="addTag($event, 'meta_description')">
                    </multiselect>
                    <br>
                    <multiselect
                        v-model="data_modal.meta_keywords"
                        label="name"
                        trackBy="code"
                        tag-placeholder="Add this as new meta_keywords"
                        placeholder="Add this as new meta_keywords"
                        :options="[]"
                        :multiple="true"
                        :taggable="true"
                        @tag="addTag($event, 'meta_keywords')">
                    </multiselect>
                    <br>
                    <multiselect
                        v-model="data_modal.tags"
                        label="name"
                        trackBy="code"
                        tag-placeholder="Add this as new tag"
                        placeholder="Add this as new tag"
                        :options="[]"
                        :multiple="true"
                        :taggable="true"
                        @tag="addTag($event, 'tags')">
                    </multiselect>
                    <br>
                    <upload-btn color="red"
                                v-model="data_modal.image.name"
                                @file-update="updateFile">
                    </upload-btn>
                    <img v-if="image"
                         style="max-width: 100%"
                         :src="image">
                    <v-btn color="primary" flat @click="image = ''">
                        Clear image
                    </v-btn>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" flat @click="event()">
                        Save
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>
<script>
    import Vue from 'vue'
    import vueEditor from './helper/vueEditor'
    import {Settings} from "../../../../api/panel_settings/settings";
    import Multiselect from 'vue-multiselect'
    import UploadButton from 'vuetify-upload-button';
    const action = ['tags', 'meta_title','meta_description', 'meta_keywords'];
    export default {
        name: "blog",
        components: {
            vueEditor,
            Multiselect,
            'upload-btn': UploadButton
        },
        data(){
            return {
                languages:[],
                languages_list:[],
                language_name:'',
                language_id:'',
                blocks: [],
                dialog: false,
                EVENT: false,
                items: ['fffff'],
                value: '',
                image: '',
                data_modal:{
                    title: '',
                    body:'',
                    id:'',
                    language_id:'',
                    meta_title:[],
                    meta_description:[],
                    meta_keywords: [],
                    tags:[],
                    image:{
                        name:''
                    },
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
                Settings.get_posts(index)
                    .then(res => {
                        this.blocks = res.body
                    })
            },
            select_lang(){
                this.languages_list.forEach(item => item.language == this.language_name
                    ? this.language_id = item.id :null);
                this.language_id && this.get_blocks(this.language_id)
            },
            open_modal(item, EVENT){
                this.EVENT = EVENT;
                const data = this.data_modal;
                if( this.EVENT == 'update') {
                    data.title = item && item.title ? item.title : '';
                    data.body = item && item.body ? item.body : '';
                    data.language_id = this.language_id;
                    action.forEach(type => data[type]
                        && Array.isArray(data[type])
                        ? data[type] = item[type].split(',').map(word => this.getNewTag(word)) : null);
                    data.image = item && item.image ? item.image : '';
                    data.id = item && item.id ? item.id : '';
                    this.image = item && item.image && typeof item.image == 'string' ? item.image : '';
                    this.dialog = true;
                    return
                }
                data.language_id = this.language_id;
                // this.afterRequest()
                this.dialog = true;
            },
            event(){
                let data = this.data_modal;
                action.forEach(item => data[item] ? data[item] = data[item].map(tag => tag.name).join(',') : null);
                this.EVENT === 'update' ? this.update() : this.create_post();
            },
            update(){
                Settings.update_posts(this.data_modal, this.data_modal.id).then(() => this.afterRequest())
            },
            create_post(){
                Settings.create_posts(this.data_modal).then(() => this.afterRequest())
            },
            delete_post(id){
                Settings.delete_posts(id).then(() => this.afterRequest())
            },
            afterRequest(){
                this.get_blocks(this.language_id);
                const data = this.data_modal;
                ['title', 'body', 'image', 'id'].forEach(item => data[item] ? data[item] ='' : null);
                this.data_modal.language_id = this.language_id;
                this.image                  = '';
                action.forEach(item => data[item] ? data[item] = [] : null);
                this.dialog = false;
            },
            getDataEditor(data){
                this.data_modal.body = data
            },
            addTag (newTag, type) {
                const tag = this.getNewTag(newTag);
                this.data_modal[type]  && Array.isArray(this.data_modal[type]) && this.data_modal[type].push(tag)
            },
            getNewTag(newTag){
                return {
                    name: newTag,
                    code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
                }
            },
            updateFile (file) {
                let reader = new FileReader();
                reader.onload =  (e) => {
                    this.data_modal.image = e.target.result;
                    this.image = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
    }
</script>

<style scoped>

</style>
