<template>
    <div class="register">
        <h1>Register new admin</h1>
        <form >
            <div class="form-input">
                <input type="text" name="username" v-model="data.name" placeholder="Username">
            </div>
            <div class="form-input">
                <input type="text" name="email" v-model="data.email" placeholder="Email">
            </div>
            <div class="form-input">
                <input type="password" name="password" v-model="data.password" placeholder="Password">
            </div>
            <div class="form-input">
                <input type="password" name="c_password" v-model="data.c_password" placeholder="Repeat password">
            </div>
            <div class="form-input">
                <input type="text" name="key" v-model="data.key" placeholder="security key">
            </div>
            <div class="form-input">
                <input class="submit" @click="submit()" type="button" name="login" value="Register">
            </div>
        </form>
    </div>
</template>

<script>
    import Validator from './../../validator/validator.js'
    export default {
        name: "register",
        data(){
            return {
                data:{
                    name:'',
                    email:'',
                    password:'',
                    c_password:'',
                    key: ''
                },
                error:{}
            }
        },
        methods:{
            submit(){
                let error = this.error;
                let data = this.data;
                error.name =       Validator.set(data.name, ['required']);
                error.email =      Validator.set(data.email, ['required', 'email']);
                error.password =   Validator.set(data.password, ['required']);
                error.c_password = data.password == data.c_password ? false : true;
                error.key =        Validator.set(data.key, ['required']);
                console.log(error)
            }
        }
    }
</script>

<style scoped src="./auth.css"></style>
