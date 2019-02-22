import axios from 'axios';
// import store from 'your/store/path/store'

export default function setup() {
    axios.interceptors.request.use(function(config) {
        // const token = store.state.token;
        console.log(33);
        if(token) {
            config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
    }, function(err) {
        return Promise.reject(err);
    });
}
