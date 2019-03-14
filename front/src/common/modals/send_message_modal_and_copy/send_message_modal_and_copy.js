import counter from "../../../components/test_page/counter";
import Payment from "./../../../api/payment"
import config from "../../../config";
export default {
    name: 'confirm-modal-in-confirm-page',
    components: {},
    props: ['data'],
    data() {
        return {
            url : config.url
        }
    },
    methods: {
        close_modal(){
            this.$store.dispatch('modal_data/action_active_modal', {
                name: 'send_and_copy_modal',
                active: false,
                modal_data: {},
            });
        },
    }
}
