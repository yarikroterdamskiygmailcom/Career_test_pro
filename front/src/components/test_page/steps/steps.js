import Step_modal from './../../../const/const_step_modal'
import {QuestionStore} from "../../../store/localStorage";
import config from "../../../config";
import counter from "../counter";
import step_name from "../../../const/step_name";

export default {
    props: [],
    data() {
        return {
            mob: true,
            data_step: [],
            step: null,
            step_child:null,
            last_step: 11,
            first_step: 1,
            process: null,
            title_data_step: {},
            title_data_step_active: false,
            timeout: null,
        }
    },
    computed:{
        step_name: function(){
            return this.count_Step('name');
        },
        step_amount: function(){
            return this.count_Step('amount');
        }
    },
    created() {
        // if(window.innerWidth < 1019){
        //     this.mob = false
        // }
        // window.addEventListener('resize', function(){
        //     if(event.innerWidth < 1019){
        //         this.mob = false
        //     }
        // });
        // console.log(this.mob);
        this.process = counter.count_process('state');
        this.step = this.$route.params.steps;
        this.step_child = this.$route.params.child_step;
        (this.step < this.first_step) || (this.step > this.last_step) || !this.step_child
            ? this.$router.push( `/tests/1/1`) : null;
        this.toggle_modal();
    },

        // if(window.innerWidth < 1019){
        //     this.mob = false
        // }
        // window.addEventListener('resize', function(){
        //     if(event.innerWidth < 1019){
        //         this.mob = false
        //     }
        // })

    methods: {
        count_Step(name){
            return !this.step ? '' : step_name[`step:${this.step}`][name]
        },
        count_step_data(array, flag = null){
            let data = null;
            Object.keys(array).forEach( item => {
                let arr = item.split('-');
                if(flag) {
                    arr[1] == this.step ? data = item : null;
                } else {
                    arr[1] == this.step || arr[2] == this.step ? data = item : null;
                }
            });
            return data;
        },
        next(){
            if(this.step == this.last_step - 1){
                if(this.step_child < 3){
                    return `/tests/${Number(this.step)}/${Number(this.step_child) + 1}`;
                } else {
                    return `/confirm-detail`
                }
            } else {
               if(this.step_child < 3){
                   return `/tests/${Number(this.step)}/${Number(this.step_child) + 1}`;
               }
                else{
                   return `/tests/${Number(this.step) + 1}/${1}`;
               }
            }
        },
        back(){
            const disabled = Number(this.step) == this.first_step || Number(this.step) < this.first_step;
            if(disabled){
                 return this.step_child < 2
                     ? '/tests/1/1'
                     :`/tests/${Number(this.step)}/${Number(this.step_child) - 1}`
            } else {
                return this.step_child < 2
                    ? `/tests/${Number(this.step -1)}/3`
                    :`/tests/${Number(this.step)}/${Number(this.step_child) - 1}`
            }
        },
        toggle_modal(){
            clearTimeout(this.timeout);
            let step = this.count_step_data(Step_modal, 'modal');
            this.data_step = QuestionStore.getStep(`${this.step}-${this.step_child}`);
            this.title_data_step = Step_modal[step];
            if(step){
               this.timeout =  setTimeout(() => {
                    this.$store.dispatch('modal_data/action_active_modal', {
                        name: 'test_modal',
                        active: true,
                        modal_data: {
                            ...this.title_data_step,
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
            QuestionStore.saveStep(this.data_step, `${this.step}-${this.step_child}`);
            this.data_step = [
                ...QuestionStore.getStep(`${this.step}-${this.step_child}`)
            ];
            this.process = counter.count_process('state');
        },
        hover_pab(state){
            let step = this.count_step_data(Step_modal);
            this.title_data_step = state == 'open' ? Step_modal[step] : {};
            this.title_data_step_active = state == 'open';
        }
    },
    watch:{
        '$route' (to, from) {
            this.step = this.$route.params.steps;
            this.step_child = this.$route.params.child_step;
            localStorage.setItem('progress_step', to.fullPath);
            this.toggle_modal();
        }
    },
    directives: {
        disabled_button: {
            data_vue:this,
            methods:{
                element_munipulation(el, binding, vnode){
                    const self = binding.def.data_vue.a;
                    if(binding.value.step == self.data().first_step){
                        Number(binding.value.child< 2) ?
                            el.setAttribute('disabled', true)
                            :
                            el.removeAttribute('disabled')
                    }
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
