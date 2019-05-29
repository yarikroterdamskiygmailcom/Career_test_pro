<template>
    <div id="about_us">
        <Block_with_tabs_component></Block_with_tabs_component>
    </div>
</template>

<script>
    import block_with_tabs from '../components/about_us_page/block_with_tabs'
    import {Tag} from "../helper/helpTegs";
    import {mapGetters} from "vuex";
    export default {
        async fetch({redirect, store, route}) {
            const data = await store.dispatch('multilanguage/ssrRender');
            await store.dispatch('questions/action_questions', data);
            const meta = await store.dispatch('meta/action_tegs', {
                store:store.getters['multilanguage/get_language_now'],
                page:route.fullPath ? route.fullPath.split('/')[1] : ''
            })
        },
        head () {
            return {
                meta: Tag.getArrayTags(this.meta),
            }
        },
        components:{
            'Block_with_tabs_component' : block_with_tabs
        },
        computed:{
            ...mapGetters({
                meta: 'meta/get_meta'
            })
        }
    }
</script>

<style>

</style>
