<template>
    <div id="banner_container">
        <div class="banner"></div>
    </div>
</template>

<script>
    export default {
        name: "banner_container"
    }
</script>

<style scoped>
    #banner_container {
        background: #eee;
        border: 1px #cecece solid;
        border-width: 1px 0px 1px 0px;
    }
    #banner_container .banner {
        width: 1000px;
        margin: 0px auto;
        padding: 20px 0px 20px 0px;
        display: table;
    }
</style>
