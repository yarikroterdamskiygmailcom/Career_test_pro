<template>
    <div>
        <dx-data-grid
                :show-borders="true"
                :data-source="dataSource"
                :remote-operations="true"
                :height="600">
            <dx-column data-field="CustomerID" caption="Customer">
                <dx-string-length-rule :max="5" message="The field Customer must be a string with a maximum length of 5."/>
            </dx-column>
            <dx-column data-field="OrderDate" data-type="date">
                <dx-required-rule message="The OrderDate field is required."/>
            </dx-column>
            <dx-column data-field="Freight">
                <dx-header-filter :group-interval="100"/>
                <dx-range-rule :min="0" :max="2000" message="The field Freight must be between 0 and 2000."/>
            </dx-column>
            <dx-column data-field="ShipCountry">
                <dx-string-length-rule :max="15" message="The field ShipCountry must be a string with a maximum length of 15."/>
            </dx-column>
            <dx-filter-row :visible="true"/>
            <dx-header-filter :visible="true"/>
            <dx-group-panel :visible="true"/>
            <dx-scrolling mode="virtual"/>
            <dx-grouping :auto-expand-all="false"/>
        </dx-data-grid>
    </div>
</template>



<script>
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
    import { createStore } from 'devextreme-aspnet-data-nojquery'
    const dataSource = createStore({
        key: 'Value',
        loadUrl: `/api/invoices`,
        onBeforeSend: (method, ajaxOptions) => {
            ajaxOptions.xhrFields = { withCredentials: true };
        }
    });
    export default {
        name: "invoices",
        data(){
            return {
                dataSource
            }
        },
        created() {

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
