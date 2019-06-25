export default {
    action_posts({commit}, data) {
        commit('mutation_posts', data)
    },
    postOne({commit}, data) {
        commit('mutation_post', data)
    }
};
