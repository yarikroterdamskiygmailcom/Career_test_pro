<template>
    <div>
        <ul class="headmenu">
            <li v-for="item in list">
                <router-link :to="item.path">{{item.name}}</router-link>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ['list']
    }
</script>

<style scoped>
    @import "./../../style/menu.css";
</style>
