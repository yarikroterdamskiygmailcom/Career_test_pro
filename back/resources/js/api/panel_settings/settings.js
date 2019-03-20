let http = window;

export class Settings{
    static get_all_admin(data){
        http = window.Vue.http;
        return http.get('/api/users')
    }
    static list_language(){
        http = window.Vue.http;
        return http.get('/api/languages')
    }
    static get_price_in_language(language_id){
        http = window.Vue.http;
        return http.get(`/api/price?language_id=${language_id}`)
    }
    static seve_price_in_language(data){
        http = window.Vue.http;
        return http.post(`/api/price`, data)
    }
}
