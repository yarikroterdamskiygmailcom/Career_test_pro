import axios from "./axios.config";
import {QuestionStore} from "../store/localStorage";

export default  {
    get_questions(index, store, commit){
        axios.get(`api/questions?language_id=${index}`)
        .then(response =>{
            let count = 0;
            for (let i = 0; i < response.data.length; i + 30) {
                let string_array = response.data.splice(i, 30);
                for(let j = 0; j < 3; j++){
                    !QuestionStore.getStep(`${count + 1}-${j+1}`)
                        ? QuestionStore.saveStep(
                                string_array.splice(0, 10),
                               `${count + 1}-${j+1}`
                            )
                        : null;
                }
                count++;
            }
            commit('change_state', {
                data:true,
                name: 'active'
            })
        })
    },
    change_language(){
        return axios.get('api/languages');
    }
}
