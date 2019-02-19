export class QuestionStore {
    static getStep(index) {
        return !window.localStorage[`step:${index}`] ? null : JSON.parse(window.localStorage[`step:${index}`]);
    }

    static saveStep(data, index) {
        window.localStorage[`step:${index}`] = JSON.stringify(data);
    }

    static destroyQuestion() {
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
