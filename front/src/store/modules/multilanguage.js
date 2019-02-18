// initial state

import list_language from './../../api/multilanguage_request';
import questions from "../../api/questions";


const state = {
    active: false,
    language_now: {
        id: 1,
        language: "English",
        code: "en"
    },
    menu_list: [
        {
            name: 'Home',
            path: '/home'
        },{
            name: 'FAQ',
            path: '/faq'
        },{
            name:  'Blog',
            path: '/blog'
        },{
            name:  'Contact Us',
            path: '/contact-us'
        },{
            name:  'About Us',
            path: '/about-us'
        },
    ],
    language_array:[
        {
            name:'RU',
            full_name:'Russian',
            path: '/ru'
        },
        {
            name: 'EN',
            full_name: 'English',
            path: '/ru'
        }
    ],
    sotial_networks: [
        {
            name: 'linkedin',
            path: './../../../../src/assets/linkedin.png'
        },{
            name: 'twitter',
            path: './../../../../src/assets/twitter.png'
        },{
            name: 'facebook',
            path: './../../../../src/assets/facebook.png'
        },
    ]
};

const getters = {
    get_language_now(state) {
        return state.language_now
    },
    get_menu_list (state) {
        return state.menu_list
    },
    get_language_array (state) {
        return state.language_array
    },
    get_sotial_networks (state) {
        return state.sotial_networks
    },
    get_status_project(state){
        return state.active
    }
}

/**
 * ----- ACTIONS -----
 **/

const actions = {
    action_change_state({commit}, value){
        commit('change_state', {
            data: value,
            name: 'language_array'
        });
        const data = (function(){
            let data;
            value.forEach(item =>{
                if(item.language == 'English') {
                    data = item;
                    return;
                }
            });
            return data;
        })();
        commit('change_state', {
            data: data,
            name: 'language_now'
        });
        questions.get_questions(data.id, this, commit)
    },
    action_change_language({commit}, value){

    }
};

/**
 * ----- MUTATIONS -----
 * */

const mutations = {
    change_state (state, value) {
        state[value.name] = value.data;
    }
};

export default {
  namespaced: true,
  getters,
  state,
  actions,
  mutations
};
