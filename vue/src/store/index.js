import { createStore } from 'vuex'
import axiosClient from '../axios'

const store = createStore({
  state: {
    /** AUTHENTICATION */
    user: {
      loading : false,
      role: null,
      token: localStorage.getItem('TOKEN')
    },

  },
  getters: {},
  actions: {
    async googleAuthenticate({commit}) {
        const res = await axiosClient.get(`/auth/google`);
        console.log(res);
    },
    async signUpUser({commit}, formData) {
        const res = await axiosClient.post('/signup', formData);
        commit('setUserID', res.data)
    },
    async verifyEmail({commit}, formData) {
        const res = await axiosClient.post(`/signup/verify`, formData);
        commit('setUser', res.data)
    },
    async resendEmailCode({commit}, formData) {
        const res = await axiosClient.post(`/signup/verify/resend`, formData);
        return res
    },

  },
  mutations: {
    setUserID : (state, data) => {
      localStorage.setItem('USER_ID', data.user_id)
    },
    setUser : (state, data) => {
      localStorage.removeItem('USER_ID')
      localStorage.setItem('TOKEN', data.token)
    },

  },
  modules: {},

})

export default store
