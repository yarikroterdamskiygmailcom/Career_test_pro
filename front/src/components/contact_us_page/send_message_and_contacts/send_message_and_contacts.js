import Request from '../../../api/mail_request'
import Validator from "../../../validator/validator";
export default {
    name: 'send-message-and-contacts',
    components: {},
    props: [],
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
        copy_text(){
            let textarea = document.createElement('textarea');
            textarea.value = this.$refs.copy.innerText;
            document.body.appendChild(textarea);
            textarea.select();
            try {
                document.execCommand('copy');
                console.log( 'Скопировано')
            } catch (err) {
                console.log('Не скопировано')
            }
            document.body.removeChild(textarea)
        },
        send_mail(){
            const error =  this.error;
            error.name = Validator.set(this.data.name, ['required']);
            error.email = Validator.set(this.data.email, ['required']);
            error.email =  !error.email.errors  ? Validator.set(this.data.email, ['email']) : error.email;
            error.message = Validator.set(this.data.message, ['required']);
            !error.email.errors && !error.name.errors && !error.message.errors
                ?
                Request.send_mail(this.data)
                :
                this.disabled_button = true
        }
    }
}


// console.log('start---------------------------- \n', asdf);
// asdf = asdf.replace( /\r?\n|\r/g, "");
//
// asdf = asdf.replace( /<br[^>]*>/gi, "\n");
// console.log('br------------------------------- \n', asdf);
//
// asdf = asdf.replace(/<[^>]*>/g, "");
// console.log('html----------------------------- \n', asdf);
