import Step_modal from './../../../const/const_step_modal'
import {QuestionStore} from "../../../store/localStorage";
import config from "../../../config";


export default {
    name: 'steps',
    components: {},
    props: [],
    data() {
        return {
            step_data: []
        }
    },
    computed: {},
    created() {
        let step = null;
        Object.keys(Step_modal).forEach( item => {
            if(item.split('-')[1] == this.$route.params.steps) {
                step = item;
            }
            if(step) return;
        });
        if(step) {
            this.step_data = JSON.parse(QuestionStore.getStep(this.$route.params.steps));
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
    methods: {
        select(letter) {
            // let position = config.letters.indexOf(letter);

        },
        next(){

        }
    }
}
