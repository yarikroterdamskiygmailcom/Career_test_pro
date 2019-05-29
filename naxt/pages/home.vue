<template>
    <div id="home" class="text_style">
          <More_in_your_personality_component></More_in_your_personality_component>
          <Goal_and_benefits_component></Goal_and_benefits_component>
          <How_does_it_work_component></How_does_it_work_component>
          <All_aptitude_test_component></All_aptitude_test_component>
          <Have_any_questions_component></Have_any_questions_component>
    </div>
</template>

<script>
    import vue from "vue";
    import More_in_your_personality from '../components/home_page/More_in_your_personality'
    import Goal_and_benefits from '../components/home_page/goal_and_benefits'
    import How_does_it_work from '../components/home_page/how_does_it_work'
    import All_aptitude_test from '../components/home_page/all_aptitude_test'
    import Have_any_questions from '../components/home_page/have_any_questions'
    import {mapGetters} from "vuex";
    import {Tag} from "../helper/helpTegs";
    if (process.browser) {
        if (vue && vue.$store) {
            vue.$store.dispatch('modal_data/action_screen', {
                value: window.innerWidth,
                active: window.innerWidth < 1100
            });
        }
    }
    export default {
        name: "HomePage",
        async fetch({redirect, store, route}) {
            const data = await store.dispatch('multilanguage/ssrRender');
            await store.dispatch('questions/action_questions', data);
            const meta = await store.dispatch('meta/action_tegs', {
                store:store.getters['multilanguage/get_language_now'],
                page:route.fullPath ? route.fullPath.split('/')[1] : ''
            })
            return meta;
        },
        head () {
            return {
                meta: Tag.getArrayTags(this.meta),
            }
        },
        computed: {
            ...mapGetters({
                screen: 'modal_data/get_screen',
                meta: 'meta/get_meta'
            })
        },
        components:{
            'More_in_your_personality_component':  More_in_your_personality,
            'Goal_and_benefits_component':         Goal_and_benefits,
            'How_does_it_work_component':          How_does_it_work,
            'All_aptitude_test_component':         All_aptitude_test,
            'Have_any_questions_component':        Have_any_questions
        },
    }
</script>

<style>
    #home{
        width: 100%;
    }

</style>
