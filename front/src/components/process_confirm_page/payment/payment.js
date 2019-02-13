export default {
    name: 'payment',
    components: {},
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
            category: [
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
    computed: {},
    mounted() {
    },
    methods: {
        radio_count(data, arr){
            arr.forEach(item => item.status = false);
            data.status = true;
        }
    }
}
