import axios from './axios.config.js'

export default  {
    send_mail(data){
        return axios.post('/api/sendmail', data)
    }
}
