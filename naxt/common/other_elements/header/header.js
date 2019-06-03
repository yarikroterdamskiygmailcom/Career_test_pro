import {mapGetters} from "vuex";
import list_language from './../../../api/multilanguage_request';
import stepPage from './../../../components/test_page/steps/steps';
import {IndexLanguage} from "../../../store/storage";

export default {
    data() {
        return {
            menu: false,
            active_button: true,
            selected: '',
            arr: [
                {
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
                },
            ],
            test: ''
        }
    },
    created() {
        let rout = this.$router.history.current.path;
        this.active_button = rout == '/blog'
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
            // this.$store.dispatch('multilanguage/changeLang', {id:item.id, vue: stepPage});
            this.$store.dispatch('multilanguage/action_spinner', {
                data: {...item},
                name: 'language_now'
            });
            this.$store.commit('localStorage/language_now', this.$store.getters['multilanguage/get_language_now'], {root: true});
            this.$cookies.set("language_now", btoa(JSON.stringify(this.$store.getters['multilanguage/get_language_now'])));
            IndexLanguage.saveLang(item);

            window.location.href = `/${item.code.toLowerCase()}/${location.pathname.split('/')[2]}`
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
            let data = JSON.parse( JSON.stringify( this.menu_list))
            return this.menu_list ? data.map(item => {
                item.path = `/${lang.code}${item.path}`;
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
            this.selected = to.path;
        }
    },
}
