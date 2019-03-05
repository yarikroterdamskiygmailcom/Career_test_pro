import {QuestionStore} from "../../store/localStorage";


let letters= {};
letters.R = [];
letters.I = [];
letters.A = [];
letters.S = [];
letters.O = [];
letters.C = [];

const count_step = 11;
const count_in_one_step = 3;

export default  {
    count_process(method){
        let process = 0;
        const callback_foreach = function(step){
            if(step[method] || step[method] != null) process++
        };
        this.cicle(callback_foreach, count_step, 3);
        return process / 3;
    },
    count_result(){
        const callback_foreach = function(step){
            step.state ? letters[step.letter].push(step.state) : null
        };
        this.cicle(callback_foreach, count_step, 3);
        Object.keys(letters).forEach(item => {
            letters[item] = letters[item].reduce((sum, current) => sum + current);
        });
        return  letters;
    },
    cicle(func, count_i = count_step, count_j = count_in_one_step) {

        for(let i = 1; i < count_i ;i++){
            for (let j = 0; j < count_j; j++) {
                QuestionStore.getStep(`${i}-${j+1}`).forEach(func);
            }
        }
    }
}

