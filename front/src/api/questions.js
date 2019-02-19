import axios from "./axios.config";
import {QuestionStore} from "../store/localStorage";

export default  {
    get_questions(index, store, commit){
        axios.get(`api/questions?language_id=${index}`)
            .then(response =>{
                let count = 1;
                for (let i = 0; i < response.data.length; i + 30) {
                    let string_array = response.data.splice(i, 30);
                    !QuestionStore.getStep(count) ? QuestionStore.saveStep(string_array, count) : null;
                    count++;
                }
                commit('change_state', {
                    data:true,
                    name: 'active'
                })
            })
            // .catch(err => console.log(err));
    },
    change_language(){
        return axios.get('api/languages');
    }
}
