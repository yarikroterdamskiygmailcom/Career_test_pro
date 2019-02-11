import Request from "../../../api/mail_request";

export default {
    name: 'have-any-questions',
    data() {
        return {
            data:{
                name:'',
                email:'',
                message:'',
            }
        }
    },
    methods: {
        send_mail(){
            Request.send_mail(this.data)
        }
    }
}
