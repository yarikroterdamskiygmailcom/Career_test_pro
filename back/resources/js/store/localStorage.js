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

// export class IndexLanguage {
//     static getStep(index) {
//         return window.localStorage[`step:${index}`];
//     }
//
//     static saveStep(data, index) {
//         window.localStorage[`step:${index}`] = data;
//     }
//
//     static destroyQuestion() {
//         window.localStorage.clear()
//     }
// }
