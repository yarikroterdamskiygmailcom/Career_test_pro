<template>
    <div id="about_us">
        <Block_with_tabs_component></Block_with_tabs_component>
    </div>
</template>

<script>
    import block_with_tabs from '../components/about_us_page/block_with_tabs'
    import {Tag} from "../helper/helpTegs";
    import {mapGetters} from "vuex";
    import {nuxtServerInit} from "../store/helpers/initServer";
    export default {
        async fetch({redirect, store, route, commit,req}) {
            const lang = nuxtServerInit(store,req);
            if(!lang) return;
            const data = await store.dispatch('multilanguage/ssrRender', lang);
            await store.dispatch('questions/action_questions', data);
            const res =  await store.dispatch('meta/action_tegs', {
                store:lang,
                page:route.fullPath ? route.fullPath.split('/')[1] : ''
            });
            if(res) store.commit('multilanguage/change_state', {
                data: true,
                name: 'active'
            });
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
