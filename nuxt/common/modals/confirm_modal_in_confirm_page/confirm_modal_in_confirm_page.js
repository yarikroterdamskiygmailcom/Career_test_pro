import counter from "../../../components/test_page/counter";
import Payment from "./../../../api/payment"
import config from "../../../config";
import axios from "../../../api/axios.config";
import {mapGetters} from "vuex";
export default {
    name: 'confirm-modal-in-confirm-page',
    components: {},
    props: ['data'],
    data() {
        return {
            transitions: false
        }
    },
    mounted(){
        setTimeout(() => this.transitions = !this.transitions, 200)
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
            const payment_key = this.data.data.card.toLowerCase();
            let payment; debugger;
            let data = {...this.data.data};
            data.language_id = this.$store.getters['multilanguage/get_language_now'].id;
            data.language_id = data.language_id ? data.language_id : 1;
            data.type = ''
            switch(payment_key){
                case 'paypal':payment = 'paywithpaypal';
                    break;
                case 'credit/debit card': payment = 'braintree';
                    break;
                case 'bancontact':
                    data.type = 'bancontact';
                    data = this.toHash(data);
                    return window.location.href = `${config.url}api/stripe?result=${data}&code=${this.data.data.code}`;
                case 'ideal': payment = 'braintree';
                    data.type = 'ideal';
                    data = this.toHash(data);
                    return window.location.href = `${config.url}api/stripe?result=${data}&code=${this.data.data.code}`;
                case 'voucher':
                    data = this.toHash(data);
                    return window.location.href = `${config.url}api/testcode-use?result=${data}&code=${this.data.data.code}`;
                case 'payment':
                    data = this.toHash(data);
                    return window.location.href = `${config.url}api/stripe?result=${data}&code=${this.data.data.code}`;
                default: payment = payment_key;
            }
            ;
            data = this.toHash(data);
            window.location.href = `${config.url}${payment}?result=${data}`
        },
        toHash(data){
            return window.btoa(unescape(encodeURIComponent(JSON.stringify(data))));
        }
    },
    computed:{
        ...mapGetters({
            modal: 'multilanguage/getConfirmModal',
        })
    }
}
