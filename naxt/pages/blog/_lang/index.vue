<template>
    <div>
        <div class="blog-page d-flex flex-column align-items-center">
            <!--v-if="!screen.active"-->
            <div class="title_block custom_title text-capitalize vstyle"
                 v-if="blog && blog.title"
                 v-html="blog.title">
            </div>
            <div class="small_text custom_small_title vstyle"
                 v-if="blog && blog.description"
                 v-html="blog.description">
            </div>
            <div class="check_block_img position-relative">
                <div class="check_image"></div>
            </div>
            <div class="fresh_post d-flex" v-if="posts && posts.data && posts.data[0] && screen.value >= 720">
                <div class="fresh_content d-flex flex-column">
                    <div class="post-title" style="word-break: break-all;"
                         v-if="posts.data[0].title"
                         v-html="posts.data[0].title">
                    </div>
                    <div class="post-description"
                         v-if="posts.data[0].created_at">
                        {{posts.data[0].created_at | dataMoment}}
                    </div>
                    <div class="post-content vstyle pstyle"
                         v-if="posts.data[0].body"
                         v-html="getScreenData">
                    </div>
                    <div class="d-flex flex-grow-1">

                        <router-link :to="`/blog/${posts.data[0].id}/${$store.state.multilanguage.language_now.code}`"
                                     class="learn_more" style="cursor: pointer"
                                     v-if="blog && blog.learn_more"
                                     v-html="blog.learn_more">
                        </router-link>

                    </div>
                </div>
                <div class="fresh_img" v-if="posts.data[0].image" style="width: 100%; position: relative">
                    <div style="background-size: contain; background-position: right; background-repeat: no-repeat;
                height: 100%; width: 100%; text-align: right;"
                         :style="{backgroundImage: 'url('+ posts.data[0].image+')'}">
                    </div>
                </div>
            </div>
            <div v-if="screen.value < 720" class="fresh_post d-flex flex-column"
                 style="height: auto;max-height: inherit">
                <div class="post-title align-self-center" style="word-break: break-all;margin-bottom: 10px"
                     v-if="posts.data[0].title"
                     v-html="posts.data[0].title">
                </div>
                <div class="post-description align-self-center"
                     style="margin-bottom: 20px"
                     v-if="posts.data[0].created_at">
                    {{posts.data[0].created_at | dataMoment}}
                </div>
                <!--<div class="fresh_img" v-if="posts.data[0].image">-->
                <img style="width: 100%; margin-bottom: 30px"
                     v-if="posts.data[0].image" :src="posts.data[0].image" >
                <!--</div>-->
                <div class="post-content vstyle pstyle"
                     v-if="posts.data[0].body"
                     v-html="getScreenData">
                </div>

                <router-link :to="`/blog/${posts.data[0].id}/${$store.state.multilanguage.language_now.code}`"
                             class="learn_more" style="cursor: pointer"
                             v-if="blog && blog.learn_more"
                             v-html="blog.learn_more">
                </router-link>

            </div>
            <div class="search" v-if="posts && posts.data.length > 1 && blog && blog.input">
                <input type="search" :placeholder="blog.input">
            </div>
            <div class="search story" v-if="posts && posts.data.length > 1 && blog && blog.story"
                 v-html="blog.story">
            </div>
            <!--<div class="containerPost">-->
            <div v-for="(one, index) in posts.data"
                 v-if="posts && posts.data.length > 1 && screen.value > 720 && index != 0"
                 class="fresh_post all_post d-flex">
                <div class="fresh_content-all" style="width: 100%">
                    <div class="post-title post-title-all"
                         v-if="one.title"
                         v-html="one.title">
                    </div>
                    <div class="post-description post-description-all"
                         v-if="one.created_at">
                        {{one.created_at | dataMoment}}
                    </div>
                    <div class="post-content post-content-all pstyle"
                         v-if="one.body"
                         v-html="one.body.substring(0,120) + '...'">
                    </div>

                    <router-link :to="`/blog/${one.id}/${$store.state.multilanguage.language_now.code}`"
                                 class="learn_more" style="cursor: pointer"
                                 v-if="blog && blog.learn_more"
                                 v-html="blog.learn_more">
                    </router-link>

                </div>
                <div v-if="one.image" style="width: 50%">
                    <div style="background-size: contain; background-position: right;
                    background-repeat: no-repeat; height: 100%; width: 100%; text-align: right;"
                         :style="{backgroundImage: 'url('+ one.image+')'}">
                    </div>
                </div>
            </div>

            <div v-for="one in posts.data"
                 v-if="screen.value < 720 && screen.value >= 520 && posts && posts.data.length > 1 && index != 0"
                 class="fresh_post all_post d-flex"
                 style="max-height: inherit">
                <div class="fresh_content-all" style="width: 100%;">
                    <div class="post-title post-title-all"
                         v-if="one.title"
                         v-html="one.title">
                    </div>
                    <div class="post-description post-description-all"
                         v-if="one.created_at">
                        {{one.created_at | dataMoment}}
                    </div>
                    <div class="post-content post-content-all pstyle"
                         v-if="one.body"
                         v-html="one.body.substring(0,120) + '...'">
                    </div>

                    <router-link :to="`/blog/${one.id}/${$store.state.multilanguage.language_now.code}`"
                                 class="learn_more" style="cursor: pointer"
                                 v-if="blog && blog.learn_more"
                                 v-html="blog.learn_more">
                    </router-link>

                </div>
                <div class="fresh_img" v-if="one.image" style="width: 50%">
                    <div style="background-size: contain; background-position: right;
                background-repeat: no-repeat; height: 100%; width: 100%; text-align: right;"
                         :style="{backgroundImage: 'url('+ one.image+')'}">
                    </div>

                </div>
            </div>

            <div v-for="one in posts.data"
                 v-if="screen.value < 520 && posts && posts.data.length > 1 && index != 0"
                 class="fresh_post all_post d-flex flex-column"
                 style="max-height: inherit">
                <div class="post-title align-self-center" style="word-break: break-all;margin-bottom: 5px"
                     v-if="one.title"
                     v-html="one.title">
                </div>
                <div class="post-description align-self-center"
                     style="margin-bottom: 20px"
                     v-if="one.created_at">
                    {{one.created_at | dataMoment}}
                </div>
                <!--<div class="fresh_img" v-if="posts.data[0].image">-->
                <img style="width: 100%;margin-bottom: 30px" v-if="one.image" :src="one.image">
                <!--</div>-->
                <div class="post-content vstyle pstyle"
                     v-if="one.body"
                     v-html="one.body.substring(0,320) + '...'" style="margin-bottom: 10px">
                </div>

                <router-link :to="`/blog/${one.id}/${$store.state.multilanguage.language_now.code}`"
                             class="learn_more" style="margin-bottom: 30px;cursor: pointer"
                             v-if="blog && blog.learn_more"
                             v-html="blog.learn_more">
                </router-link>

            </div>
            <!--</div>-->
            <div class="button_to d-flex justify-content-center
            align-items-center text-decoration-none
            custom_button vstyle clstyle orange_style load"
                 v-if="posts && posts.data.length > 1 && posts.current_page < posts.last_page && blog && blog.load"
                 v-html="blog.load"
                 @click="downloadPosts()">
            </div>
        </div>
    </div>
