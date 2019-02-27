import home_page  from '../components/home_page/HomePage.vue';
import about_us_page from'../components/about_us_page/AboutUs.vue';
import contact_us_page from'../components/contact_us_page/ContactUs.vue';
import faq_page from'../components/faq_page/FaqPage.vue';
import confirm_page from'../components/process_confirm_page/ProcessConfirmPage.vue';
import final_page from'../components/final_page/FinalPage.vue';
import tests_page from'../components/test_page/TestPage.vue';
import Vue from 'vue'
import VueRouter from "vue-router";
Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { path: '*',                           redirect: '/home'},
        { path: '/',                           redirect: '/home'},
        { path: '/home',                       component: home_page },
        { path: '/about-us',                   component: about_us_page },
        { path: '/contact-us',                 component: contact_us_page },
        { path: '/faq',                        component: faq_page },
        { path: '/confirm-detail',             component: confirm_page },
        { path: '/tests',                      component: tests_page },
        { path: '/tests/:steps/:child_step',   component: tests_page },
        { path: '/tests/:steps/',              component: tests_page },
        { path: '/final',                      component: final_page },
    ],
    mode:'history'
});
