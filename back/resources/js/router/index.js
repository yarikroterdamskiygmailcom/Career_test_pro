
import Vue from 'vue';
import VueRouter from "vue-router";
Vue.use(VueRouter);
import register from'../components/auth/register.vue';
import login from'../components/auth/login.vue';
import reset_password from'../components/auth/reset_password.vue';
import panel from'../components/panel/panel.vue';

export default new VueRouter({
    base: '/admin',
    routes: [
        { path: '/',                 redirect: '/login'},
        { path: '/panel',            component: panel,
            // children: [
            //     {
            //         path: '/home',
            //         component: UserProfile
            //     },
            //     {
            //         path: '/test',
            //         component: UserProfile
            //     },
            //     {
            //         path: '/report',
            //         component: UserPosts
            //     },
            //     {
            //         path: '/careers',
            //         component: UserPosts
            //     },
            //     {
            //         path: '/settings',
            //         component: UserPosts
            //     }
            // ]
        },
        { path: '/reset-password',   component: reset_password},
        { path: '/password-confirm', component: reset_password},
        { path: '/register',         component: register},
        { path: '/login',            component: login},
    ],
    mode:'history'
});
