var cookie = require('cookie');
const {base64encode, base64decode} = require('nodejs-base64');

export function nuxtServerInit(store, req) {
    // console.log(req);
    let language_now;
    if (req && req.headers && req.headers.cookie) {
        language_now = base64decode(cookie.parse(req.headers.cookie).language_now);
        language_now = JSON.parse(language_now)
    }

    if (language_now && Object.keys(language_now).length > 2) {
        store.commit('multilanguage/change_state', {
            data: language_now,
            name: 'language_now'
        });
        store.commit('localStorage/language_now', language_now, {root: true});
    } else {
        language_now = store.getters['localStorage/language_now'];
        if (!language_now) language_now = store.getters['multilanguage/get_language_now'];
    }

    return language_now
}
