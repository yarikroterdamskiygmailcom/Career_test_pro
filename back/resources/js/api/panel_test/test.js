let http = window;

export class Test{
    static get_questions(index) {
        http = window.Vue.http;
        return http.get(`/api/questions?language_id=${index}`)
    }
    static save_questions(id, data) {
        http = window.Vue.http;
        return http.post(`/api/questions/${id}`, data)
    }
}
