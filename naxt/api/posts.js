import axios from "./axios.config";

export class Pasts  {
    static get_posts(data){
        return axios.post(`api/posts-filter?language_id=${data.language}?page${data.page ? data.page : ''}`, data)
    }
}
