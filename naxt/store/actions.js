var cookie = require('cookie');
const { base64encode, base64decode } = require('nodejs-base64');
export default {
    nuxtServerInit({commit,store}, {req}) {
         let language_now;
         try {
             language_now = base64decode(cookie.parse(req.headers.cookie).language_now)
         } catch (e) {}
         if(language_now && Object.keys(JSON.parse(language_now)).length > 2){
             commit('multilanguage/change_state', {
                 data: JSON.parse(language_now),
                 name: 'language_now'
             });
             commit('localStorage/language_now', JSON.parse(language_now), { root: true });
         }
    },
}
