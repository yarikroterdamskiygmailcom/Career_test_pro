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
            gender:['Male', 'Female', 'Rather not say'],
            age: []
        }
    },
    computed:{
        ...mapGetters({
            confirmDetail:'multilanguage/getConfirmDetailSection',
            price: 'multilanguage/price'
        })
    },
    mounted(){
        for(let i = 18; i <= 100; i++){
            this.age.push(i);
            i == 100 && this.age.push('+');
        }
        this.setAgeGender();
    },
    updated(){
        this.setAgeGender();
        this.data.price = this.price.value
    },
    methods: {
        errors: function(data){
            this.setAgeGender();
            this.error = {...data};
        },
        setAgeGender(){
            this.data.gender = this.data.gender === 'Male' ||
            this.data.gender === 'Female'||
            this.data.gender === 'Rather not say'
                ? this.data.gender
                : this.confirmDetail && this.confirmDetail.gender.replace(/(<([^>]+)>)/g,'');
            this.data.age    = typeof this.data.age === 'number'
                ? this.data.age
                : this.confirmDetail && this.confirmDetail.age.replace(/(<([^>]+)>)/g,'');
        },
        test(item){
            this.data.gender = item;
        }
    }
}
