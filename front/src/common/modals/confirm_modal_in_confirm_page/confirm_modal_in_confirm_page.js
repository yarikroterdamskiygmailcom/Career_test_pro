import counter from "../../../components/test_page/counter";
import Payment from "./../../../api/payment"
import config from "../../../config";
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
            let payment = this.data.data.card.toLowerCase() == 'paypal'? 'paywithpaypal' : this.data.data.card.toLowerCase();
            payment = this.data.data.card.toLowerCase() == 'credit/debit card'? 'braintree' : payment;
            let data = {...this.data.data};
            data= window.btoa(unescape(encodeURIComponent(JSON.stringify(data))));
            window.location.href = `${config.url}${payment}?result=${data}`
        }
    }
}
