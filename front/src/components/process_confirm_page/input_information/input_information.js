import Payment from './../payment/index.vue'

export default {
    name: 'input-information',
    components: {
        'payment_component': Payment,
    },
    props: [],
    data() {
        return {
            data: {
                name: '',
                email: '',
                gender: '',
                age: '',
                price: '$39.95'
            },
            error:{
                name:{},
                email:{},
                age:{},
                gender:{},
            },
            gender:['male', 'female'],
            age: []
        }
    },
    computed: {
    },
    created() {
        for(let i = 18; i <= 100; i++){
            this.age.push(i);
            i == 100 && this.age.push('+');
        }
        this.data.gender = 'Gender';
        this.data.age = 'Age';
    },
    methods: {
        errors: function(data){
            this.data.gender = 'Gender';
            this.data.age = 'Age';
            this.error = {...data};
        }
    }
}
