
export const state = () => ({
    language_now: {}
});

export const mutations = {
    language_now: (state, value) => {
        state.language_now = value
    }
};
export const getters = {
    language_now: (state, value) => state.language_now
};
