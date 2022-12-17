import { createRouter, createWebHistory } from 'vue-router'
import GuestLayout from '../components/GuestLayout.vue'
import LandingPage from '../views/guest/LandingPage.vue'
import Signin from '../views/guest/Signin.vue'
import Signup from '../views/guest/Signup.vue'
const routes = [
  {
    path: '/',
    component : GuestLayout,
    redirect : '/',
    children: [
      { path: '/', name: 'LandingPage' , component: LandingPage },
      { path: '/signin', name: 'Signin' , component: Signin },
      { path: '/signup', name: 'Signup' , component: Signup },
    ]
  },

]

const router = createRouter({
  history : createWebHistory(),
  routes
})

// router.beforeEach((to, from, next) => {

// })

export default router
