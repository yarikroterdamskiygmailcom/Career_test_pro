<template>
    <div class="tests">
        <component :is="component_active"></component>
    </div>
</template>

<script>
    import information_and_start from '../../components/test_page/information_and_start/index.vue';
    import steps from '../../components/test_page/steps/index.vue';
    import {Tag} from "../../helper/helpTegs";
    import {mapGetters} from "vuex";

    if (process.browser) {

    }
    export default {
        async fetch({redirect, store, test}) {
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
