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
    import send_message_and_contacts from '../../../components/contact_us_page/send_message_and_contacts/index.vue'
    import {mapGetters} from "vuex";
    import {Tag} from "../../../helper/helpTegs";
    import {nuxtServerInit} from "../../../store/helpers/initServer";

    export default {
        async fetch({redirect, store, route,commit,req}) {
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
