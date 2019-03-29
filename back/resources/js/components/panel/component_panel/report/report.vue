<template>
    <div>
        <v-btn color="primary" flat @click="dialog = true">
            open
        </v-btn>
        {{content}}
        <v-dialog v-model="dialog" width="1000">
            <v-card>
                <v-card-title class="headline grey lighten-2" primary-title>
                    <!--<div style="margin-right: 20px">№ {{data_modal.number}}</div>-->
                </v-card-title>
                <v-card-text>
                    <vue-editor
                            :editorToolbar="customToolbar"
                            v-model="content">
                    </vue-editor>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" flat @click="dialog = false">
                        Save
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
    import { VueEditor } from 'vue2-editor'
    import Editor from '@tinymce/tinymce-vue';
    export default {
        name: "report",
        data(){
            return {
                dialog:false,
                content: ' <h1>Initial Content3423 4<span style="color: rgb(0, 41, 102);">234234234234</span></h1>',
                customToolbar: [
                    [{ 'font': [] }],
                    [{ 'header': [false, 1, 2, 3, 4, 5, 6, ] }],
                    [{ 'size': ['small', false, 'large', 'huge'] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{'align': ''}, {'align': 'center'}, {'align': 'right'}, {'align': 'justify'}],
                    [{ 'header': 1 }, { 'header': 2 }],
                    ['blockquote', 'code-block'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'list': 'check' }],
                    [{ 'script': 'sub'}, { 'script': 'super' }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],
                    [{ 'color': [] }, { 'background': [] }],
                    ['link', 'image', 'video', 'formula'],
                    [{ 'direction': 'rtl' }],
                    ['clean'],
                ]
            }
        },
        components: {
            'editor': Editor,
            VueEditor// <- Important part
        }
    }
</script>

<style scoped>

</style>
