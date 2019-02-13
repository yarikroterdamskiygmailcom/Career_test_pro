
import Vue from 'vue'
import Vuex from 'vuex'
import multilanguage from './modules/multilanguage'

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    multilanguage,
  },
  // strict: process.env.NODE_ENV !== 'production'
})
