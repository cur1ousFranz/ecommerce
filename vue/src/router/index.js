import { createRouter, createWebHistory } from 'vue-router'
import GuestLayout from '../components/layout/GuestLayout.vue'
import CheckoutLayout from '../components/layout/CheckoutLayout.vue'
import LandingPage from '../views/guest/LandingPage.vue'
import Signin from '../views/guest/Signin.vue'
import Signup from '../views/guest/Signup.vue'
import ForgotPassword from '../views/guest/ForgotPassword.vue'
import ForgotPasswordReset from '../views/guest/ForgotPasswordReset.vue'
import Product from '../views/guest/Product.vue'
import ProductShow from '../views/guest/ProductShow.vue'
import Cart from '../views/customer/Cart.vue'
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

    ]
  },
  {
    path: '/cart',
    component : CheckoutLayout,
    redirect : '/cart',
    children: [
      { path: '/cart', name: 'Cart' , component: Cart },

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
