<template>
    <div>
        <h3>
            Languages
        </h3>
        <div class="custom-select" style="width:200px;">
            <select>
                <option value="0" v-for="item in languages_list"></option>
            </select>
        </div>
    </div>
</template>

<script>
    import {Settings} from "../../../../api/panel_settings/settings";

    export default {
        name: "languages",
        data(){
          return{
              languages_list:[]
          }
        },
        created(){
            Settings.list_language()
                .then(res => console.log(res))
        }
    }
</script>

<style scoped>

</style>
