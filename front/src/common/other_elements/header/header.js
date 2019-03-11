import {mapGetters} from "vuex";

export default {
    data() {
        return{
            menu: false
        }
    },
    methods:{
        language(item){
            console.log(item);
        }
    },
    computed:
        mapGetters({
            language_now:    'multilanguage/get_language_now',
            menu_list:       'multilanguage/get_menu_list',
            language_array:  'multilanguage/get_language_array',
            screen:          'modal_data/get_screen'
        }),
    watch:{
        menu:function(){
            document.body.style.overflowY = this.menu ? 'hidden' : 'scroll'
        }
    },
}
