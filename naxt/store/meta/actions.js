import list_language from "../../api/multilanguage_request";

export default {
    action_tegs({commit}, data) {
        if(data && data.store && data.store.id){
            return list_language.get_meta(data.store.id)
                .then(res => {
                    let result = res.data.find(item => item.page_alias === data.page);
                    !result ? result = {} : null;
                    commit('mutation_meta', result);
                    return result;
                })
        }
    },
};
