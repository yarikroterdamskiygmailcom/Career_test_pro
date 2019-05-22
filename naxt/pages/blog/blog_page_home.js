import {Pasts} from "../../api/posts";
import {mapGetters} from "vuex";
import Vue from 'vue'
import Vue2Filters from 'vue2-filters'
import VueFilterDateFormat from 'vue-filter-date-format';
import VueFilterDateParse from 'vue-filter-date-parse';
import axios from "axios";

Vue.use(VueFilterDateParse)
Vue.use(Vue2Filters)
Vue.use(VueFilterDateFormat, {
    monthNames: [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ],
    monthNamesShort: [
        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
    ]
});

export default {
    async fetch({redirect, store}) {
        const data = await store.dispatch('multilanguage/ssrRender', 'blog');
        store.dispatch('questions/action_questions', data);
        return Pasts.get_posts({language:store.state.multilanguage.language_now.id})
            .then(res => {
                store.dispatch('blog_data/action_posts',res.data.data)
            })
    },
    mixins: [Vue2Filters.mixin],
    name: 'blog-page',
    components: {},
    props: [],
    data() {
        return {}
    },
    computed: {
        ...mapGetters({
            posts: 'blog_data/get_posts'
        })
    },
    mounted() {

    },
    methods: {
        downloadPosts(){
            Pasts.get_posts({
                language:this.$store.state.multilanguage.language_now.id,
                page:this.posts.current_page + 1
            })
            .then(res => {
                res.data.data.data = this.posts.data.concat(res.data.data.data);
                this.$store.dispatch('blog_data/action_posts',res.data.data)
            })
        }
    }
}
