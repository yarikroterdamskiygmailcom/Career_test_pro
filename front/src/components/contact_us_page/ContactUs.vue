<template>
    <div class="contact_us d-flex flex-column align-items-center">
        <div class="title_block text-center text-uppercase">
            Contact <span style="color:#F9892E">Us</span>
        </div>
        <div class="small_text text-center">
            Have any questions? Feel free to contact us!
        </div>
        <send_message_and_contacts_components></send_message_and_contacts_components>
    </div>
</template>

<script>
    import send_message_and_contacts from './send_message_and_contacts/index.vue'
    export default {
        name: "ContactUs",
        components:{
            'send_message_and_contacts_components': send_message_and_contacts
        }
    }
</script>

<style scoped>
    .contact_us{
        margin-top: 90px;
        margin-bottom: 254px;
    }
</style>
