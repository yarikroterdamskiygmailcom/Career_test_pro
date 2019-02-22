const axios = require('axios');
import config from './../config'

// axios.interceptors.request.use(function(config) {
// //     // const token = store.state.token;
// //     console.log(33);
// //     if(token) {
// //         config.headers.Authorization = `Bearer ${token}`;
// //     }
// //     return config;
// // }, function(err) {
// //     console.log(33);
// //     return Promise.reject(err);
// // });
// import Vue from 'vue';
//
// const addLoadingOnRequest = (request, next) => {
//     // const loading = Loading.service(LOADING_CONFIG);
//     // next(() => {
//     //     loading.close();
//     // });
//     console.log(1829308102983)
// };
//
// const showErrorMessageOnFailedRequest = (request, next) => {
//     // next(response => {
//     //     if (response.status > 308) {
//     //         alert('API Error');
//     //     }
//     // })
//     console.log(1213123123)
// };
//
// Vue.http.interceptors.push(addLoadingOnRequest);
// Vue.http.interceptors.push(showErrorMessageOnFailedRequest);
export default axios.create({
    baseURL:  config.url,
});

