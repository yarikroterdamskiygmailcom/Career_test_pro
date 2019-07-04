
import {Auth_api_helper} from "./helper/auth_helper_api";

let http = window;

export class Auth{
    static register(data){
        http = window.Vue.http;
        return http.post('/api/register', data)
           .then(response => {
               let result = Auth_api_helper.response_auth(response.body);
               if (!result) return response;
           });
    }
    static login(data){
        http = window.Vue.http;
        return http.post('/api/login', data)
            .then(response => {
                let result = Auth_api_helper.response_auth(response.body);
                if (!result) return response;
            });
    }
    static reset_password(data){
        http = window.Vue.http;
        return http.post('/api/password/create', data);
    }
    static reset_password_in_confirm(data){
        http = window.Vue.http;
        return http.post('/api/password/reset', data);
    }
    static logout(data){
        http = window.Vue.http;
        return http.post('/api/logout', data);
    }
}
