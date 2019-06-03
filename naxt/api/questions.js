import axios from "./axios.config";
import {QuestionStore} from "../store/storage";

export default  {
    get_questions(index, store, commit){
        return axios.get(`api/questions?language_id=${index}`)
    },
}
