import {mapGetters} from "vuex";

export default {
    data() {
        return {
            menu: false,
            active_button: true,
            selected: '',
            arr: [
                {
                    url: '/home',
                    item: 'home'
                },
                {
                    url: '/faq',
                    item: 'FAQ'
                },
                {
                    url: '/contact-us',
                    item: 'Contact Us'
                },
                {
                    url: '/about-us',
                    item: 'About Us'
                },
            ]
        }
    },
    created(){
        let rout = this.$router.history.current.path
        this.active_button = rout  == '/home' || rout  == '/tests' || rout.split('/').length > 2
         this.selected = rout;
    },
    methods:{
        language(item){
            console.log(item);
        }
    },
    computed:
        mapGetters({
            language_now:    'multilanguage/get_language_now',
            menu_list:       'multilanguage/get_menu_list',
            language_array:  'multilanguage/get_language_array',
            screen:          'modal_data/get_screen'
        }),
    watch:{
        menu:function(){
            document.body.style.overflowY = this.menu ? 'hidden' : 'scroll'
        },
        '$route' (to, from) {
            this.active_button = to.path == '/home'
            this.selected= to.path
        }
    },
}
