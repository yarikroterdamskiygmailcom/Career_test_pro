import {Token} from "../../store/localStorage";
import router from '../../router/index.js'
export class Auth_api_helper{
    static response_auth(body){
        let token = body.data.token;
        Token.saveToken(token);
        if(token) {
            router.push('/panel');
            return true
        }
        else return false
    }
}
