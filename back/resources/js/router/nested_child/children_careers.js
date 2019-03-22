
import careers_career_pages from'../../components/panel/component_panel/careers/career_pages.vue';
import careers_list from'../../components/panel/component_panel/careers/list.vue';
// import panel_test from'../../components/panel/component_panel/test.vue';
// import panel_report from'../../components/panel/component_panel/report.vue';
// import panel_settings from'../../components/panel/component_panel/settings.vue';


export const careers_children = [
    {path: '', redirect: '/panel/careers/career_pages'},
    {
        path: '/panel/careers/list',
        component: careers_career_pages
    },
    {
        path: '/panel/careers/career_pages',
        component: careers_career_pages
    },

];
