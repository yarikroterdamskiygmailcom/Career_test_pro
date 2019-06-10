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
            let lang = route && route.params && route.params.lang ? route.params.lang : '';
            const rout = route && route.path ? route.path.split('/')[1] : '';
            !lang ? lang = 'en': null;
            redirect(`/${rout}/${lang}`)
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
