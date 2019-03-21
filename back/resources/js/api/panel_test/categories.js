let http = window;

export class Category{
    static get_categories(index) {
        http = window.Vue.http;
        return http.get(`/api/categories?language_id=${index}`)
    }
    static save_categories(index, data) {
        http = window.Vue.http;
        return http.put(`/api/categories/${index}`, data)
    }
}
