import list_language from "../../api/multilanguage_request";

export default {
    action_tegs({commit}, data) {
        return list_language.get_meta(data && data.store && data.store.id ? data.store.id : 1)
            .then(res => {
                let result = res.data.find(item => item.page_alias === data.page);
                !result ? result = {} : null;
                commit('mutation_meta', result);
                return result;
            })
    },
};
