import content_tabs from './../content_tabs/index'
export default {
    components: {
        'content_tabs_component': content_tabs
    },
    data() {
        return {
            list_tabs: [
                {
                    name:'Our Service',
                    content:'<p>CareertestPro is a service for ' +
                        'anyone who wants to gain more insight in' +
                        ' their personality and which professions fit them best.</p>\n' +
                        '\n' +
                        '<p>It is based on the theory of the ' +
                        'Holland Codes or the Holland Occupational Themes (RIASEC).</p>\n' +
                        '\n' +
                        '<p>This theoretical framework was ' +
                        'developed by J.L. Holland and refers to a ' +
                        'theory of careers and vocational choice based upon personality types.</p>\n' +
                        '\n' +
                        '<p>Each letter of the RIASEC code stands for a ' +
                        'particular personality type, being:</p>',
                    path:'http://backcartestpro.qbex.io/assets/about_us/our_service.png',
                    list:[
                        'Realistic personality type (Doers);',
                        'Investigative personality type (Thinkers);',
                        'Artistic personality type (Creators);',
                        'Social personality type (Helpers);',
                        'Enterprising personality type (Persuaders);',
                        'Conventional personality type (Organizers).',
                    ],
                },
                {
                    name:'Our Mission',
                    content:'<p class="rer">Our mission is to give you a clear result ' +
                        'in a form of report, which ellaborates on a ' +
                        'composition of your personality.</p>\n' +
                        '\n' +
                        '<p>We are keen to help you impove it by providing a' +
                        ' clear report with areas of interest and professions ' +
                        'that could suit you best.</p>\n' +
                        '\n' +
                        '<p>Every profession that is mentioned in this personal ' +
                        'report comes with an educational level, so you instantly ' +
                        'see what the requirements are for that specific profession.</p>\n' +
                        '\n' +
                        '<p>We made this service for everyone - means it ' +
                        'doesn\'t matter if you\'re already graduated or if ' +
                        'you’re working. You can still take the test to get a ' +
                        'clearer view of your personality and see which professions ' +
                        'suit you best.</p>\n' +
                        '\n' +
                        '<p>Also, we are happy to inform you that the CareertestPro ' +
                        'is fully anonymous and is not saved on our servers - means, ' +
                        'after finishing test you will get result and a copy will be sent ' +
                        'on your email.</p>'
                        ,
                    path:'http://backcartestpro.qbex.io/assets/about_us/our_mission.png'
                },
                {
                    name:'Our Team',
                    content:'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,' +
                        ' sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>\n' +
                        '\n' +
                        '<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco ' +
                        'laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum ' +
                        'dolor sit amet, consectetur adipiscing elit, sed do eiusmod ' +
                        'tempor incididunt ut labore et dolore magna \n' +
                        'aliqua.</p>\n' +
                        '\n' +
                        '<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco l' +
                        'aboris nisi ut aliquip ex ea commodo consequat.</p>\n' +
                        '\n' +
                        '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do' +
                        ' eiusmod tempor incididunt ut labore et dolore magna. Lorem ipsum ' +
                        'dolor sit amet, consectetur adipiscing.</p>\n' +
                        '\n' +
                        '<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris ' +
                        'nisi ut aliquip ex ea commodo consequat.</p>',
                    path:'http://backcartestpro.qbex.io/assets/about_us/our_team.png',
                    style:{
                        top: '-2px',
                        left: '1px'
                    }
                },
            ],
            tab:{
                active_tab: null,
                width_tab: 98,
                tab_translate:0,
                margin:0
            }
        }
    },
    computed: {},
    mounted() {
        this.tab.active_tab = this.list_tabs[0];
        this.first_width(this.list_tabs[0].name + 0)
    },
    methods: {
        open_tab(tab, new_data){
            let text_width = event.currentTarget.childNodes[0].offsetWidth;
            let block_text_width = event.currentTarget.offsetWidth;
            let block_tab = event.currentTarget.parentNode.offsetWidth;
            this.tab.active_tab = tab;
            this.tab.width_tab = text_width;
            this.tab.tab_translate = block_text_width * tab;
            if(tab == this.list_tabs.length -1){
                this.tab.tab_translate = block_tab - text_width;
            }
            this.tab.margin = tab == 0 || tab == this.list_tabs.length -1 ? 0 :
                (block_text_width - text_width) / 2;
            this.tab.active_tab = new_data;
        },
        first_width(name){
            this.tab.width_tab = this.$refs[name] ? this.$refs[name][0].offsetWidth : this.tab.width_tab
        }
    },
    watch:{

    }
}
