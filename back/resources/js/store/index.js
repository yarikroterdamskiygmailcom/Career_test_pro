
import Vue from 'vue'
import Vuex from 'vuex'
import multilanguage from './modules/multilanguage'
import modal_data from './modules/modal_data'

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    multilanguage,
    modal_data
  },
  // strict: process.env.NODE_ENV !== 'production'
})
