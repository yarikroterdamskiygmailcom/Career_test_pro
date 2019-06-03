<template>
    <div class="tests">
        <component :is="component_active"></component>
    </div>
</template>

<script>
    import information_and_start from '../../../components/test_page/information_and_start/index.vue';
    import steps from '../../../components/test_page/steps/index.vue';
    import {Tag} from "../../../helper/helpTegs";
    import {mapGetters} from "vuex";
    import {nuxtServerInit} from "../../../store/helpers/initServer";

    export default {
        async fetch({redirect, store, route, commit,req}) {
            const lang = nuxtServerInit(store,req);
            const data = await store.dispatch('multilanguage/ssrRender', lang);
            await store.dispatch('questions/action_questions', data);
            const step = route.params.steps;
            const step_child = route.params.child_step;
            !step_child && redirect(`/tests/${step}/1`);
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
        name: "TestPage",
        components:{
            'information_and_start-component' : information_and_start,
            'steps-component' : steps,
        },
        data () {
            return {}
        },
        computed:{
            component_active(){
                return Object.keys(this.$route.params).length == 0
                    ?
                    'information_and_start-component'
                    :
                    'steps-component'
            },
            ...mapGetters({
                meta: 'meta/get_meta'
            })
        },
    }
</script>

<style scoped>

</style>
