import Request from '../../../api/mail_request'
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
            Request.send_mail(this.data)
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
