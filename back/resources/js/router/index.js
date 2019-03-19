// import home_page  from '../components/home_page/HomePage.vue';
// import about_us_page from'../components/about_us_page/AboutUs.vue';
// import contact_us_page from'../components/contact_us_page/ContactUs.vue';
// import faq_page from'../components/faq_page/FaqPage.vue';
// import confirm_page from'../components/process_confirm_page/ProcessConfirmPage.vue';
// import final_page from'../components/final_page/FinalPage.vue';
import Vue from 'vue';
import VueRouter from "vue-router";
Vue.use(VueRouter);
import register from'../components/auth/register.vue';
import login from'../components/auth/login.vue';
// import router from './router/index'
export default new VueRouter({
    base: '/admin',
    routes: [
        // { path: '*',                redirect: '/register'},
        // { path: '/',                redirect: '/register'},
        { path: '/register',        component: register},
        { path: '/login',        component: login},
    ],
    mode:'history'
});
