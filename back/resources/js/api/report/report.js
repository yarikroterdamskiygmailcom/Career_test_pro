let http = window;

export class Report{
    static get_report(index){
        http = window.Vue.http;
        return http.get(`/api/report-blocks?language_id=${index}`)
    }
    static get_report_data_for_letter(data){
        http = window.Vue.http;
        return http
            .get(`/api/letter-block?language_id=${data.language_id}&letter=${data.letter}&report_block_id=${data.id}`)
            .then(res => res.body[0])
    }
    static save_report(data, id){
        http = window.Vue.http;
        return http.post(`/api/report-blocks/${id}`, data)
    }
}
