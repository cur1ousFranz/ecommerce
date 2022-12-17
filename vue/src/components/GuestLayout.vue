<template>
  <div>
    <nav class="py-4 flex justify-between px-14 border-b">
        <router-link :to="{ name : 'LandingPage' }" class="text-white cursor-pointer">
            <img src="/img/nav-logo.png" class="w-36" alt="">
        </router-link>
        <div class="hidden space-x-3 relative md:flex">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-cart3 mt-2" viewBox="0 0 16 16">
            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <router-link :to="{ name : 'Signin'}" class="px-3 py-2">Sign In</router-link>
        </div>
        <div id="nav-icon1" class="md:hidden">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>
    <main>
        <router-view></router-view>
    </main>
    <!-- <Footer/> -->
  </div>
</template>

<script setup>
    import Footer from './Footer.vue'
    import { onMounted } from 'vue'
    onMounted(() => {
        let nav = document.querySelector('#nav-icon1')
        nav.addEventListener('click', () => nav.classList.toggle('open'))
    })

</script>

<style>
#nav-icon1 {
  width: 50px;
  height: 10px;
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
  margin-top: 5px;
  width: 100%;
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
  top: 18px;
}

#nav-icon1 span:nth-child(3) {
  top: 36px;
}

#nav-icon1.open span:nth-child(1) {
  top: 18px;
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
  top: 18px;
  -webkit-transform: rotate(-135deg);
  -moz-transform: rotate(-135deg);
  -o-transform: rotate(-135deg);
  transform: rotate(-135deg);
}

</style>
