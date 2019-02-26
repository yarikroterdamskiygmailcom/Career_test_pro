import {QuestionStore} from "../../store/localStorage";

export default  {
    count_process(method){
        let process = 0;
        for(let i = 1; i < 11 ;i++){
            QuestionStore.getStep(i).forEach( step => {
                if(step[method] || step[method] != null) process++
            });
        }
        return process / 3;
    },
    count_result(){
        let letters= {};
        letters.R = [];
        letters.I = [];
        letters.A = [];
        letters.S = [];
        letters.O = [];
        letters.C = [];
        for(let i = 1; i < 11 ;i++){
            QuestionStore.getStep(i).forEach( step => {
                letters[step.letter].push(step.state)
            });
        }

        Object.keys(letters).forEach(item => {
            letters[item] = letters[item].reduce((sum, current) => sum + current);
        });

        return  letters;
    },
}
