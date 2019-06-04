<template>
    <div id="faq" class="d-flex justify-content-center flex-column align-items-center">
        <block_with_acordeon_component
                :title="faqPage.title"
                :description="faqPage.description"
        ></block_with_acordeon_component>
        <div class="container_faq_acordeon">
            <acordeon_component v-for="(item, index) in listAccordeon"
                   :item_acordeon="item" :position="index"
                   :key="index"  @open_item_acordeon="open($event)">
            </acordeon_component>
        </div>
    </div>
</template>

<script>
    import Block_with_acordeon from '../../../components/faq_page/block_with_acordeon/index.vue'
    import Acordeon from '../../../components/faq_page/acordeon/index.vue'
    import {mapGetters} from "vuex";
    import {Tag} from "../../../helper/helpTegs";
    import {nuxtServerInit} from "../../../store/helpers/initServer";
    export default {
        async fetch({redirect, store, route, commit,req}) {
            const lang = route.params.lang;
            const rout = route && route.fullPath ? route.fullPath.split('/')[2] : '';
            !rout && redirect('/');
            !lang && redirect('/');
            // store.commit('multilanguage/change_state', route.params.lang);

            const data = await store.dispatch('multilanguage/ssrRender', {lang, rout, redirect});
            //
            await store.dispatch('questions/action_questions', data);
            //
            const res =  await store.dispatch('meta/action_tegs', {
                store:lang ? lang : store.getters['multilanguage/get_language_now'],
                page:rout
            });
            if(res) store.commit('multilanguage/change_state', {
                data: true,
                name: 'active'
            });
        },
        head () {
            return {
                meta: Tag.getArrayTags(this.meta),
            }
        },
        name: "FaqPage",
        data (){
            return {
                listAccordeon:[]
            }
        },
        methods:{
            open(data){
                this.listAccordeon[data.index].active = !this.listAccordeon[data.index].active;
            }
        },
        created(){
            this.listAccordeon = JSON.parse(JSON.stringify(this.faqPage.arr));
        },
        computed:{
            ...mapGetters({
                faqPage: 'multilanguage/getFaqPageSection',
                meta: 'meta/get_meta'
            })
        },
        components:{
            'block_with_acordeon_component' : Block_with_acordeon,
            'acordeon_component' : Acordeon,
        }
    }
</script>

<style scoped>
    #faq{
        width: 100%;
        margin-top: 70px;
        margin-bottom: 264px;
    }
    .container_faq_acordeon{
        width: 855px;
    }
    @media screen and (max-width:1200px){
        .container_faq_acordeon{
            width: 75%;
            margin: 0 127px;
        }
        #faq{
            margin-bottom: 104px;
        }
    }

    @media screen and (max-width:900px){
        .container_faq_acordeon{
            width: 80%;
            margin: 0 100px;
        }
    }

</style>

