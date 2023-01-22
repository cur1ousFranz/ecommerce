import { createRouter, createWebHistory } from 'vue-router'
import GuestLayout from '../components/GuestLayout.vue'
import ProductLoadingSkeleton from '../components/ProductLoadingSkeleton.vue'
import LandingPage from '../views/guest/LandingPage.vue'
import Signin from '../views/guest/Signin.vue'
import Signup from '../views/guest/Signup.vue'
import ForgotPassword from '../views/guest/ForgotPassword.vue'
import ForgotPasswordReset from '../views/guest/ForgotPasswordReset.vue'
import Product from '../views/guest/Product.vue'
import ProductShow from '../views/guest/ProductShow.vue'
const routes = [
  {
    path: '/',
    component : GuestLayout,
    redirect : '/',
    children: [
      { path: '/', name: 'LandingPage' , component: LandingPage },
      { path: '/signin', name: 'Signin' , component: Signin },
      { path: '/signup', name: 'Signup' , component: Signup },
      { path: '/reset', name: 'ForgotPassword' , component: ForgotPassword },
      { path: '/reset/password/', name: 'ForgotPasswordReset' , component: ForgotPasswordReset },
      { path: '/:slug' , name: 'Product' , component: Product },
      { path: '/:slug/:name=:sku' , name: 'ProductShow' , component: ProductShow },

    ]
  },

]

const router = createRouter({
  mode : 'history',
  history : createWebHistory(),
  routes
})

export default router
