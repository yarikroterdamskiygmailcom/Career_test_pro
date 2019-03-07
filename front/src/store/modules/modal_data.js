// initial state

import axios from 'axios';


const state = {
    confirm_modal : {
        active: false,
        data: {}
    },
    test_modal : {
        active:false,
        data:false
    },
    screen: {
        value: 1600,
        active: false
    }
};

const getters = {
    get_confirm_modal (state) {
        return state.confirm_modal
    },
    get_test_modal (state) {
        return state.test_modal
    },
    get_screen (state) {
        return state.screen
    }
};

/**
 * ----- ACTIONS -----
 **/

const actions = {
    action_active_modal({commit}, data) {
        commit('mutation_modal', {
            modal_name:data.name,
            modal:{
                active: data.active,
                data:data.modal_data
            },
        });
    },
    action_screen({commit}, data) {
        commit('mutation_screen', data)
    }

};


/**
 * ----- MUTATIONS -----
 * */

const mutations = {
    mutation_modal (state, value) {
        state[value.modal_name] = value.modal;
    },
    mutation_screen(state, value){
        state.screen = value
    }
};

export default {
    namespaced: true,
    getters,
    state,
    actions,
    mutations
};
