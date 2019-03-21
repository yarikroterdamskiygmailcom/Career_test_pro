<template>
    <div>
        <h3>Categories</h3>
        <v-flex xs12 sm6 d-flex data-app style="width: 200px;  margin: 10px 0">
            <v-select @change="select_lang()"
                      :items="languages"
                      v-model="language_name"
                      label="Select language"
            ></v-select>
        </v-flex>
        <v-list two-line>
            <template v-for="(item, index) in categories">
                <v-list-tile
                        @click="open_modal(item.categories_description,
                        index + 1,
                        item.id)">
                    <v-list-tile-content>
                        <v-list-tile-title>{{ index + 1 }}</v-list-tile-title>
                        <v-list-tile-sub-title class="text--primary" v-if="item.categories_description">
                            {{ item.categories_description.name }}
                        </v-list-tile-sub-title>
                        <v-list-tile-sub-title v-if="item.categories_description">
                            <!--{{ item.categories_description.description }}-->
                        </v-list-tile-sub-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-divider
                        v-if="index + 1 < categories.length"
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
                    <v-text-field
                            v-model="data_modal.name"
                            label="Category name"
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
    import {Category} from "../../../../api/panel_test/categories";

    export default {
        name: "categories",
        data(){
            return{
                categories:[],
                language_name: '',
                language_id: '',
                languages:[],
                dialog:false,
                data_modal:{
                    name:'',
                    language_id:'',
                    number:'',
                    category_id: ''
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
                    this.get_categories(this.languages_list[0].id)
                });
        },
        methods:{
            select_lang(){
                this.languages_list.forEach(item => {
                    if(item.language == this.language_name) this.language_id = item.id;
                });
                if(this.language_id){
                    this.get_categories(this.language_id)
                }
            },
            get_categories(id){
                Category.get_categories(id)
                    .then(res => {
                        this.categories = res.body
                    })
            },
            open_modal(item,number,id){
                this.data_modal.name = item ? item.name: '';
                this.data_modal.number = number;
                this.data_modal.language_id = this.language_id;
                this.data_modal.category_id = id;
                this.dialog = true;
            },
            save(){
                Category.save_categories(this.data_modal.category_id, this.data_modal)
                    .then(res => {
                        if(this.language_id){
                            this.get_categories(this.language_id)
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
                    })
            }
        }
    }
</script>

<style scoped>

</style>
