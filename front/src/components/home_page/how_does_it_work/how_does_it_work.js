import {mapGetters} from "vuex";

export default {
    name: 'how-does-it-work',
    data() {
        return {
            information_how_does_it_work:[
                {
                    title:'Click “Take the Test” button',
                    description: 'After that you’ll get on the test page',
                    path_image: 'http://backcartestpro.qbex.io/assets/home_page/click_take_the_test.svg',
                    order: 1
                },{
                    title:'Start making your test',
                    description: 'Take your time and enjoy test',
                    path_image: 'http://backcartestpro.qbex.io/assets/home_page/start_marking.png',
                    order: -1,
                },{
                    title:'Get report on your email',
                    description: 'Just download it in one click',
                    path_image: 'http://backcartestpro.qbex.io/assets/home_page/get_report.svg',
                    order: 1
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
