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
    import More_in_your_personality from './More_in_your_personality/index'
    import Goal_and_benefits from './goal_and_benefits/index'
    import How_does_it_work from './how_does_it_work/index'
    import All_aptitude_test from './all_aptitude_test/index'
    import Have_any_questions from './have_any_questions/index'

    export default {
        name: "HomePage",
        components:{
            'More_in_your_personality_component':  More_in_your_personality,
            'Goal_and_benefits_component':         Goal_and_benefits,
            'How_does_it_work_component':          How_does_it_work,
            'All_aptitude_test_component':         All_aptitude_test,
            'Have_any_questions_component':        Have_any_questions
        }
    }
</script>

<style>
    #home{
        width: 100%;
    }

</style>
