<template>
    <div>
        <router-view></router-view>
    </div>
</template>

<script>
    import {Admin} from "../../api/admin";

    export default {
        name: "panel",
        created(){
            Admin.get_user()
        }
    }
</script>

<style scoped>
    h1 {
        font-size: 20px;
        margin-top: 20px;
    }
</style>
