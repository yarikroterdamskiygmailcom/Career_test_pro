export default {
    name: 'confirm-modal-in-confirm-page',
    components: {},
    props: [],
    data() {
        return {}
    },
    computed: {},
    mounted() {

    },
    methods: {
        close_modal(){
            this.$store.dispatch('modal_data/action_active_modal', {
                name: 'confirm_modal',
                active: false,
                modal_data: {},
            });
        }
    }
}
