import {QuestionStore} from "../store/storage";

export const LocalStorage = {
    Local(data){
        let count = 0;
        if(!data) data = [];
        for (let i = 0; i < data.length; i + 30) {
            let string_array = data.splice(i, 30);
            for (let j = 0; j < 3; j++) {
                const step = QuestionStore.getStep(`${count + 1}-${j + 1}`);
                let data_step_one = string_array.splice(0, 10);
                if(!step) QuestionStore.saveStep(data_step_one, `${count + 1}-${j + 1}`);
                else {

                    data_step_one = data_step_one.map((item, index) => {
                        // debugger;
                        const LANG  = 'language_id';
                        const QUEST = 'questions_description';
                        const STATE = 'state';
                        if(item[QUEST] &&  item[QUEST][LANG] &&
                            step[index][QUEST] &&  step[index][QUEST][LANG] &&
                            item[QUEST][LANG] !== step[index][QUEST][LANG]) item[QUEST] = step[index][QUEST];
                        if(item && `${item[STATE]}` &&
                            step[index] && `${step[index][STATE]}` )  item[STATE] = step[index][STATE];

                        return item;
                    });
                    QuestionStore.saveStep(data_step_one, `${count + 1}-${j + 1}`);
                }
            }
            count++;
        }
    }
};
