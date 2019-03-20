<template>
    <div class="reset_password">
        <h1>Reset password</h1>
        <div class="error" v-if="error.global && error.global.errors">
            <div v-if="error.global.message">
                {{error.global.message}}
            </div>
        </div>
        <form v-if="component">
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
                <input class="submit" @click="submit('send email')" type="button" name="login" value="Login">
            </div>
        </form>
        <form v-if="!component">
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
            <div class="error" v-if="error.c_password_length">
                <div>short password</div>
            </div>
            <div class="form-input">
                <input type="password"
                       name="c_password"
                       v-model="data.password_confirmation"
                       placeholder="Repeat password"
                       :class="{error: error.password_confirmation && error.password_confirmation.errors}">
            </div>
            <div class="error" v-if="error.password_confirmation && error.password_confirmation.errors">
                <div v-if="error.password_confirmation.message">{{error.password_confirmation.message}}</div>
            </div>
            <div class="form-input">
                <input class="submit" @click="submit('send password')" type="button" name="login" value="Login">
            </div>
        </form>
    </div>
</template>

<script>

    import {Auth} from "../../api/auth";
    import Validator from "../../validator/validator";

    export default {
        name: "reset_password",
        data(){
            return{
                component:true,
                data:{
                    email:'',
                    password:'',
                    password_confirmation:'',
                    token: ''
                },
                error:{},

            }
        },
        created(){
            this.component = this.$router.history.current.path == '/reset-password'
            this.data.token =  this.$router.history.current.query.token
        },
        methods: {
            submit(value) {
                if (value == 'send email') {
                    let error = {...this.error};
                    error.email = Validator.set(this.data.email, ['required']);
                    error.email = !error.email.errors ? Validator.set(this.data.email, ['email']) : error.email;
                    this.error = error;
                    if (!error.email.errors) {
                        Auth.reset_password(this.data)
                            .then(res =>{
                                this.err_global('Check your email')
                            })
                            .catch(err => {
                                this.err_global('Email no found')
                            })
                    }
                } else {
                    let error = {...this.error};
                    error.password = Validator.set(this.data.password, ['required']);
                    error.password_confirmation = {
                        errors: this.data.password && this.data.password == this.data.password_confirmation ? false : true,
                        message: 'Repeat the password'
                    };
                    error.email = Validator.set(this.data.email, ['required']);
                    error.email = !error.email.errors ? Validator.set(this.data.email, ['email']) : error.email;
                    this.error = error;
                    if (!error.password.errors && !error.password_confirmation.errors && !error.email.errors) {
                        Auth.reset_password_in_confirm(this.data)
                            .then(res =>{
                                console.log(res)
                                // this.err_global('Check your email')
                            })
                            .catch(err => {
                                console.log(err)
                                // this.err_global('Email no found')
                            })
                    }
                }
            },
            err_global(text) {
                const obj = {
                    global: {
                        errors: true,
                        message: text
                    }
                };
                this.error = {
                    ...global = obj
                };
                this.data.email = ''
            }
        }
    }
</script>

<style scoped src="./auth.css">

</style>
