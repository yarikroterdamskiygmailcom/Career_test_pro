<script>
    const cookie = require('cookie');
    const {base64encode, base64decode} = require('nodejs-base64');

    export default {
        async fetch({redirect, store, route, $warehouse, $cookies, req}) {
            if (route.query && route.query.rout) {
                let url = base64decode(route.query.rout);
                let params = getParams(url);
                let lang = params['lang'][0];
                store.commit('multilanguage/change_state', {
                    data: lang,
                    name: 'lang'
                });
                return  redirect(base64decode(route.query.rout))
            }
            store.commit('multilanguage/change_state', {
                data: 'en',
                name: 'lang'
            });

            return redirect(`/home?lang=en`)
        },
    }

    function getParams(str) {
        let queryString = str || '';
        let keyValPairs = [];
        let params = {};
        queryString = queryString.replace(/.*?\?/, "");
        if (queryString.length) {
            keyValPairs = queryString.split('&');
            for (let pairNum in keyValPairs) {
                let key = keyValPairs[pairNum].split('=')[0];
                if (!key.length) continue;
                if (typeof params[key] === 'undefined')
                    params[key] = [];
                params[key].push(keyValPairs[pairNum].split('=')[1]);
            }
        }
        return params;
    }
</script>
