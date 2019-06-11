<template>
    <div>
        <h3>
            Price
        </h3>
        <div>
            <v-flex xs12 sm6 d-flex data-app style="width: 200px;  margin: 10px 0">
                <v-select @change="select_lang()"
                        :items="languages"
                        v-model="language_name"
                        label="Select language"
                ></v-select>
            </v-flex>

            <div v-if="active_input">
                <v-flex xs12 md4>
                    <v-text-field
                            v-model="data.price"
                            label="Price">
                    </v-text-field>
                </v-flex>
                <v-flex xs12 md4>
                    <v-text-field
                            v-model="data.currency"
                            label="Currency">
                    </v-text-field>
                </v-flex>
                <div>
                    <v-btn color="blue" style="color: white" @click="save_price()">Save</v-btn>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import {Settings} from "../../../../api/panel_settings/settings";

    export default {
        data(){
            return{
                languages:[],
                languages_list:[],
                active_input: false,
                language_name: '',
                data:{
                    language_id: '',
                    price: '',
                    currency:''
                }
            }
        },
        created(){
            Settings.list_language()
                .then(res => {
                    this.languages = res.body.map(item => item.language);
                    this.languages_list = res.body
                })
        },
        methods:{
            select_lang(){
                this.data.price = '';
                this.data.currency ='';
                this.data.language_id = '';
                this.active_input = false;
                this.languages_list.forEach(item => {
                    if(item.language == this.language_name) this.data.language_id = item.id;
                });
                Settings.get_price_in_language(this.data.language_id)
                    .then(res => {
                        if(Object.keys(res.body).length != 0){
                            this.data.price = res.body.value;
                            this.data.currency = res.body.currency;
                        }
                        this.active_input = true;
                    })
                    .catch(err => console.log(err))
            },
            save_price(){
                Settings.seve_price_in_language(this.data)
                    .then(res => {
                        console.log(res)
                    })
                    .catch(err => console.log(err))
            }
        }
    }
</script>

<style scoped lang="scss"></style>
