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
    }
};

const getters = {
    get_confirm_modal (state) {
        return state.confirm_modal
    },
    get_test_modal (state) {
        return state.test_modal
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
    }
};


/**
 * ----- MUTATIONS -----
 * */

const mutations = {
    mutation_modal (state, value) {
        state[value.modal_name] = value.modal;
    }
};

export default {
    namespaced: true,
    getters,
    state,
    actions,
    mutations
};
