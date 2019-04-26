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
    static add_language(data){
        http = window.Vue.http;
        return http.post('/api/add-language', data)
    }
    static add_Document(data, id){
        debugger;
        http = window.Vue.http;
        return http.post(`/api/import-csv/${id}`, data)
    }
    static export(id){
        http = window.Vue.http;
        return http.get(`/api/export-csv/${id}`)
    }
    static get_price_in_language(language_id){
        http = window.Vue.http;
        return http.get(`/api/price?language_id=${language_id}`)
    }
    static seve_price_in_language(data){
        http = window.Vue.http;
        return http.post(`/api/price`, data)
    }
    static get_test_codes(){
        http = window.Vue.http;
        return http.get(`/api/testcode`)
    }
    static crate_test_code(){
        http = window.Vue.http;
        return http.post(`/api/testcode-generate`, {})
    }
    static get_site(language_id){
        http = window.Vue.http;
        return http.get(`/api/site-blocks?language_id=${language_id}`)
    }
    static update_site(data, id){
        http = window.Vue.http;
        return http.post(`/api/site-blocks/${id}`, {
            value:data.value,
            language_id:data.language_id
        })
    }
}
