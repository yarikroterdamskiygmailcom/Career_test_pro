
import test_languages from'../../components/panel/component_panel/test/questions.vue';
import test_categories from'../../components/panel/component_panel/test/categories.vue';
// import panel_test from'../../components/panel/component_panel/test.vue';
// import panel_report from'../../components/panel/component_panel/report.vue';
// import panel_settings from'../../components/panel/component_panel/settings.vue';


export const test_children = [
    {path: '', redirect: '/panel/test/categories'},
    {
        path: '/panel/test/categories',
        component: test_categories
    },
    {
        path: '/panel/test/questions',
        component: test_languages
    },
    // {
    //     path: '/panel/report',
    //     component: panel_report
    // },
];
