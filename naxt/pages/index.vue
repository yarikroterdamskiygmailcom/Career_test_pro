<script>
    import {nuxtServerInit} from "../store/helpers/initServer";

    export default {
        fetch({redirect, store},req) {
            // nuxtServerInit(store,req);
            redirect('/en/home')
        }
    }
</script>

