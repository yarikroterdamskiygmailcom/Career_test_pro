<template>
    <div class="register">
        <h1>Register new admin</h1>
        <form>
            <div class="form-input">
                <input type="text" name="username"
                       v-model="data.name"
                       :class="{error: error.name && error.name.errors}"
                       placeholder="Username">
            </div>
            <div class="error" v-if="error.name && error.name.errors">
                <div v-if="error.name.message">
                    {{error.name.message.required}}
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
            <div class="error" v-if="error.c_password_length">
                <div>short password</div>
            </div>
            <div class="form-input">
                <input type="password"
                       name="c_password"
                       v-model="data.c_password"
                       placeholder="Repeat password"
                       :class="{error: error.c_password && error.c_password.errors}">
            </div>
            <div class="error" v-if="error.c_password && error.c_password.errors">
                <div v-if="error.c_password.message">{{error.c_password.message}}</div>
            </div>
            <div class="form-input">
                <input type="text"
                       name="key"
                       v-model="data.key"
                       placeholder="Security key"
                       :class="{error: error.key && error.key.errors}">
            </div>
            <div class="error" v-if="error.key && error.key.errors">
                <div v-if="error.key.message">{{error.key.message.required}}</div>
                <div v-if="error.key.message">{{error.key.message.wrong}}</div>
            </div>
            <div class="form-input">
                <input class="submit" @click="submit()" type="button" name="login" value="Register">
            </div>
        </form>
    </div>
</template>

<script>
    import Validator from './../../validator/validator.js'
    import {Auth} from "../../api/auth";
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
                let error = {...this.error};
                let data = this.data;
                error.name =              Validator.set(data.name, ['required']);
                error.email =             Validator.set(data.email, ['required']);
                error.email =             !error.email.errors  ? Validator.set(data.email, ['email']) : error.email;
                error.password =          Validator.set(data.password, ['required']);
                error.c_password =        {
                    errors: data.password && data.password == data.c_password? false : true,
                    message: 'Repeat the password'
                };
                error.c_password_length = data.password.length < 8  ? true : false;
                error.key =               Validator.set(data.key, ['required']);
                this.error = error;
                if(!error.name.errors && !error.email.errors && !error.key.errors &&
                !error.password.errors && !error.c_password.errors && !error.c_password_length) {
                    Auth.register(data)
                        .then(res => {
                            if(res && res.body.data === 'Wrong admin key'){
                                this.error.key.errors = true;
                                this.error.key.message = {};
                                this.error.key.message.wrong = 'invalid admin key';
                            }
                            res ? this.find_err_response(res.body.data) : null
                        })
                        .catch(err => console.log('register error', err))
                }
            },
            find_err_response(data){
                let error = this.error;
                Object.keys(data).forEach(item =>{
                    if(error[item]) {
                        error[item].errors = true;
                        error[item].message = {};
                        error[item].message[item] =  data[item][0]
                    }
                })
            }
        }
    }
</script>

<style scoped src="./auth.css"></style>
