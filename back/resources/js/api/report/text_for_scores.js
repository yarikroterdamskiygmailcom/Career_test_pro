let http = window;

export class Scoretext{
    static get_scoretext(index) {
        http = window.Vue.http;
        return http.get(`/api/scoretext?language_id=${index}`)
    }
    static save_scoretext(index, data) {
        http = window.Vue.http;
        return http.post(`/api/scoretext/${index}`, data)
    }
}
