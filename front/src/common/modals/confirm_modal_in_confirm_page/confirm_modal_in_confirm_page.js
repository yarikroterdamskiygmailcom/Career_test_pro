import counter from "../../../components/test_page/counter";

export default {
    name: 'confirm-modal-in-confirm-page',
    components: {},
    props: ['data'],
    data() {
        return {}
    },
    methods: {
        close_modal(){
            this.$store.dispatch('modal_data/action_active_modal', {
                name: 'confirm_modal',
                active: false,
                modal_data: {},
            });
        },
        confirm(){
            console.log(this.data)
        }
    }
}
