import {Pasts} from "../../../api/posts";
import {mapGetters} from "vuex";
export default {
    name: 'blog-page',
    components: {},
    async fetch({redirect, store, params,route}) {
        const data = await store.dispatch('multilanguage/ssrRender', 'blog');
        store.dispatch('questions/action_questions', data);
        return Pasts.get_one_post(params.detail)
            .then(res => {
                res.data.url = `http://localhost:3001/${route.fullPath}`
                if(Object.keys(res.data).length == 0) {
                    redirect('/blog');
                    return
                }
                store.dispatch('blog_data/postOne', res.data)
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
            screen: 'modal_data/get_screen'
        })
    },
    mounted() {

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

