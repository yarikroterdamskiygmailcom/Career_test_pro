const name = 'token';

export class Token {
    static getToken() {
        return window.localStorage[name];
    }

    static saveToken(token) {
        window.localStorage.setItem(name, token)
    }

    static destroyToken() {
        window.localStorage.clear()
    }
}

