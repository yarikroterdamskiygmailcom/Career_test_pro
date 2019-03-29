
import text_for_scores from'../../components/panel/component_panel/report/text_for_scores.vue';
import careers_list from'../../components/panel/component_panel/careers/list.vue';
// import panel_test from'../../components/panel/component_panel/test.vue';
// import panel_report from'../../components/panel/component_panel/report.vue';
// import panel_settings from'../../components/panel/component_panel/settings.vue';


export const reports_children = [
    {path: '', redirect: '/panel/report/text-for-Scores'},
    {
        path: '/panel/report/text-for-Scores',
        component: text_for_scores
    },
    // {
    //     path: '/panel/careers/career_pages',
    //     component: careers_career_pages
    // },

];
