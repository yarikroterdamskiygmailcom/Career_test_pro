import Step_modal from './../../../const/const_step_modal'
import {QuestionStore} from "../../../store/localStorage";
import config from "../../../config";
import counter from "../counter";


export default {
    components: {},
    props: [],
    data() {
        return {
            data_step: [],
            step:null,
            last_step: 11,
            first_step: 1
        }
    },
    created() {
        this.step = this.$route.params.steps;
        (this.step < this.first_step || this.step > this.last_step)  ? this.$router.push( `/tests/1`) : null;
        this.toggle_modal();
    },
    methods: {
        count_step_data(array){
            let data = null;
            Object.keys(array).forEach( item => {
                if(item.split('-')[1] == this.step) {
                    data = item;
                }
            });
            return data;
        },
        next(){
            return this.step == this.last_step - 1 ? `/confirm-detail` : `/tests/${Number(this.step) + 1}`
        },
        back(){
            const disabled = Number(this.step) == this.first_step || Number(this.step) < this.first_step;
            return disabled ? '/tests/1' : `/tests/${Number(this.step) - 1}`
        },
        toggle_modal(){
            let step = this.count_step_data(Step_modal);
            this.data_step = QuestionStore.getStep(this.step);
            if(step){
                setTimeout(() => {
                    this.$store.dispatch('modal_data/action_active_modal', {
                        name: 'test_modal',
                        active: true,
                        modal_data: {
                            ...Step_modal[step],
                            step: step.split('-')
                        }
                    });
                }, 3000)
            }
        },
        select_item(position, number){
            let step = this.data_step[position];
            step.state == number ? delete step.state : step.state = number ;
             if(step.state != null) {
                 step.state = number
             }
            QuestionStore.saveStep(this.data_step, this.step);
            this.data_step = [
                ...QuestionStore.getStep(this.step)
            ];
            console.log(counter.count_process('state'));
        }
    },
    watch:{
        '$route' (to, from) {
            this.step = this.$route.params.steps;
            this.toggle_modal();
        }
    },
    directives: {
        disabled_button: {
            data_vue:this,
            methods:{
                element_munipulation(el, binding, vnode){
                    const self = binding.def.data_vue.a;
                    binding.value.step == self.data().first_step
                        ?
                            el.setAttribute('disabled', true)
                        :
                            el.removeAttribute('disabled')

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
