import settings_users from'../../components/panel/component_panel/settings/users.vue';
import settings_languages from'../../components/panel/component_panel/settings/languages.vue';
import settings_price from'../../components/panel/component_panel/settings/price.vue';
// import panel_test from'../../components/panel/component_panel/test.vue';
// import panel_report from'../../components/panel/component_panel/report.vue';
// import panel_settings from'../../components/panel/component_panel/settings.vue';


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
    // {
    //     path: '/panel/report',
    //     component: panel_report
    // },
    // {
    //     path: '/panel/careers',
    //     component: panel_careers
    // },
    // {
    //     path: '/panel/settings',
    //     component: panel_settings
    // }
];
