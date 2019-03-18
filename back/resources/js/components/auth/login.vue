<template>
    <div class="login">
        <h1>Login op het admin panel</h1>
        <form>
            <div class="form-input">
                <input type="text" name="email" v-model="data.email" placeholder="Email">
            </div>
            <div class="form-input">
                <input type="password" name="password" v-model="data.password" placeholder="Password">
            </div>
            <div class="form-input">
                <input class="submit" @click="submit()" type="button" name="login" value="Login">
            </div>
        </form>
    </div>
</template>

<script>
    import Validator from "../../validator/validator";

    export default {
        name: "login",
        data(){
            return {
                data:{
                    email:'',
                    password:'',
                },
                error:{}
            }
        },
        methods:{
            submit(){
                let error = this.error;
                let data = this.data;
                error.email =      Validator.set(data.email, ['required', 'email']);
                error.password =   Validator.set(data.password, ['required']);
                console.log(error)
            }
        }
    }
</script>

<style scoped src="./auth.css"></style>
