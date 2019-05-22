<template>
    <div id="about_us">
        <Block_with_tabs_component></Block_with_tabs_component>
    </div>
</template>

<script>
    import block_with_tabs from '../components/about_us_page/block_with_tabs'
    export default {
        async fetch({redirect, store}) {
            const data = await store.dispatch('multilanguage/ssrRender');
            store.dispatch('questions/action_questions', data);
        },
        components:{
            'Block_with_tabs_component' : block_with_tabs
        }
    }
</script>

<style>

</style>
