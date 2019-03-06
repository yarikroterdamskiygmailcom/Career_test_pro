<template>
    <div id="faq" class="d-flex justify-content-center flex-column align-items-center">
        <block_with_acordeon_component></block_with_acordeon_component>
        <div class="container_faq_acordeon">
            <acordeon_component v-for="(item, index) in list_acordeon"
                   :item_acordeon="item" :position="index"
                   :key="index"  @open_item_acordeon="open($event)">
            </acordeon_component>
        </div>
    </div>
</template>

<script>
    import Block_with_acordeon from './block_with_acordeon/index.vue'
    import Acordeon from './acordeon/index.vue'
    export default {
        name: "FaqPage",
        data (){
            return {
                list_acordeon: [
                    {
                        active:false,
                        name:'Which method does CareertestPro use?',
                        content: '<p>CareertestPro is based on the theory of the Holland Codes or the Holland ' +
                            'Occupational Themes (RIASEC).</p><p> This theoretical framework was developed by J.L. Holland ' +
                            'and refers to a theory of careers and vocational choice based upon personality types.</p>' +
                            '<p> Each' +
                            ' letter of the RIASEC code stands for a particular personality type, being:</p>',
                        list: [
                            'Realistic personality type (Doers);',
                            'Investigative personality type (Thinkers);',
                            'Artistic personality type (Creators);',
                            'Social personality type (Helpers);',
                            'Enterprising personality type (Persuaders);',
                            'Conventional personality type (Organizers).',
                        ],
                        content2: '<p>All RIASEC Personality types are discussed separately with regard to your personal' +
                            ' score on skills, (work) values, activities, personal behavior and professions. The RIASEC' +
                            ' method is one of the most extensively researched and used test in personality psychology.</p><p> ' +
                            'The theory assumes that everyone has an inner predisposition for certain professions.' +
                            ' By means of six different personality characteristics, which are described above, your ' +
                            'unique personality profile is comprised.</p><p> Due to the fact that each person is unique, ' +
                            'everyone will generate a different personality profile. The career test on ' +
                            'CareertestPro creates a personalized three-lettercode, based on 3 of the ' +
                            '6 RIASEC personality types.</p><p> This three-letter code is based on a primary ' +
                            'personality type, a secondary personality type and a tertiary personality ' +
                            'type. Obviously, the primary personality type is the one you high-scored. ' +
                            'The secondary is your second score, and self-evident, the tertiary your third. </p><p>'
                    },{
                        active:false,
                        name:'Who can take the career test on CareertestPro?',
                        content: '<p>Our career test is for anyone who wants to find out which professions suit their' +
                            ' personality best! As described above, you\'ll receive an extensive report on your ' +
                            'personality with matching professions from the largest online database!</p>',
                        list: []
                    },{
                        active:false,
                        name:'What type of questions can I expect during the CareertestPro career test?',
                        content: '<p>The career test on CareerTestPro.com has an <strong>occupation database of over 3,000 ' +
                            'professions</strong> with corresponding educational requirement levels. Needless to say,' +
                            ' CareertestPro is one of the most complete career tests you will find online! Furthermore,' +
                            ' our career test is used by professionals and career coaches. The career test is based on ' +
                            'questions with regard to your personal score on skills, (work) values, activities, personal' +
                            ' behavior and professions. All of these factors are tested by means of 60 questions. This' +
                            ' might look like a lot, but based on this total of 300 questions a personalized report is ' +
                            'created that elaborates on your personality and the professions that suit you best! Taking ' +
                            'the test <strong>only costs you about 15 minutes.</strong>',
                        list: []
                    },{
                        active:false,
                        name:'Does it make sense to take the career test if I’m already graduated or if I’m working?',
                        content: '<p>Definitely! It doesn\'t matter if you\'re already graduated or if you\'re already' +
                            ' working. You can still take the test to get a clearer view of your personality and see which ' +
                            'professions suit you best.</p>',
                        list: []
                    },{
                        active:false,
                        name:'What happens with my CareertestPro report?',
                        content: '<p>Your CareertestPro report is fully anonymous and is not saved on our servers. After' +
                            ' finishing the test you directly get to see the result and a copy is send to you via email.</p>',
                        list: []
                    },{
                        active:false,
                        name:'How or where can I create an account on CareertestPro.com?',
                        content: '<p>CareertestPro does not require an account and your personalized is fully anonymous.<p/>',
                        list: []
                    },
                ]
            }
        },
        methods:{
            open(data){
                this.list_acordeon[data.index].active = this.list_acordeon[data.index].active ? false : true;
            }
        },
        components:{
            'block_with_acordeon_component' : Block_with_acordeon,
            'acordeon_component' : Acordeon,
        }
    }
</script>

<style scoped>
    #faq{
        width: 100%;
        margin-top: 70px;
        margin-bottom: 264px;
    }
    .container_faq_acordeon{
        width: 855px;
    }
    @media screen and (max-width:1200px){
        .container_faq_acordeon{
            width: 75%;
            margin: 0 127px;
        }
        #faq{
            margin-bottom: 104px;
        }
    }

    @media screen and (max-width:900px){
        .container_faq_acordeon{
            width: 80%;
            margin: 0 100px;
        }
    }

</style>

