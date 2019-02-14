// initial state

import axios from 'axios';


const state = {
    language_now: {
        name: 'EN',
        full_name: 'English',
        path: '/en'
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
            name:  'contact-us',
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
}

/**
 * ----- ACTIONS -----
 **/

const actions = {

};


/**
 * ----- MUTATIONS -----
 * */

const mutations = {
    change_state (state, value) {
    state = value;
  }
};

export default {
  namespaced: true,
  getters,
  state,
  actions,
  mutations
};
