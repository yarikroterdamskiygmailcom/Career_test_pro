import {mapGetters} from "vuex";
import list_language from './../../../api/multilanguage_request';
import stepPage from './../../../components/test_page/steps/steps';
import {IndexLanguage} from "../../../store/storage";
const {base64encode, base64decode} = require('nodejs-base64');
export default {
    data() {
        return {
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
    created() {
        let rout = this.$router.history.current.fullPath;
        let routw = this.$router.history.current.path;
        this.active_button = routw == '/blog'
        this.test = rout.split('/')[1];
        this.selected = rout;
    },
    methods: {
        language(item) {
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
            let path = location.pathname.substring(0,location.pathname.lastIndexOf('/'));
            if(location.pathname.split('/')[1] === 'tests') path = `/tests/1/1`;
            const rout = `${path}/${item.code.toLowerCase()}`;
            // return this.$router.push(rout);
            window.location.href = `/?rout=${base64encode(rout)}`
        }
    },
    computed: {
        ...mapGetters({
            language_now: 'multilanguage/get_language_now',//localStorage/language_now
            menu_list: 'multilanguage/get_menu_list',
            language_array: 'multilanguage/get_language_array',
            screen: 'modal_data/get_screen',
            firstSection: 'multilanguage/getHomeFirstSection'
        }),
        new_menu_list() {
            const lang = this.language_now;
            let data = JSON.parse( JSON.stringify( this.menu_list));
            return this.menu_list ? data.map(item => {
                item.path = `${item.path}/${lang.code}`;// `${item.path}?lang=${lang.code}`
                return item
            }) : [];
        }
    },
    watch: {
        menu: function () {
            document.body.style.overflowY = this.menu ? 'hidden' : 'scroll'
        },
        '$route'(to, from) {
            this.active_button = to.path == '/blog' || this.$router.history.current.path.split('/')[0] == 'tests';
            this.test = this.$router.history.current.path.split('/')[1];
            this.selected = to.fullPath;
        }
    },
}
