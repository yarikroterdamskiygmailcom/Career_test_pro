import {Pasts} from "../../../api/posts";
import {mapGetters} from "vuex";
import {Tag} from "../../../helper/helpTegs";
import {nuxtServerInit} from "../../../store/helpers/initServer";
export default {
    name: 'blog-page',
    components: {},
    async fetch({redirect, store, params,route,commit, req}) {
        const lang = nuxtServerInit(store,req);
        if(lang) return;
        const data = await store.dispatch('multilanguage/ssrRender', lang);
        store.dispatch('questions/action_questions', data);
        await Pasts.get_one_post(params.detail)
            .then(res => {
                res.data.url = `http://localhost:3001/${route.fullPath}`;
                if(Object.keys(res.data).length == 0) {
                    redirect('/blog');
                    return
                }
                store.dispatch('blog_data/postOne', res.data);
                store.commit('meta/mutation_meta', res.data);
                store.commit('multilanguage/change_state', {
                    data: true,
                    name: 'active'
                });
            })
            .catch(err => {
                redirect('/blog')
            })
    },
    props: [],
    data() {
        return {}
    },
    computed: {
        ...mapGetters({
            postOne: 'blog_data/get_post',
            sotial_networks: 'multilanguage/get_sotial_networks',
            screen: 'modal_data/get_screen',
            meta: 'meta/get_meta'
        })
    },
    head () {
        return {
            meta: Tag.getArrayTags(this.meta),
        }
    },
    methods: {
        getHref(type, data){
            switch (type) {
                case 'twitter':
                    return `https://twitter.com/share?text=${this.postOne.body.replace(/(<([^>]+)>)/g,'')}`;
                case 'facebook':
                    return `https://www.facebook.com/sharer/sharer.php?kid_directed_site=0&sdk=joey&u=${this.postOne.url}&display=popup&ref=plugin&src=share_button&text=${this.postOne.body.replace(/(<([^>]+)>)/g,'')}`;
                case 'linkedin':
                    return `http://www.linkedin.com/shareArticle?mini=true&url=${this.postOne.url}&text=${this.postOne.body.replace(/(<([^>]+)>)/g,'')}&summary=some%20summary%20if%20you%20want`
            }
        }
    }
}

