import {Token} from "../store/localStorage";
import router from '../router/index.js'
export class Middleware{
    static closed_login_reset_regsiter(){
        if(Token.getToken()){
            router.push('/panel')
        }
    }
}
