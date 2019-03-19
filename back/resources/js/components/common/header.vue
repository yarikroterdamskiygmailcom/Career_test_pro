<template>
    <div id="header">
        <div class="logo">
            <router-link to="admin">
                <img src="http://careertestsoft.com/images/logo.png" alt="CareerTestSoft">
            </router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: "header"
    }
</script>

<style scoped>
    #header{
        width: 1000px;
        margin: 0px auto;
        padding: 20px 0px 20px 0px;
    }
</style>
