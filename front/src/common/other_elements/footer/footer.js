import {mapGetters} from 'vuex';
import config from "../../../config";
export default {
    data() {
        return{
            payments:['paypal', 'visa', 'maestro', 'mastercard', 'discover'],
            base_url: config.url
        }
    },
    computed:
        mapGetters({
            language_now:    'multilanguage/get_language_now',
            menu_list:       'multilanguage/get_menu_list',
            language_array:  'multilanguage/get_language_array',
            sotial_networks: 'multilanguage/get_sotial_networks',
            screen: 'modal_data/get_screen'
        }),
}
