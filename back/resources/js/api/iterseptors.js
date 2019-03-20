import router from '../router/index.js'
import {Token} from "../store/localStorage";
export const request = (request, next) => {
    request.url = `${request.root}${request.url}`;
    if(Token.getToken()){
        request.headers.set('Authorization', `Bearer ${Token.getToken()}`);
    }
    return next();
};

export const response = (request, next) => {
    next(response => {
        if (response.status == 403 || response.status == 401) {
            Token.destroyToken();
            router.push('/login')
        }
    })
};
