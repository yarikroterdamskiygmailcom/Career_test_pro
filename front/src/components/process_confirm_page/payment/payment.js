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
            ]
        }
    },
    methods: {
        radio_count(data, arr) {
            arr.forEach(item => item.status = false);
            data.status = true;
        },
        open_confirm_modal() {
            console.log(Validator.set(this.data_in_input_information.name, ['required']));
            console.log(Validator.set(this.data_in_input_information.email, ['required', 'email']));
            // new Validator();
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
