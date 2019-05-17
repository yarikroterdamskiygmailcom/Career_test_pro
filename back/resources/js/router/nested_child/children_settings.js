import settings_users from'../../components/panel/component_panel/settings/users.vue';
import settings_price from'../../components/panel/component_panel/settings/price.vue';
import test_codes from'../../components/panel/component_panel/settings/test_codes.vue';
import site from'../../components/panel/component_panel/settings/site.vue';
import languages from'../../components/panel/component_panel/settings/languages.vue';
import invoices from'../../components/panel/component_panel/settings/invoices.vue';
import blog from'../../components/panel/component_panel/settings/blog.vue';



export const settings_children = [
    {path: '', redirect: '/panel/settings/price'},
    {
        path: '/panel/settings/price',
        component: settings_price
    },
    {
        path: '/panel/settings/users',
        component: settings_users
    },
    {
        path: '/panel/settings/test-codes',
        component: test_codes
    },
    {
        path: '/panel/settings/site',
        component: site
    },
    {
        path: '/panel/settings/languages',
        component: languages
    },
    {
        path: '/panel/settings/invoices',
        component: invoices
    },
    {
        path: '/panel/settings/blog',
        component: blog
    }
];
