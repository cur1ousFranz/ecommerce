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
    category : {
      women : [],
      men : [],
      kids : [],
      products : [],
      attributes : [],
      loading : false,
      attributesLoading : true
    },
    products : {
      product : [],
      loading : false,
      allProducts : [],
      allProductsLoading : false,
    },
    cart : {
      data : [],
      loading : false
    }

  },
  getters: {},
  actions: {
    // PRODUCTS
    async updateProductCheckout({commit}, formData) {
      commit('setCustomerCartLoading', true)
      const res = await axiosClient.post(`/customer/cart/product/${formData.get('product_id')}/checkout`, formData)
      commit('setCustomerCartLoading', false)
      commit('setCustomerCart', res.data)
      return res
    },
    async deleteCartProduct({commit}, formData) {
      commit('setCustomerCartLoading', true)
      const res = await axiosClient.post(`/customer/cart/product/${formData.get('product_id')}`, formData)
      commit('setCustomerCartLoading', false)
      commit('setCustomerCart', res.data)
      return res
    },
    async addCartProductQuantity({commit}, formData) {
      commit('setCustomerCartLoading', true)
      const res = await axiosClient.post(`/customer/cart/product/${formData.get('product_id')}`, formData)
      commit('setCustomerCartLoading', false)
      commit('setCustomerCart', res.data)
      return res
    },
    async addToCartProduct({commit}, formData) {
      commit('setCustomerCartLoading', true)
      const res = await axiosClient.post(`/customer/cart`, formData)
      commit('setCustomerCartLoading', false)
      commit('setCustomerCart', res.data)
      return res
    },
    async getCustomerCart({commit}) {
      commit('setCustomerCartLoading', true)
      const res = await axiosClient.get(`/customer/cart`)
      commit('setCustomerCartLoading', false)
      commit('setCustomerCart', res.data)
      return res
    },
    async getProduct({commit}, formData) {
      commit('setProductLoading', true)
      const res = await axiosClient.post(`/customer/product`, formData)
      commit('setProductLoading', false)
      commit('setProduct', res.data)
      return res
    },
    async getAllProducts({commit}) {
      commit('setAllProductsLoading', true)
      const res = await axiosClient.get(`/customer/product/all`)
      commit('setAllProductsLoading', false)
      commit('setAllProducts', res.data)
      return res
    },
    async searchProduct({commit}, formData) {
      commit('setCategoryProductsLoading', true)
      const res = await axiosClient.post(`/customer/category/product/search`, formData);
      commit('setCategoryProductsLoading', false)
      commit('setCategoryProducts', res.data)
      return res
    },
    async getFilteredProduts({commit}, formData) {
      commit('setCategoryProductsLoading', true)
      const res = await axiosClient.post(`/customer/category/product`, formData);
      commit('setCategoryProductsLoading', false)
      commit('setCategoryProducts', res.data)
      return res
    },
    async getCategoryAttributes({commit}, slug) {
      const res = await axiosClient.get(`/customer/category/${slug}/attribute`);
      commit('setAttributesLoading', false)
      commit('setCategoryAttributes', res.data)
      return res
    },
    async getCategoryProducts({commit}, slug) {
      commit('setCategoryProductsLoading', true)
      const res = await axiosClient.get(`/customer/category/${slug}/product`);
      commit('setCategoryProductsLoading', false)
      commit('setCategoryProducts', res.data)
      return res
    },
    async getWomenCategory({commit}) {
      const res = await axiosClient.get(`/customer/category/women`);
      commit('setWomenCategory', res.data)
      return res
    },
    async getMenCategory({commit}) {
      const res = await axiosClient.get(`/customer/category/men`);
      commit('setMenCategory', res.data)
      return res
    },
    async getKidsCategory({commit}) {
      const res = await axiosClient.get(`/customer/category/kids`);
      commit('setKidsCategory', res.data)
      return res
    },
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
    // CUSTOMER
    setCustomerCartLoading : (state, loading) => {
      state.cart.loading = loading
    },
    setCustomerCart : (state, cart) => {
      state.cart.data = cart.data
    },
    setProductLoading : (state, loading) => {
      state.products.loading = loading
    },
    setProduct : (state, product) => {
      state.products.product = product.data
    },
    setAllProductsLoading : (state, loading) => {
      state.products.allProductsLoading = loading
    },
    setAllProducts : (state, products) => {
      state.products.allProducts = products.data
    },
    setAttributesLoading : (state, loading) => {
      state.category.attributesLoading = loading
    },
    setCategoryAttributes : (state, attribute) => {
      state.category.attributes = attribute.data
    },
    setCategoryProductsLoading : (state, loading) => {
      state.category.loading = loading
    },
    setCategoryProducts : (state, category) => {
      state.category.products = category.data
    },
    setWomenCategory : (state, category) => {
      state.category.women = category.data
    },
    setMenCategory : (state, category) => {
      state.category.men = category.data
    },
    setKidsCategory : (state, category) => {
      state.category.kids = category.data
    },
    // AUTH
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
