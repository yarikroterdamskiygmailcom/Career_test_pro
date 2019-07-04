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
            Create URL
        </v-btn>
        <v-list two-line v-for="(item, index) in blocks" :key="item + index">
            <template >
                <v-list-tile>
                    <v-list-tile-content @click="open_modal(item, 'update')">
                        <v-list-tile-title>
                            <span style="color: red">
                                <strong>{{ item.page_alias }}</strong>
                            </span>
                        </v-list-tile-title>
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

                            v-model="data_modal.page_alias"
                            label="Title"
                            required>
                    </v-text-field>
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
                            v-model="data_modal.meta_data"
                            label="name"
                            trackBy="code"
                            tag-placeholder="Add this as new meta_description"
                            placeholder="Add this as new meta_description"
                            :options="[]"
                            :multiple="true"
                            :taggable="true"
                            @tag="addTag($event, 'meta_data')">
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
    import {Settings} from "../../../../api/panel_settings/settings";
    import Multiselect from 'vue-multiselect'
    const action = [ 'meta_title','meta_data', 'meta_keywords'];
    export default {
        name: "blog",
        components: {
            Multiselect,
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
                data_modal:{
                    page_alias: '',
                    meta_title:[],
                    meta_data:[],
                    meta_keywords: [],
                    language_id: '',
                    id: '',
                },
            }
        },
        created(){
console.log(111111);
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
                    this.get_meta_tags(this.language_id)
                });
        },
        methods:{
            get_meta_tags(index){
                Settings.get_meta_tags(index).then(res => this.blocks = res.body)
            },
            select_lang(){
                this.languages_list.forEach(item => item.language == this.language_name
                    ? this.language_id = item.id :null);
                this.language_id && this.get_blocks(this.language_id)
            },
            open_modal(item, EVENT){
                this.EVENT = EVENT;
                const data = this.data_modal;
                this.data_modal.language_id = this.language_id;
                if( this.EVENT == 'update') {
                    this.data_modal.page_alias = item && item.page_alias ? item.page_alias : '';
                    this.data_modal.id = item && item.id ? item.id : '';
                    action.forEach(type => data[type]
                    && Array.isArray(data[type])
                        ? data[type] = item[type] ? item[type].split(',').map(word => this.getNewTag(word)) : [] : null);
                    this.dialog = true;
                    return;
                }
                this.afterRequest();
                this.dialog = true;
            },
            event(){
                let data = this.data_modal;
                action.forEach(item => data[item] ? data[item] = data[item].map(tag => tag.name).join(',') : null);
                this.EVENT === 'update' ? this.update() : this.create_post();
            },
            update(){
                Settings.update_meta_tag(this.data_modal, this.data_modal.id).then(() => this.afterRequest(true))
            },
            create_post(){
                Settings.create_meta_tag(this.data_modal).then(() => this.afterRequest(true))
            },
            delete_post(id){
                Settings.delete_meta_tag(id).then(() => this.afterRequest(true))
            },
            afterRequest(type = null){
                type && this.get_meta_tags(this.language_id);
                const data = this.data_modal;
                this.data_modal.language_id = this.language_id;
                this.data_modal.page_alias = '';
                action.forEach(item => data[item] ? data[item] = [] : null);
                this.dialog = false;
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
        },
    }
</script>

<style scoped>

</style>
