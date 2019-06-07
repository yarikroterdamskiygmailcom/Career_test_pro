import {mapGetters} from 'vuex';
import config from "../../../config";
import stepPage from "../../../components/test_page/steps/steps";
import {IndexLanguage} from "../../../store/storage";
export default {
    data() {
        return{
            payments:['paypal', 'visa', 'maestro', 'mastercard', 'discover'],
            base_url: config.url,
            menu: false,
            active_button: true,
            selected: '',
            arr: [{
                url: '/blog',
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
                }],
            test: ''
        }
    },
    methods:{
        language(item){
            IndexLanguage.destroyLang();
            localStorage.clear();
            this.$store.dispatch('multilanguage/action_spinner', {
                data: false,
                name: 'active'
            });
            this.$store.dispatch('multilanguage/action_spinner', {
                data: {...item},
                name: 'language_now'
            });
            this.$store.commit('localStorage/language_now',
                this.$store.getters['multilanguage/get_language_now'],
                {root: true}
            );
            IndexLanguage.saveLang(item);
            const rout = `${location.pathname}?lang=${item.code.toLowerCase()}`;
            // return this.$router.push(rout);
            window.location.href = `/?rout=${base64encode(rout)}`
        },

    },
    created() {
        let rout = this.$router.history.current.fullPath;
        let routw = this.$router.history.current.path;
        this.active_button = routw == '/blog'
        this.test = rout.split('/')[1];
        this.selected = rout;
    },
    computed:{
        ...mapGetters({
            language_now:    'multilanguage/get_language_now',
            menu_list:       'multilanguage/get_menu_list',
            language_array:  'multilanguage/get_language_array',
            sotial_networks: 'multilanguage/get_sotial_networks',
            screen: 'modal_data/get_screen',
            footer: 'multilanguage/getFooterSection'
        }),
        new_menu_list() {
            const lang = this.language_now;
            let data = JSON.parse( JSON.stringify( this.menu_list));
            return this.menu_list ? data.map(item => {
                item.path = `${item.path}?lang=${lang.code}`;// `${item.path}?lang=${lang.code}`
                return item
            }) : [];
        }
    },
    watch: {
        '$route'(to, from) {
            this.active_button = to.path == '/blog' || this.$router.history.current.path.split('/')[0] == 'tests';
            this.test = this.$router.history.current.path.split('/')[1];
            this.selected = to.fullPath;
        }
    },
}
