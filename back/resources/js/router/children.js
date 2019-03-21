import panel_home from'../components/panel/component_panel/home.vue';
import panel_careers from'../components/panel/component_panel/careers.vue';
import panel_test from'../components/panel/component_panel/test.vue';
import panel_report from'../components/panel/component_panel/report.vue';
import panel_settings from'../components/panel/component_panel/settings.vue';
import {settings_children} from "./nested_child/children_settings";
import {test_children} from "./nested_child/children_test";


export const panel_children = [
    {path: '', redirect: '/panel/home'},
    {
        path: '/panel/home',
        component: panel_home,

    },
    {
        path: '/panel/test',
        component: panel_test,
        children: test_children
    },
    {
        path: '/panel/report',
        component: panel_report
    },
    {
        path: '/panel/careers',
        component: panel_careers
    },
    {
        path: '/panel/settings',
        component: panel_settings,
        children: settings_children
    }
];
