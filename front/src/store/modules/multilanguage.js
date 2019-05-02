// initial state

import list_language from './../../api/multilanguage_request';
import questions from "../../api/questions";
import Helper_count from "../helpers/count";
import Helper_CreateObject from "../helpers/multilanguage_counter";
import vue from 'vue'
import {IndexLanguage} from "../localStorage";
const state = {
    active: false,
    language_now: {
        id: 1,
        language: "English",
        code: "en"
    },
    menu_list: [
        {
            name: 'Home',
            path: '/home'
        },{
            name: 'FAQ',
            path: '/faq'
        },{
            name:  'Blog',
            path: '/blog'
        },{
            name:  'Contact Us',
            path: '/contact-us'
        },{
            name:  'About Us',
            path: '/about-us'
        },
    ],
    language_array:[
        {
            name:'RU',
            full_name:'Russian',
            path: '/ru'
        },
        {
            name: 'EN',
            full_name: 'English',
            path: '/ru'
        }
    ],
    sotial_networks: [
        {
            name: 'linkedin',
            path: 'http://backcartestpro.qbex.io/assets/linkedin.png'
        },{
            name: 'twitter',
            path: 'http://backcartestpro.qbex.io/assets/twitter.png'
        },{
            name: 'facebook',
            path: 'http://backcartestpro.qbex.io/assets/facebook.png'
        },
    ],
    data:{},
    test: false
};

const getters = {
    get_language_now(state) {
        return state.language_now
    },
    get_test(state) {
        return state.test
    },
    get_menu_list (state) {
        return state.menu_list
    },
    get_language_array (state) {
        return state.language_array
    },
    get_sotial_networks (state) {
        return state.sotial_networks
    },
    get_status_project(state){
        return state.active
    },
    getHomeFirstSection(){
        return state.data
               && state.data.HomePage
               && state.data.HomePage.oneSection ? state.data.HomePage.oneSection : {}
    },
    getHomeSecondSection(){
        return state.data
        && state.data.HomePage
        && state.data.HomePage.twoSection ? state.data.HomePage.twoSection : {}
    },
    getHomeThreeSection(){
        return state.data
        && state.data.HomePage
        && state.data.HomePage.threeSection ? state.data.HomePage.threeSection : {}
    },
    getHomeFourSection(){
        return state.data
        && state.data.HomePage
        && state.data.HomePage.fourSection ? state.data.HomePage.fourSection : {}
    },
    getHomeFiveSection(){
        return state.data
        && state.data.HomePage
        && state.data.HomePage.fiveSection ? state.data.HomePage.fiveSection : {}
    },
    getFooterSection(){
        return state.data && state.data.Footer && state.data.Footer
    },
    getFaqPageSection(){
        return state.data &&state.data.FAQPage && state.data.FAQPage.section
    },
    getContactUsSection(){
        return state.data &&state.data.ContactUs && state.data.ContactUs.section
    },
    getAboutUsSection(){
        return state.data &&state.data.AboutUs && state.data.AboutUs.section
    },
    getConfirmDetailSection(){
        return state.data &&state.data.ConfirmDetail && state.data.ConfirmDetail.section
    },
    getValidation(){
        return state.data &&state.data.Validation && state.data.Validation.section
    },
    getFinalSection(){
        return state.data &&state.data.Final && state.data.Final.section
    },
    getTestsSection(){
        return state.data &&state.data.Tests && state.data.Tests.section
    },
    getStepsSection(){
        return state.data &&state.data.Steps && state.data.Steps
    },
    getStepsNameSection(){
        return state.data &&state.data.Step_name && state.data.Step_name
    },
    getConfirmModal(){
        return state.data &&state.data.Modal && state.data.Modal.three
    },
    getOtherModal(){
        return state.data &&state.data.Modal && state.data.Modal.two
    },
    getOneModal(){
        return state.data &&state.data.Modal && state.data.Modal.one
    }
};

/**
 * ----- ACTIONS -----
 **/

const actions = {
    action_change_state({commit}, value){
        commit('change_state', {
            data: value,
            name: 'language_array'
        });
        const data = Helper_count.find_language_now_in_array(value);
        commit('change_state', {
            data: IndexLanguage.getLang() ? IndexLanguage.getLang() : data,
            name: 'language_now'
        });
        list_language.get_site(IndexLanguage.getLang() && IndexLanguage.getLang().id
            ? IndexLanguage.getLang().id : data.id, commit);
        questions.get_questions(IndexLanguage.getLang() && IndexLanguage.getLang().id
            ? IndexLanguage.getLang().id :  data.id, this, commit);
    },
    changeLang({commit}, value){
        list_language.get_site( value.id, commit);
        questions.get_questions(value.id, this, commit);
    },
    action_spinner({commit}, value){
        commit('change_state', value)
    },
};
/**
 * ----- MUTATIONS -----
 * */
const mutations = {
    change_state (state, value) {
        state[value.name] = value.data;
    },
    setVariable(state, value){

        const object = Helper_CreateObject.createObjectSite(value);
        state.data = {...object};

        state.data.FAQPage.section.arr = state.data.FAQPage.section.arr.map(item => {
            item.name = item.title;
            item.active = false;
            item.content = item.description;
            item && item.description && delete item.description;
            item && item.title       && delete item.title;
            item && item.index       && delete item.index;
            return item;
        });

        state.data.Steps = {
            'step-1-2' : {name: state.data.Tests.section.Skills,            state: {...state.data.step_1_2.section}},
            'step-3-4' : {name: state.data.Tests.section.Work_values,       state: {...state.data.step_3_4.section}},
            'step-5-6' : {name: state.data.Tests.section.Activities,        state: {...state.data.step_5_6.section}},
            'step-7-8' : {name: state.data.Tests.section.Personal_Behavior, state: {...state.data.step_7_8.section}},
            'step-9-10' : {name: state.data.Tests.section.Occupations,      state: {...state.data.step_9_10.section}}
        };
        state.data && state.state && state.state.step_1_2 && delete state.state.step_1_2 ;
        state.data && state.state && state.state.step_1_2 && delete state.state.step_3_4 ;
        state.data && state.state && state.state.step_1_2 && delete state.state.step_5_6 ;
        state.data && state.state && state.state.step_1_2 && delete state.state.step_7_8 ;
        state.data && state.state && state.state.step_1_2 && delete state.state.step_9_10;

        state.data.Step_name = {
            'step:1'  : {name: state.data.Tests.section.Skills,            amount: '1-30',},
            'step:2'  : {name: state.data.Tests.section.Skills,            amount: '31-60',},
            'step:3'  : {name: state.data.Tests.section.Work_values,       amount: '61-90',},
            'step:4'  : {name: state.data.Tests.section.Work_values,       amount: '91-120',},
            'step:5'  : {name: state.data.Tests.section.Activities,        amount: '121-150'},
            'step:6'  : {name: state.data.Tests.section.Activities,        amount: '151-180'},
            'step:7'  : {name: state.data.Tests.section.Personal_Behavior, amount: '181-210'},
            'step:8'  : {name: state.data.Tests.section.Personal_Behavior, amount: '211-240'},
            'step:9'  : {name: state.data.Tests.section.Occupations,       amount: '241-270'},
            'step:10' : {name: state.data.Tests.section.Occupations,       amount: '271-300'}
        };

        state.menu_list = state.menu_list.map((item, index) => {
            return {
                name: object.menu_list[index],
                path: item.path
            }
        });
    }
};

export default {
  namespaced: true,
  getters,
  state,
  actions,
  mutations
};
