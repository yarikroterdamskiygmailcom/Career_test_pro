import Payment from './../payment/index.vue'
import {mapGetters} from "vuex";

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
    computed:{
        ...mapGetters({
            confirmDetail:'multilanguage/getConfirmDetailSection'
        })
    },
    created() {
        for(let i = 18; i <= 100; i++){
            this.age.push(i);
            i == 100 && this.age.push('+');
        }
        this.data.gender = this.confirmDetail && this.confirmDetail.gender;
        this.data.age =    this.confirmDetail && this.confirmDetail.age;
    },
    methods: {
        errors: function(data){
            this.data.gender = this.confirmDetail && this.confirmDetail.gender;
            this.data.age =    this.confirmDetail && this.confirmDetail.age;
            this.error = {...data};
        }
    }
}
