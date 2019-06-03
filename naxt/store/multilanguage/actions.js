import Helper_count from "../helpers/count";
import {IndexLanguage} from "../storage";
import list_language from "../../api/multilanguage_request";
import questions from "../../api/questions";
import vuex from 'vuex'
export default {
    action_change_state({commit}, value){
        commit('change_state', {
            data: value,
            name: 'language_array'
        });
        const data = Helper_count.find_language_now_in_array(value);
        commit('change_state', {
            data: IndexLanguage.getLang() ? IndexLanguage.getLang() : data,
            name: 'language_now'
        });
        list_language.get_site(IndexLanguage.getLang() && IndexLanguage.getLang().id
            ? IndexLanguage.getLang().id : data.id, commit);
        questions.get_questions(IndexLanguage.getLang() && IndexLanguage.getLang().id
            ? IndexLanguage.getLang().id :  data.id, this, commit);
    },
    changeLang({commit}, value){
        list_language.get_site( value.id, commit);
        questions.get_questions(value.id, this, commit);
    },
    action_spinner({commit}, value){
        commit('change_state', value)
    },
    ssrRender({commit, state}, value){
        let data;
        return list_language.list_language()
            .then(response => {
                commit('change_state', {
                    data: response.data,
                    name: 'language_array'
                });
                data = Helper_count.find_language_now_in_array(response.data);
                commit('change_state', {
                    data: data,
                    name: 'language_now'
                });
                return list_language.get_site(value && value.id ?
                    value.id : data.id)
            }).then(response => {
                commit('setVariable', response.data);
                return questions.get_questions(value && value.id ?
                    value.id : data.id, this, commit);
            }).then(response => {
                commit('change_state', {
                    data: true,
                    name: 'test'
                });
                return response.data;
            })
            .catch(err => console.log(err));
    }
};
