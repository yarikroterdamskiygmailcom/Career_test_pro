import {mapGetters} from "vuex";

export default {
    name: 'information-and-start',
    components: {},
    props: [],
    data() {
        return {}


    },
    computed: {
        ...mapGetters({
            testSection: 'multilanguage/getTestsSection',
            language_now: 'multilanguage/get_language_now'
        }),
        content() {
            return this.testSection && this.testSection.content
                ? this.getArrow(this.testSection.content)
                : ''
        }
    },
    mounted() {

    },
    methods: {
        start_test(){
            this.$router.push({path: `/tests/1/1/${this.language_now.code}`})
        },
        getArrow(text){
            let data = '';
            if(!text) return data;
            function callback(newText){
                data = newText.indexOf('&lt;') > -1
                    || newText.indexOf('&gt;') > -1
                    || newText.indexOf('<p>') > -1
                    || newText.indexOf('</p>') > -1 ?
                    newText.replace('&lt;', '<').replace('&gt;', '>').replace('<p>', '').replace('</p>', '') : newText;
                if(data.indexOf('&lt;') > -1
                    || data.indexOf('&gt;') > -1
                    || data.indexOf('<p>') > -1
                    || data.indexOf('</p>') > -1) {
                    callback(data)
                }
            }
            callback(text);
            return data;
        }
    }
}
