import axios from "./axios.config";

export default  {
    list_language(vue){
         axios.get('api/languages')
             .then(response => vue.$store.dispatch('multilanguage/action_change_state', response.data))
             .catch(err => console.log(err));
    },
    change_language(){
        return axios.get('api/languages');
    }
}
