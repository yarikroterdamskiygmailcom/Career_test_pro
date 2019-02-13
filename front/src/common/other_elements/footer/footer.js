import {mapGetters} from 'vuex';

export default {
    data() {
        return{}
    },
    computed:
        mapGetters({
            language_now:    'multilanguage/get_language_now',
            menu_list:       'multilanguage/get_menu_list',
            language_array:  'multilanguage/get_language_array',
            sotial_networks: 'multilanguage/get_sotial_networks',
        }),
}