</template>
<script>
    import {Pasts} from "../../../api/posts";
    import {mapGetters} from "vuex";
    import Vue from 'vue'
    import Vue2Filters from 'vue2-filters'
    import VueFilterDateFormat from 'vue-filter-date-format';
    import VueFilterDateParse from 'vue-filter-date-parse';
    import axios from "axios";
    import {Tag} from "../../../helper/helpTegs";
    import {RETURN_ROUTER} from "../../../helper/routerHelp";
    const {base64encode, base64decode} = require('nodejs-base64');
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
        async fetch({redirect, store, route,commit,req}) {
            let lang = route && route.params && route.params.lang ? route.params.lang : '';
            !lang ? lang = 'en' : null;
            if(store.getters['multilanguage/get_tests']) {}
            else {
                store.commit('multilanguage/change_state', {
                    data: store.getters['multilanguage/get_tests'] + 1,
                    name: 'tests'
                });
                const rout = route && route.fullPath ? route.fullPath.split('/')[1] : '';

                const data = await store.dispatch('multilanguage/ssrRender', {lang, rout, redirect});
                await store.dispatch('questions/action_questions', data);
                const res =  await store.dispatch('meta/action_tegs', {
                    store:lang ? lang : store.getters['multilanguage/get_language_now'],
                    page:rout
                });
            }
            const id = store.getters['multilanguage/get_language_now'].id;
            return Pasts.get_posts({language:id ? id : 1})
                .then(res => {
                    store.dispatch('blog_data/action_posts',res.data.data);
                    store.commit('multilanguage/change_state', {
                        data: true,
                        name: 'active'
                    });
                })
        },
        head () {
            return {
                meta: Tag.getArrayTags(this.meta),
            }
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
                posts: 'blog_data/get_posts',
                screen: 'modal_data/get_screen',
                meta: 'meta/get_meta',
                blog: 'multilanguage/getBlog',
            }),
            getScreenData() {
                switch (this.screen.value) {
                    case 1200:
                        return this.getDataScreen(190);
                    case 900:
                        return this.getDataScreen(160);
                    case 750:
                        return this.getDataScreen(155);
                    case 450:
                        return this.getDataScreen(140);
                    default:
                        return this.getDataScreen(220);
                }
            }
        },
        created(){
            try {
                const resRout = RETURN_ROUTER.initRouter(this.$router.history.current);
                if (resRout) window.location.href = `/?rout=${base64encode(resRout)}`;
            } catch (e) {
            }
        },
        methods: {
            getDataScreen(number){
                return this.posts && this.posts.data && this.posts.data[0].body.substring(0,number) + '...';
            },
            downloadPosts(){
                Pasts.get_posts({
                    language:this.$store.state.multilanguage.language_now.id,
                    page:this.posts.current_page + 1
                })
                .then(res => {
                    res.data.data.data = this.posts.data.concat(res.data.data.data);
                    this.$store.dispatch('blog_data/action_posts',res.data.data)
                })
            },
        },
    }

