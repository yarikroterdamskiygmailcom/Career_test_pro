let http = window;

export class Admin{
    static get_user(data){
        http = window.Vue.http;
        return http.get('/api/getuser', data)
            .then(response => {});
    }
}
