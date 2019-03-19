<template>
    <div class="login">
        <h1>Login op het admin panel</h1>
        <form>
            <div class="error" v-if="error.global && error.global.errors">
                <div v-if="error.global.message">
                    {{error.global.message}}
                </div>
            </div>
            <div class="form-input">
                <input type="text"
                       name="email"
                       v-model="data.email"
                       :class="{error: error.email && error.email.errors}"
                       placeholder="Email">
            </div>
            <div class="error" v-if="error.email && error.email.errors">
                <div v-if="error.email.message">
                    {{error.email.message.required}}
                </div>
                <div v-if="error.email.message">
                    {{error.email.message.email}}
                </div>
            </div>
            <div class="form-input">
                <input type="password"
                       name="password"
                       v-model="data.password"
                       placeholder="Password"
                       :class="{error: (error.password && error.password.errors) || error.c_password_length}">
            </div>
            <div class="error" v-if="error.password && error.password.errors">
                <div v-if="error.password.message">{{error.password.message.required}}</div>
            </div>
            <div class="form-input">
                <input class="submit" @click="submit()" type="button" name="login" value="Login">
            </div>
        </form>
    </div>
</template>

<script>
    import Validator from "../../validator/validator";
    import {Auth} from "../../api/auth";

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
        // updated(){
        //     console.log(11)
        // },
        methods:{
            submit(){
                let error = {...this.error};
                let data = this.data;
                error.email =      Validator.set(data.email, ['required']);
                error.email =      !error.email.errors  ? Validator.set(data.email, ['email']) : error.email;
                error.password =   Validator.set(data.password, ['required']);
                if(!error.email.errors && !error.password.errors) {
                    Auth.login(data)
                        .then(res => {
                            res ? this.find_err_response(res.body.data) : null
                        })
                        .catch(err => this.err_global())
                } else {
                    this.error = error;
                }
            },
            find_err_response(data){
                let error = this.error;
                Object.keys(data).forEach(item =>{
                    if(error[item]) error[item].errors = true
                })
            },
            err_global(){
                const obj = {
                    global:{
                        errors: true,
                        message: 'Incorrect login or password'
                    }
                };
                this.error = {
                    ...global = obj
                };
            }
        }
    }
</script>

<style scoped src="./auth.css"></style>
