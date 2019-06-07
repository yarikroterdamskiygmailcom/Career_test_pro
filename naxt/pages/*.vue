<script>
    const cookie = require('cookie');
    const {base64encode, base64decode} = require('nodejs-base64');

    export default {
        fetch({redirect, store, route, $warehouse, $cookies, req}) {
            let lang = 'en';
            if(route.query && route.query.rout) {
                let url    = base64decode(route.query.rout);
                let params = getParams(url);
                lang = params['lang'][0]

            }
            if(route.query && route.query.rout) {
                return redirect(base64decode(route.query.rout));
            }
            redirect(`/home?lang=${lang}`);
            function getParams (str) {
                let queryString = str || '';
                let keyValPairs = [];
                let params      = {};
                queryString     = queryString.replace(/.*?\?/,"");
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
        },

    }
</script>
