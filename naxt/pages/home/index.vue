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
    import More_in_your_personality from '../../components/home_page/More_in_your_personality'
    import Goal_and_benefits from '../../components/home_page/goal_and_benefits'
    import How_does_it_work from '../../components/home_page/how_does_it_work'
    import All_aptitude_test from '../../components/home_page/all_aptitude_test'
    import Have_any_questions from '../../components/home_page/have_any_questions'
    import {mapGetters} from "vuex";
    import {Tag} from "../../helper/helpTegs";
    import {RETURN_ROUTER} from "../../helper/routerHelp";

    if (process.browser) {
        if (vue && vue.$store) {
            vue.$store.dispatch('modal_data/action_screen', {
                value: window.innerWidth,
                active: window.innerWidth < 1100
            });
        }
    }
    const {base64encode, base64decode} = require('nodejs-base64');
    export default {
        name: "HomePage",
        async fetch({redirect, store, route, $warehouse, $cookies, req, params}) {
            if (store.getters['multilanguage/get_tests']) {
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
            const rout = route && route.path ? route.path.split('/')[3] : '';
            !lang ? lang = 'en': null;
            const data = await store.dispatch('multilanguage/ssrRender', {lang, rout, redirect});
            await store.dispatch('questions/action_questions', data);
            const res = await store.dispatch('meta/action_tegs', {
                store: lang ? lang : store.getters['multilanguage/get_language_now'],
                page: rout
            });
            store.commit('multilanguage/change_state', {
                data: true,
                name: 'active'
            });
        },
        head() {
            return {
                meta: Tag.getArrayTags(this.meta),
            }
        },
        created() {
            try {
                const resRout = RETURN_ROUTER.initRouter(this.$router.history.current);
                if (resRout) window.location.href = `/?rout=${base64encode(resRout)}`;
            } catch (e) {}
        },
        computed: {
            ...mapGetters({
                screen: 'modal_data/get_screen',
                meta: 'meta/get_meta'
            })
        },
        components: {
            'More_in_your_personality_component': More_in_your_personality,
            'Goal_and_benefits_component': Goal_and_benefits,
            'How_does_it_work_component': How_does_it_work,
            'All_aptitude_test_component': All_aptitude_test,
            'Have_any_questions_component': Have_any_questions
        },
    }
</script>

<style>
    #home {
        width: 100%;
    }

</style>
