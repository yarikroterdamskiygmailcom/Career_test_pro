import Validator from '../../../validator/validator'
import counter from "../../test_page/counter";
import config from "../../../config";
import {mapGetters} from "vuex";
export default {
    name: 'payment',
    props: ['data_in_input_information'],
    data() {
        return {
            cards: [
                {
                    name:'PayPal',
                    status: false,
                    card:['paypal']
                },
                {
                    name: 'Credit/Debit Card',
                    status: false,
                    card:['visa', 'maestro', 'mastercard', 'discover']
                },
                {
                    name:'Voucher',
                    status: false,
                    card: []
                }
            ],
            cards1: [
                {
                    name: 'Mollie',
                    status: false,
                    card:['visa', 'maestro', 'mastercard', 'discover']
                },
                {
                    name: 'Braintree',
                    status: false,
                    card:['visa']
                }
            ],
            data:{
                code:''
            },
            error:{
                card:{},
                code:{
                    errors: false
                }
            },
            disabled_button:false,
            result: null,
            base_url:config.url
        }
    },

    created(){
        this.result = counter.count_result(this);
        this.$store.dispatch('multilanguage/action_spinner', {
            data:true,
            name: 'active'
        });
    },

    methods: {
        radio_count(data, arr) {
            arr.forEach(item => item.status = false);
            data.status = true;
        },

        position(arr){
            if(this.screen.value > 567){
                let number = arr.length > 1 ? -41 : -44;
                return  number * arr.length + 'px'
            } else {
                let count = arr.length > 1 ? (arr.length / 2) : arr.length;
                let number = arr.length > 1 ? -50 : -44;
                return  number * count + 'px'
            }
        },

        open_confirm_modal() {
            const inf = this.data_in_input_information;
            const error = this.error;

            let array_cards = this.cards.concat(this.cards1);
            //
            error.name   = Validator.set(inf.name, ['required']);
            error.email  = Validator.set(inf.email, ['required']);
            error.email  = !error.email.errors  ? Validator.set(inf.email, ['email']) : error.email;
            error.gender = Validator.set(inf.gender, ['dropdown'], 'Enter your gender');
            error.age    = Validator.set(inf.age, ['dropdown'], 'Enter your age');
            error.card   = Validator.set(array_cards, ['radio'], 'status');

            let card_name = this.count(array_cards);
            error.code = card_name === 'Voucher' ? Validator.set(this.data.code, ['required']) : {errors: false};

            let error_boolean = !error.email.errors && !error.name.errors && !error.gender.errors &&
                                !error.age.errors && !error.card.errors && !error.code.errors;

            if(error_boolean) {
                this.$emit('error_data_payment_button', this.error);
                this.$store.dispatch('modal_data/action_active_modal', {
                    name: 'confirm_modal',
                    active: true,
                    modal_data: {
                        ...this.data_in_input_information,
                        card: card_name,
                        result: this.result
                    },
                });
            } else {
                this.$emit('error_data_payment_button', this.error);
            }
        },
        count(arr) {
            let name = null;
            arr.forEach(item => {
                if(item.status) name = item.name;
            });
            return name;
        },
    },
    computed:{
        ...mapGetters({
            screen: 'modal_data/get_screen'
        })
    },
    directives: {
        disabled_input: {
            data_vue:this,
            methods:{
                element_munipulation(el, binding){
                    const self = binding.def.data_vue.a;
                    const values = self.methods.count(binding.value);
                    values != 'Voucher' ? el.setAttribute('disabled', true): el.removeAttribute('disabled');
                }
            },
            bind: function (el, binding, vnode) {
                binding.def.methods.element_munipulation(el, binding);
            },
            componentUpdated: function (el, binding) {
                binding.def.methods.element_munipulation(el, binding);
            }
        }
    }
}
