import Validator from '../../../validator/validator'
export default {
    name: 'payment',
    props: ['data_in_input_information'],
    data() {
        return {
            cards: [
                {
                    name:'PayPal',
                    status: false
                },
                {
                    name: 'Credit/Debit Card',
                    status: false
                },
                {
                    name:'Voucher',
                    status: false
                }
            ],
            cards1: [
                {
                    name: 'Mollie',
                    status: false
                },
                {
                    name: 'Braintree',
                    status: false
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
            disabled_button:false
        }
    },



    methods: {


        radio_count(data, arr) {
            arr.forEach(item => item.status = false);
            data.status = true;
        },


        open_confirm_modal() {
            const inf = this.data_in_input_information;
            const error = this.error;

            error.name =   Validator.set(inf.name, ['required']);
            error.email =  Validator.set(inf.email, ['required']);
            error.email =  !error.email.errors  ? Validator.set(this.data.email, ['email']) : error.email;
            error.gender = Validator.set(inf.gender, ['dropdown'], 'Enter your gender');
            error.age =    Validator.set(inf.age, ['dropdown'], 'Enter your age');
            error.card =   Validator.set(this.cards.concat(this.cards1), ['radio'], 'status');

            if(this.count(this.cards.concat(this.cards1)) === 'Voucher'){
                error.code = Validator.set(this.data.code, ['required']);
            }

            if(
                !error.email.errors &&
                !error.name.errors &&
                !error.gender.errors &&
                !error.age.errors &&
                !error.card.errors &&
                !error.code.errors
            ) {
                this.$store.dispatch('modal_data/action_active_modal', {
                    name: 'confirm_modal',
                    active: true,
                    modal_data: {
                        ...this.data_in_input_information,
                        card: this.count(
                            this.cards.concat(this.cards1)
                        ),
                    },
                });
            } else {
                this.$emit('error_data_payment_button', this.error);
                this.disabled_button = true
            }
        },


        count(arr) {
            let name = null;
            arr.forEach(item => {
                if(item.status) name = item.name;
            });
            return name;
        }


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
