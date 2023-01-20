<template>
  <div>
    <div class="hidden fixed right-0 -mr-28 -rotate-90 mt-56 z-10 border lg:flex">
      <div class="px-12 py-2 cursor-pointer bg-gray-800 text-white font-bold text-2xl hover:bg-gray-900 " style="letter-spacing: 2px">
        GET ₱150 OFF!
      </div>
    </div>
    <nav class="py-4 flex justify-between px-4 border-b md:px-14">
        <div class="flex justify-center">
          <router-link :to="{ name : 'LandingPage' }" class="text-white cursor-pointer">
            <img src="/img/nav-logo.png" class="w-24" alt="">
          </router-link>
        </div>
        <div class="hidden space-x-3 relative md:flex">

          <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-cart3 hover:text-gray-600 cursor-pointer mt-2" viewBox="0 0 16 16">
          <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
          </svg>
          <!-- MENU -->
          <div v-if="authenticated" class="relative inline-block text-left">
            <div>
              <span class="rounded-md shadow-sm">
                <button @click="showDropdown" type="button" class="inline-flex justify-center w-full rounded-full border-gray-300 px-3 py-1 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                   <img src="/img/profile-default.png" class="w-7" alt="">
                </button>
              </span>
            </div>
            <div v-if="show" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg">
              <div class="rounded-md bg-white shadow-xs text-center">
                <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                  <a href="#" class="block px-4 py-2 cursor-pointer text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900" role="menuitem">Profile</a>
                  <a @click="signOut" class="block px-4 py-2 cursor-pointer text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900" role="menuitem">Logout</a>
                </div>
              </div>
            </div>
          </div>
          <router-link v-else :to="{ name : 'Signin'}" class="px-3 py-2 hover:text-gray-600">Sign In</router-link>
        </div>

        <div id="nav-icon1" class="md:hidden">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>
    <main class="max-w-screen-xl mx-auto">
      <router-view></router-view>
    </main>
    <!-- <Footer/> -->
  </div>
</template>

<script setup>
import Footer from './Footer.vue'
import { onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'
import store from '../store'

  const router = useRouter()
  const show = ref(false)
  const authenticated = ref(false)
  const showDropdown = () => {
    show.value = !show.value
  }

  onMounted(async () => {
    let nav = document.querySelector('#nav-icon1')
    nav.addEventListener('click', () => nav.classList.toggle('open'))
  })

  if(localStorage.getItem('TOKEN')) {
    authenticated.value = true
  }

  const signOut = async () => {
    await store.dispatch('signOutUser')
    window.location = '/'
  }

</script>

<style>
#nav-icon1 {
  width: 50px;
  height: 5px;
  margin-top: 5px;
  position: relative;
  -webkit-transform: rotate(0deg);
  -moz-transform: rotate(0deg);
  -o-transform: rotate(0deg);
  transform: rotate(0deg);
  -webkit-transition: .5s ease-in-out;
  -moz-transition: .5s ease-in-out;
  -o-transition: .5s ease-in-out;
  transition: .5s ease-in-out;
  cursor: pointer;
}

#nav-icon1 span {
  display: block;
  position: absolute;
  height: 5px;
  width: 75%;
  background: #231f20;
  border-radius: 9px;
  opacity: 1;
  left: 0;
  -webkit-transform: rotate(0deg);
  -moz-transform: rotate(0deg);
  -o-transform: rotate(0deg);
  transform: rotate(0deg);
  -webkit-transition: .25s ease-in-out;
  -moz-transition: .25s ease-in-out;
  -o-transition: .25s ease-in-out;
  transition: .25s ease-in-out;
}

#nav-icon1 span:nth-child(1) {
  top: 0px;
}

#nav-icon1 span:nth-child(2) {
  top: 9px;
}

#nav-icon1 span:nth-child(3) {
  top: 18px;
}

#nav-icon1.open span:nth-child(1) {
  top: 9px;
  -webkit-transform: rotate(135deg);
  -moz-transform: rotate(135deg);
  -o-transform: rotate(135deg);
  transform: rotate(135deg);
}

#nav-icon1.open span:nth-child(2) {
  opacity: 0;
  left: -60px;
}

#nav-icon1.open span:nth-child(3) {
  top: 9px;
  -webkit-transform: rotate(-135deg);
  -moz-transform: rotate(-135deg);
  -o-transform: rotate(-135deg);
  transform: rotate(-135deg);
}

</style>
