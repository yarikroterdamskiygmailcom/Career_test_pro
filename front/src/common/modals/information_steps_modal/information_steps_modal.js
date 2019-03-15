export default {
    name: 'information-steps-modal',
    components: {},
    props: ['data'],
    data() {
        return {
            transitions: false
        }
    },
    computed: {},
    mounted() {
        setTimeout(v => this.transitions = !this.transitions, 200)
    },
    methods: {
        close_modal(){
            this.transition = !this.transition
            this.$store.dispatch('modal_data/action_active_modal', {
                name: 'test_modal',
                active: false,
                modal_data: {},
            });
        }
    }
}
