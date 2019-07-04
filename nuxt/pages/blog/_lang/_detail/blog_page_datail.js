import {Pasts} from "../../../../api/posts";
import {mapGetters} from "vuex";
import {Tag} from "../../../../helper/helpTegs";
import {RETURN_ROUTER} from "../../../../helper/routerHelp";
const {base64encode, base64decode} = require('nodejs-base64');
export default {
    name: 'blog-page',
    components: {},
    async fetch({redirect, store, params,route,commit, req}) {
        if(store.getters['multilanguage/get_tests']) {

        } else {
            store.commit('multilanguage/change_state', {
                data: store.getters['multilanguage/get_tests'] + 1,
                name: 'tests'
            });
            let lang = route.params.lang;
            const rout = route && route.fullPath ? route.fullPath.split('/')[1] : '';
            !lang ? lang = 'en' : null;
            const data = await store.dispatch('multilanguage/ssrRender', {lang, rout, redirect});
            await store.dispatch('questions/action_questions', data);
        }
        console.log(params)
        await Pasts.get_one_post(params.lang)
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
            let text = this.postOne && this.postOne.body ? this.postOne.body.replace(/(<([^>]+)>)/g,'') : ''
            switch (type) {
                case 'twitter':
                    return `https://twitter.com/share?text=${text}`;
                case 'facebook':
                    return `https://www.facebook.com/sharer/sharer.php?kid_directed_site=0&sdk=joey&u=${this.postOne.url}&display=popup&ref=plugin&src=share_button&text=${text}`;
                case 'linkedin':
                    return `http://www.linkedin.com/shareArticle?mini=true&url=${this.postOne.url}&text=${text}&summary=some%20summary%20if%20you%20want`
            }
        }
    },
    created(){
        try {
            const resRout = RETURN_ROUTER.initRouter(this.$router.history.current);
            // if (resRout) window.location.href = `/?rout=${base64encode(resRout)}`;
        } catch (e) {
        }
    },
}

