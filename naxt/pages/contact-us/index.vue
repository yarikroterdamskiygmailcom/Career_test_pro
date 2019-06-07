<template>
    <div class="contact_us d-flex flex-column align-items-center">
        <div class="title_block text-center text-capitalize" v-html="contactUs.title">
            <!--Contact <span style="color:#F9892E">Us</span>-->
        </div>
        <div class="small_text text-center" v-html="contactUs.description">
            <!--Have any questions? Feel free to contact us!-->
        </div>
        <send_message_and_contacts_components
                :contactUs="contactUs">
        </send_message_and_contacts_components>
    </div>
</template>

<script>
    import send_message_and_contacts from '../../components/contact_us_page/send_message_and_contacts/index.vue'
    import {mapGetters} from "vuex";
    import {Tag} from "../../helper/helpTegs";
    import {RETURN_ROUTER} from "../../helper/routerHelp";
    const {base64encode, base64decode} = require('nodejs-base64');
    export default {
        async fetch({redirect, store, route,commit,req}) {
            if(store.getters['multilanguage/get_tests']) {
                store.commit('multilanguage/change_state', {
                    data: true,
                    name: 'active'
                });
                return;
            }
            store.commit('multilanguage/change_state', {
                data: store.getters['multilanguage/get_tests'] + 1,
                name: 'tests'
            });
            let lang = route.query.lang;
            const rout = route && route.fullPath ? route.fullPath.split('/')[1] : '';
            !lang ? lang = 'en' : null;
            const data = await store.dispatch('multilanguage/ssrRender', {lang, rout, redirect});
            await store.dispatch('questions/action_questions', data);
            const res =  await store.dispatch('meta/action_tegs', {
                store:lang ? lang : store.getters['multilanguage/get_language_now'],
                page:rout
            });
            store.commit('multilanguage/change_state', {
                data: true,
                name: 'active'
            });
        },
        created(){
            try {
                const resRout = RETURN_ROUTER.initRouter(this.$router.history.current);
                if (resRout) window.location.href = `/?rout=${base64encode(resRout)}`;
            } catch (e) {}
        },
        head () {
            return {
                meta: Tag.getArrayTags(this.meta),
            }
        },
        name: "ContactUs",
        components: {
            'send_message_and_contacts_components': send_message_and_contacts
        },
        computed:{
            ...mapGetters({
                contactUs: 'multilanguage/getContactUsSection',
                meta: 'meta/get_meta'
            })
        }
    }
</script>

<style scoped>
    .contact_us {
        margin-top: 90px;
        margin-bottom: 254px;
    }

    @media screen and (max-width: 1200px) {
        .title_block {
            font-size: 20px;
        }

        .small_text {
            font-size: 14px;
        }
    }

    @media screen and (max-width: 900px) {

    }

    @media screen and (max-width: 767px) {
        .title_block {
            font-size: 14px;
        }
        .contact_us {
            margin-top: 50px;
        }
        .small_text {
            font-size: 12px;

        }
    }


</style>
