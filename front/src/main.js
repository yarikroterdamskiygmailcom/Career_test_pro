import Vue from 'vue'
import App from './App.vue'
import router from './router/index.js'
import store from './store/index'
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import interseptorSetup from "./api/interseptor";

Vue.use(BootstrapVue);
// interseptorSetup();

// Vue.http.interceptors.push({
//
//   request: function (request){
//     console.log(123123);
//     request.headers['Authorization'] = auth.getAuthHeader()
//     return request
//   },
//
//   response: function (response) {
//     console.log(123123);
//     //console.log('status: ' + response.data)
//     return response;
//   }
//
// });
// Vue.use(VueResource)

// Vue.http.interceptors.push((request, next) => {
//   console.log(213);
//   // request.headers.set('Authorization', 'Bearer eyJ0e.....etc')
//   // request.headers.set('Accept', 'application/json')
//   next()
// })
new Vue({
  el: '#app',
  render: h => h(App),
  router,
  store
});
