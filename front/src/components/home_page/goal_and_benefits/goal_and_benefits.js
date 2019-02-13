export default {
    name: 'goal-and-benefits',
    data() {
        return {
            information_benefits_list: [
                {
                    title:'Over 25 Report Pages',
                    description: 'An extensive report which elaborates\n' +
                        'on your personality, competences, interests and qualities with \c' +
                        'orresponding professions and educational levels.',
                    path_image: './../../../../src/assets/home_page/over25_report.png'
                },{
                    title:'RIASEC Method',
                    description: 'Our test creates personalized 3 letter code, based on RIASEC personality types.\n' +
                        'This method helps to define competences more accurate.',
                    path_image: './../../../../src/assets/home_page/riasec_method.png'
                },{
                    title:'Fully Anonymous',
                    description: 'We respect your privacy.\n' +
                        'Get PDF directly on your email - means no one else can see results, except of you.',
                    path_image: './../../../../src/assets/home_page/fully_anonymous.png'
                },{
                    title:'Time Matters',
                    description: 'We appreciate your time.\n' +
                        'That’s why our test will take you only\n' +
                        '15 minutes or less. Save your precious time!',
                    path_image: './../../../../src/assets/home_page/time_matters.png'
                },
            ]
        }
    },
}
