
let http = window;

export class Careers{
    static get_careers(id, page = 1){
        http = window.Vue.http;
        return http.get(`/api/careers?language_id=${id}&page=${page}`)
    }
    static save_career(id, data){
        http = window.Vue.http;
        return http.put(`/api/careers/${id}`, data)
    }
    static add_list(data){
        http = window.Vue.http;
        return http.post(`/api/careers`, data)
    }
}
