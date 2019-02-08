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
    .text_style{
        font-family: Montserrat;
        font-style: normal;
    }
    .small_text{
        font-weight: 500;
        line-height: 29px;
        font-size: 16px;
        color: #333333;
        margin-top: 10px;
        margin-bottom: 20px;
    }
    .button_to{
        color:black;
        background: #85B1F5;
        height: 44px;
        padding: 0 30px;
        border-radius: 22px;
        box-shadow: 0 3px 7px rgba(0, 0, 0, 0.2);
    }
    .title_block{
        font-weight: 800;
        line-height: 51px;
        font-size: 28px;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        color: #333333;
    }
    .background_image{
        background-position: center;
        background-repeat: no-repeat;
    }
    .container_margin {
        width: 1140px;
        margin: 0 15px;
    }
    .elem_elipse{
        display: inline-block;
        position: absolute;
        content: '';
        right: 0;
        left: 0;
        width: 100%;
        height: 400px;
        background: white;
        background-position: -100px 0;
        background-repeat: no-repeat;
        -webkit-clip-path: ellipse(90% 70% at 0% 50%);
        clip-path: ellipse(65% 59% at 50% -30%);
        -webkit-shape-outside: ellipse(90% 70% at 0% 50%);
        shape-outside: ellipse(90% 56% at 0% 50%);
        -webkit-shape-margin: 2em;
        shape-margin: 2em;
    }
    .elem_elipse1{
        bottom: 0;
        transform: rotate(180deg);
    }
</style>
