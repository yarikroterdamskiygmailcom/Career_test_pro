<template>
    <div class="tests">
        <component :is="component_active"></component>
    </div>
</template>

<script>
    import information_and_start from './information_and_start/index.vue';
    import steps from './steps/index.vue';

    export default {
        name: "TestPage",
        components:{
            'information_and_start-component' : information_and_start,
            'steps-component' : steps,
        },
        data () {
            return {
            }
        },
        created(){
        },
        computed:{
            component_active(){
                return Object.keys(this.$route.params).length == 0
                    ?
                    'information_and_start-component'
                    :
                    'steps-component'
            }
        }
    }
</script>

<style scoped>

</style>
