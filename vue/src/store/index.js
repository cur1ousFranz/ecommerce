import { createStore } from 'vuex'
import axiosClient from '../axios'

const store = createStore({
  state: {
    /** AUTHENTICATION */
    user: {
      loading : false,
      role: null,
      token: null
    },

  },
  getters: {},
  actions: {

  },
  mutations: {

  },
  modules: {},

})

export default store
