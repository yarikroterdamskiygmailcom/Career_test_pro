export default {
    name: 'information-steps-modal',
    components: {},
    props: ['data'],
    data() {
        return {}
    },
    computed: {},
    mounted() {

    },
    methods: {
        close_modal(){
            this.$store.dispatch('modal_data/action_active_modal', {
                name: 'test_modal',
                active: false,
                modal_data: {},
            });
        }
    }
}
