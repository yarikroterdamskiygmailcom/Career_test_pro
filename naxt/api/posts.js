import axios from "./axios.config";

export class Pasts  {
    static get_posts(data){
        return axios.post(`api/posts-filter?language_id=${data.language}?page${data.page ? data.page : ''}`, data)
    }
    static get_one_post(id){
        return axios.get(`api/posts/${id}`)
    }
}
