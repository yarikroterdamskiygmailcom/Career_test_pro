import {mapGetters} from "vuex";

export default {
    name: 'goal-and-benefits',
    data() {
        return {
            information_benefits_list: [
                {
                    title:'Over 25 Report Pages',
                    description: 'An extensive report which elaborates<br/>\n' +
                        'on your personality, competences, interests and qualities with \c' +
                        'orresponding professions and educational levels.',
                    path_image: 'http://backcartestpro.qbex.io/assets/home_page/over25_report.svg'
                },{
                    title:'RIASEC Method',
                    description: 'Our test creates personalized 3 letter code, based<br/> on RIASEC personality types.<br/>\n' +
                        'This method helps to define competences more accurate.',
                    path_image: 'http://backcartestpro.qbex.io/assets/home_page/riasec_method.svg'
                },{
                    title:'Fully Anonymous',
                    description: 'We respect your privacy.<br/>\n' +
                        'Get PDF directly on your email - means no one else can see results, except of you.',
                    path_image: 'http://backcartestpro.qbex.io/assets/home_page/fully_anonymous.svg'
                },{
                    title:'Time Matters',
                    description: 'We appreciate your time.<br/>\n' +
                        'That’s why our test will take you only<br/>\n' +
                        '15 minutes or less. Save your precious time!',
                    path_image: 'http://backcartestpro.qbex.io/assets/home_page/time_matters.svg'
                },
            ]
        }
    },
    computed:{
        ...mapGetters({
            screen: 'modal_data/get_screen'
        })
    }
}
