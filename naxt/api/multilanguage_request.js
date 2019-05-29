import axios from "./axios.config";
import Helper_count from "../store/helpers/count";
import {IndexLanguage} from "../store/localStorage";
import questions from "./questions";

export default  {
    list_language(store){
         return axios.get('api/languages')
    },
    get_site(language_id, commit) {
         return axios.get(`/api/site-blocks?language_id=${language_id}`)
             // .then(res => commit('setVariable', res.data))
             // .catch(err => err)
    },
    get_meta(language_id) {
        return axios.get(`/api/metatags?language_id=${language_id}`)

    }
}
