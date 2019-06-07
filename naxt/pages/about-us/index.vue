<template>
    <div id="about_us">
        <Block_with_tabs_component></Block_with_tabs_component>
    </div>
</template>

<script>
    import block_with_tabs from '../../components/about_us_page/block_with_tabs'
    import {Tag} from "../../helper/helpTegs";
    import {mapGetters} from "vuex";
    import {RETURN_ROUTER} from "../../helper/routerHelp";
    const {base64encode, base64decode} = require('nodejs-base64');
    export default {
        async fetch({redirect, store, route, commit,req}) {
            if(store.getters['multilanguage/get_tests']) {
                store.commit('multilanguage/change_state', {
                    data: true,
                    name: 'active'
                });
                return;
            }
            store.commit('multilanguage/change_state', {
                data: store.getters['multilanguage/get_tests'] + 1,
                name: 'tests'
            });
            let lang = route.query.lang;
            const rout = route && route.fullPath ? route.fullPath.split('/')[1] : '';
            !lang ? lang = 'en' : null;
            const data = await store.dispatch('multilanguage/ssrRender', {lang, rout, redirect});
            await store.dispatch('questions/action_questions', data);
            const res =  await store.dispatch('meta/action_tegs', {
                store:lang ? lang : store.getters['multilanguage/get_language_now'],
                page:rout
            });
            store.commit('multilanguage/change_state', {
                data: true,
                name: 'active'
            });
        },
        created(){
            try {
                const resRout = RETURN_ROUTER.initRouter(this.$router.history.current);
                if (resRout) window.location.href = `/?rout=${base64encode(resRout)}`;
            } catch (e) {}
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
