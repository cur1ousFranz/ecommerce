import { createRouter, createWebHistory } from 'vue-router'
import GuestLayout from '../components/GuestLayout.vue'
import ProductShowLoadingSkeleton from '../components/ProductShowLoadingSkeleton.vue'
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
      { path: '/signin/:url?', name: 'Signin' , component: Signin },
      { path: '/signup/:url?', name: 'Signup' , component: Signup },
      { path: '/reset', name: 'ForgotPassword' , component: ForgotPassword },
      { path: '/reset/password/', name: 'ForgotPasswordReset' , component: ForgotPasswordReset },
      { path: '/:slug' , name: 'Product' , component: Product },
      { path: '/:slug/:name=:sku' , name: 'ProductShow' , component: ProductShow },
      { path: '/skeleton' , name: 'ProductShowLoadingSkeleton' , component: ProductShowLoadingSkeleton },

    ]
  },

]

const router = createRouter({
  base : '/',
  mode : 'history',
  history : createWebHistory(),
  routes
})

export default router
