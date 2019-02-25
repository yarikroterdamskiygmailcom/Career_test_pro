import counter from "../../../components/test_page/counter";
import Payment from "./../../../api/payment"
export default {
    name: 'confirm-modal-in-confirm-page',
    components: {},
    props: ['data'],
    data() {
        return {}
    },
    methods: {
        close_modal(){
            this.$store.dispatch('modal_data/action_active_modal', {
                name: 'confirm_modal',
                active: false,
                modal_data: {},
            });
        },
        confirm(){
            let data = {...this.data.data};
            let payment = this.data.data.card;
            delete data.card;
            Payment.sent_data_payment(data, payment)
        }
    }
}
