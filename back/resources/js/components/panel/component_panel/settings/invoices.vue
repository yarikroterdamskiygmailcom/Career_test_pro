<template>
    <div class="demo-container">
        <v-flex xs12 sm6 md4>
        <v-dialog
                ref="dialog1"
                v-model="modal1"
                :return-value.sync="filter.from_date"
                persistent
                lazy
                full-width
                width="290px"
        >
            <template v-slot:activator="{ on }">
                <v-text-field
                        v-model="filter.from_date"
                        label="From Date"
                        prepend-icon="event"
                        readonly
                        v-on="on"
                ></v-text-field>
            </template>
            <v-date-picker v-model="filter.from_date" scrollable>
                    <v-spacer></v-spacer>
                    <v-btn flat color="primary" @click="modal1 = false">Cancel</v-btn>
                    <v-btn flat color="primary" @click="$refs.dialog1.save(filter.from_date)">OK</v-btn>
                </v-date-picker>
            </v-dialog>
        </v-flex>
        <v-flex xs12 sm6 md4>
            <v-dialog
                    ref="dialog"
                    v-model="modal2"
                    :return-value.sync="filter.to_date"
                    persistent
                    lazy
                    full-width
                    width="290px"
            >
                <template v-slot:activator="{ on }">
                    <v-text-field
                            v-model="filter.to_date"
                            label="To date"
                            prepend-icon="event"
                            readonly
                            v-on="on"
                    ></v-text-field>
                </template>
                <v-date-picker v-model="filter.to_date" scrollable>
                    <v-spacer></v-spacer>
                    <v-btn flat color="primary" @click="modal2 = false">Cancel</v-btn>
                    <v-btn flat color="primary" @click="$refs.dialog.save(filter.to_date)">OK</v-btn>
                </v-date-picker>
            </v-dialog>
        </v-flex>
        <v-btn color="blue" style="color: white" @click="refresh()">Filter</v-btn>
        <v-btn color="blue" style="color: white" @click="ClearData()">Clear</v-btn>
        <dx-data-grid
                :ref="dataGridRefName"
                :show-borders="true"
                :data-source="dataSource"
                :remote-operations="true"
                :height="600">
            <dx-column data-field="customer.name" caption="name">
            </dx-column>
            <dx-column data-field="customer.email" caption="email">
            </dx-column>
            <dx-column data-field="customer.card" caption="payment">
            </dx-column>
            <dx-column data-field="created_at" data-type="date" caption="data">
            </dx-column>
            <dx-column data-field="link" data-type="date" caption="data" cell-template="cellTemplate">
            </dx-column>
            <div slot="cellTemplate" slot-scope="data">
                <v-btn color="blue"
                       :href="linkGenerate(data.value)"
                       target="_blank"
                       style="color: white">
                    link
                </v-btn>
            </div>
            <dx-header-filter :visible="true"/>
            <dx-group-panel :visible="true"/>
            <dx-scrolling mode="virtual"/>
            <dx-grouping :auto-expand-all="false"/>
        </dx-data-grid>
    </div>
</template>



<script>
    // import 'vuetify/dist/vuetify.min.css'
    import {Settings} from "../../../../api/panel_settings/settings";
    import {
        DxDataGrid,
        DxColumn,
        DxEditing,
        DxFilterRow,
        DxHeaderFilter,
        DxGroupPanel,
        DxGrouping,
        DxScrolling,
        DxSummary,
        DxLookup,
        DxTotalItem,
        DxGroupItem,
        DxMasterDetail,
        DxStringLengthRule,
        DxRequiredRule,
        DxRangeRule,
        DxValueFormat
    } from 'devextreme-vue/data-grid';

    import {Token} from "../../../../store/localStorage";
    import ODataStore from "devextreme/data/odata/store";
    import CustomStore from 'devextreme/data/custom_store';
    import DataSource from "devextreme/data/data_source";
    export default {
        name: "invoices",
        data(){
            return {
                dataSource: new DataSource({
                    store: new CustomStore({
                        load:(d) =>{
                            return Settings.get_invoices(this.filter)
                                .then(res => {
                                    res.body = res.body.map(item => {
                                        item.link = {
                                            id:item.id,
                                            key:item.secret_link
                                        };
                                        return item;
                                    });
                                    return {
                                        data:res.body ? res.body : [],
                                        totalCount:res.body ? res.body.length : 0}
                                })
                        },
                    })
                }),
                dataGridRefName:'dataGridRefName',
                filter:{
                    from_date :'',
                    to_date:''
                },
                modal1:false,
                modal2:false
            }
        },
        created() {
            // this.dataSource = createStore({
            //     key: 'Value',
            //     loadUrl: `http://backcartestpro.qbex.io/api/invoices`,
            //     // onBeforeSend: (method, ajaxOptions) => {
            //     //     console.log('11');
            //     //     v
            //     //     ajaxOptions.data = ''
            //     // }
            // })

        },
        methods:{
            refresh(){
                this.$refs[this.dataGridRefName].instance.refresh()
            },
            ClearData(){
                this.filter.from_date = '';
                this.filter.to_date = '';
                this.$refs[this.dataGridRefName].instance.refresh()
            },
            linkGenerate(data){
               return `http://backcartestpro.qbex.io/api/pdf/${data.id}?result_key=${data.key}`
            }
        },
        components: {
            DxDataGrid,
            DxColumn,
            DxEditing,
            DxFilterRow,
            DxHeaderFilter,
            DxGroupPanel,
            DxGrouping,
            DxScrolling,
            DxSummary,
            DxLookup,
            DxTotalItem,
            DxGroupItem,
            DxMasterDetail,
            DxStringLengthRule,
            DxRangeRule,
            DxRequiredRule,
            DxValueFormat,
        },
    }
</script>

<style scoped>
</style>
