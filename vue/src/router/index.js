import { createRouter, createWebHistory } from 'vue-router'
import GuestLayout from '../components/GuestLayout.vue'
import LandingPage from '../views/guest/LandingPage.vue'
const routes = [
  {
    path: '/',
    component : GuestLayout,
    redirect : '/',
    children: [
      { path: '/', name: 'LandingPage' , component: LandingPage },
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
