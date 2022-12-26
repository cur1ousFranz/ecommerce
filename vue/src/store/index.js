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
    authLoadStatus : {
      loadStatus : false
    },

  },
  getters: {},
  actions: {
    // AUTH
    async googleAuthenticate({commit}) {
        const res = await axiosClient.get(`/auth/google`);
        console.log(res);
    },
    async signUpUser({commit}, formData) {
        commit('setAuthLoadStatus', true)
        const res = await axiosClient.post('/signup', formData);
        commit('setUserID', res.data)
        commit('setAuthLoadStatus', false)
    },
    async verifyEmail({commit}, formData) {
        commit('setAuthLoadStatus', true)
        const res = await axiosClient.post(`/signup/verify`, formData);
        localStorage.removeItem('USER_ID')
        commit('setAuthLoadStatus', false)
        return res
    },
    async resendEmailCode({commit}, formData) {
        const res = await axiosClient.post(`/signup/verify/resend`, formData);
        return res.data
    },
    async signInUser({commit}, formData) {
        commit('setAuthLoadStatus', true)
        const res = await axiosClient.post(`/signin`, formData);
        if(res.data.user && res.data.token){
          commit('setAuthLoadStatus', false)
          commit('setUser', res.data)
        }else{
          commit('setAuthLoadStatus', false)
          commit('setUserID', res.data)
        }
    },
    async signOutUser({commit}) {
        await axiosClient.get(`/signout`);
        commit('unsetUser')
    },
    async forgotPasswordEmail({commit}, formData) {
      commit('setAuthLoadStatus', true)
      const res = await axiosClient.post(`/reset`, formData);
      commit('setAuthLoadStatus', false)
      return res
    },
    async forgotPasswordReset({commit}, formData) {
      commit('setAuthLoadStatus', true)
      const res = await axiosClient.post(`/reset/password`, formData);
      commit('setAuthLoadStatus', false)
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
    setAuthLoadStatus : (state, loading) => {
      state.authLoadStatus.loadStatus = loading
    },
    unsetUser : (state) => {
      localStorage.removeItem('TOKEN')
      state.user.token = null
    },

  },
  modules: {},

})

export default store
