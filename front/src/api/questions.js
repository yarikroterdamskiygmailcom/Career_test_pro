import axios from "./axios.config";
import {QuestionStore} from "../store/localStorage";

export default  {
    get_questions(index, store, commit){
        axios.get(`api/questions?language_id=${index}`)
        .then(response =>{
            for (let i = 0; i < response.data.length; i + 30) {
                let string_array = response.data.splice(i, 30);
                for(let j = 0; j < 3; j++){
                    !QuestionStore.getStep(`${i + 1}-${j+1}`) ?
                        QuestionStore.saveStep(string_array.splice(0, 10), `${i + 1}-${j+1}`) :
                        null;
                }
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



//axios.interceptors.response.use((response) => {
//     console.log('response', response);
//     return response
// }, (error) => {
//     // if (error.response.status == 401) {
//     //     this.$router.push({ path: '/login' })
//     // }
//     console.log('1111error', error.response.status);
//     return Promise.reject(error);
// })
