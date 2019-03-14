import Request from "../../../api/mail_request";
import Validator from "../../../validator/validator";
import Helper from "../../../helper/active_other_modal";

export default {
    name: 'have-any-questions',
    data() {
        return {
            data:{
                name:'',
                email:'',
                message:'',
            },
            error:{
                name:{},
                email:{},
                message:{},
            },
            disabled_button: false
        }
    },
    methods: {
        send_mail(){
            const error =  this.error;
            error.name = Validator.set(this.data.name, ['required']);
            error.email = Validator.set(this.data.email, ['required']);
            error.email =  !error.email.errors  ? Validator.set(this.data.email, ['email']) : error.email;
            error.message = Validator.set(this.data.message, ['required']);
            !error.email.errors && !error.name.errors && !error.message.errors
                ?
                Request.send_mail(this.data, this).then(response => {
                    Helper.open_modal(
                        this,
                        'Thank you for your message! We’ll contact you soon',
                        'send_message.svg', '32px', '12px', '103px', '148px'
                    )
                })
                :
                this.disabled_button = true

        }
    },
}
