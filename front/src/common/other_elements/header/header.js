import {mapGetters} from "vuex";

export default {
    props: [],
    data() {
        return{}
    },
    computed: mapGetters({
            language_now:    'multilanguage/get_language_now',
            menu_list:       'multilanguage/get_menu_list',
            language_array:  'multilanguage/get_language_array',
        }),
    mounted() {

    },
    methods: {}
}