</script>
<style scoped lang="scss">
    .blog-page {
        margin-top: 90px;
    }

    .custom_small_title {
        margin-bottom: 60px;
        font-weight: 500;
        font-size: 16px;
        line-height: 29px;
    }

    .check_image {
        width: 212px;
        height: 212px;
        background-image: url("http://backcartestpro.qbex.io/assets/blog_page/blog_page.svg");
        background-repeat: no-repeat;
        background-position: center;
        margin-bottom: 80px;

    }
    .fresh_post img{
        border-radius: 5px;
    }
    .fresh_post {
        width: 100%;
        max-width: 920px;
        //max-height: 420px;
        background: #FFFFFF;
        box-shadow: 0px 0px 7px rgba(0, 0, 0, 0.1);
        border-radius: 20px;
        padding: 65px 43px;
        margin-bottom: 100px;
    }
    .fresh_content{
        margin-right: 81px;
        width: 100%;

    }
    .fresh_content-all{
        width: 120%;
        margin-right: 30px;
    }
    .fresh_img{
        //width: 100%
    }
    .fresh_img img{
        height: 100%;
    }
    .fresh_img-all{
        width: 70%
    }
    .all_post{
        width: 100%;
        max-height: 207px;
        padding: 26px 40px;
        margin-bottom: 50px;
    }
    .all_post .fresh_img{
        //width: 100%;
        display: flex;
        justify-content: flex-end;
    }
    .all_post .fresh_img img{
        height: 100%;
        width: auto;
    }
    .post-title {
        font-weight: 600;
        font-size: 20px;
        line-height: 24px;
        color: #333333;
        margin-bottom: 18px;
    }
    .post-title-all {
        font-size: 16px;
        color: #333333;
        margin-bottom: 10px;
    }
    .post-description {
        font-size: 14px;
        line-height: 80%;
        font-variant: small-caps;
        color: #8B8B8B;
        word-break: break-all;
        margin-bottom: 40px;
    }
    .post-description-all {
        margin-bottom: 10px;
    }
    .post-content {
        font-size: 14px;
        line-height: 170%;
        margin-bottom: 30px;
    }
    .post-content-all {
        margin-bottom: 20px;
        font-size: 13px;
        line-height: 160%;
    }
    .learn_more {
        font-size: 14px;
        text-decoration-line: underline;
        color: #4876D0;
        font-weight: 600;
    }

    .search {
        width: 920px;
    }

    .search input {
        background: #FFFFFF;
        border: 1px solid #DFDFDF;
        box-sizing: border-box;
        border-radius: 22px;
        width: 400px;
        background-image: url("http://backcartestpro.qbex.io/assets/blog_page/search.svg");
        background-size: 16px;
        background-repeat: no-repeat;
        background-position: 34px 13px;
        padding-left: 70px;
        padding-right: 15px;
        height: 44px;
        font-size: 14px;
        line-height: 17px;
        color: #8B8B8B;
        transition: 1s all;
        margin-bottom: 40px;
    }

    .search input:focus {
        outline: none;
        width: 100%;
        border: 1px solid #85B1F5;
    }

    .search input:hover {
        border: 1px solid #D8E1F0;
    }
    .story{
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 40px;
    }
    .orange_style{
        margin-top: 80px;
        margin-bottom: 103px;
    }
    .containerPost{
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    @media screen and (max-width: 1024px) {
        .fresh_post, .all_post{
            max-width: 930px;
        }
        .search{
            width: 100%;
        }
        .blog-page{
            margin: 0 48px;
            margin-top: 20px;
        }
    }

    @media screen and (max-width: 720px) {
        .fresh_post{
            padding:30px;
        }
        .pstyle > p{
            word-break: keep-all;
        }
        .blog-page{
            margin: 0 30px;
            margin-top: 20px;
        }
        .post-title, .title_block{
            font-size: 18px;
            text-align: center;
        }
        .post-description, .small_text{
            font-size: 16px;
            text-align: center;
        }
    }
    @media screen and (max-width: 720px) {
        .fresh_post{
            padding:15px;
        }
        .pstyle > p{
            word-break: keep-all;
        }
        .blog-page{
            margin: 0 15px;
            margin-top: 15px;
        }
        .post-title, .title_block{
            font-size: 16px;
            text-align: center;
        }
        .post-description, .small_text{
            font-size: 14px;
            text-align: center;
        }
    }
    @media screen and (max-width: 440px) {
        .search input{
            width: 100%;
        }
        .post-title, .title_block{
            font-size: 14px;
            text-align: center;
        }
        .post-description, .small_text{
            font-size: 12px;
            text-align: center;
        }
        .load{
            width: 100%
        }
    }

</style>

