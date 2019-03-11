import Vue from 'vue';
import VueScrollTo  from 'vue-scrollto';
import {mapGetters} from "vuex";

Vue.use(VueScrollTo);

export default {
    data(){
        return {
            text: "<div class=\"more-in-your-personality_text\"> Do you want to " +
                "<span style=\"color:#F9892E\">gain more<br> insight</span> in your personality? </div> " +
                "<div class=\"small_text\"> Our test will give you clear areas of interest<br>" +
                " and professions which suits you best!" +
                " </div> <div class=\"d-flex justify-content-between\"> <a class=\"button_to text_style\"> " +
                "Take the Test </a> " +
                "<a class=\"button_to text_style orange_style\"> Take the Test </a> </div>"
        }
    },
    computed:{
        ...mapGetters({
            screen: 'modal_data/get_screen'
        })
    }
}
