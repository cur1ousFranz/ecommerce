<template>
  <div class="px-6 mx-12 my-8 md:px-12">
    <div class=" p-6 mx-auto bg-gray-100 shadow-lg lg:w-5/12">
        <h1 class="text-2xl font-semibold">Sign In</h1>
        <div class="space-y-6 mt-8">
            <input type="text" class="w-full py-2 border px-2" placeholder="Email Address">
            <input type="password" class="w-full py-2 border px-2" placeholder="Password">
            <button class="px-3 py-2 mt-4 w-full bg-gray-800 text-white hover:bg-gray-700">
                Sign In
            </button>
            <div class="text-center">
                <router-link :to="{ name: 'Signup' }" class="text-sm text-gray-600 underline text-center m-0">
                    Forgot your password?
                </router-link>
            </div>
            <div class="flex space-x-2">
                <hr class="w-full h-1 border-t border-gray-400">
                <p class="-m-3">Or</p>
                <hr class="w-full h-1 border-t border-gray-400">
            </div>
            <button class="px-3 py-2 w-full border bg-gray-200 hover:bg-gray-300">
                <svg class="w-6 inline-block mx-3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 48 48"><defs>
                    <path id="a" d="M44.5 20H24v8.5h11.8C34.7 33.9 30.1 37 24 37c-7.2 0-13-5.8-13-13s5.8-13 13-13c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.6 4.1 29.6 2 24 2 11.8 2 2 11.8 2 24s9.8 22 22 22c11 0 21-8 21-22 0-1.3-.2-2.7-.5-4z"/></defs><clipPath id="b"><use xlink:href="#a" overflow="visible"/></clipPath><path clip-path="url(#b)" fill="#FBBC05" d="M0 37V11l17 13z"/><path clip-path="url(#b)" fill="#EA4335" d="M0 11l17 13 7-6.1L48 14V0H0z"/><path clip-path="url(#b)" fill="#34A853" d="M0 37l30-23 7.9 1L48 0v48H0z"/><path clip-path="url(#b)" fill="#4285F4" d="M48 48L17 24l-4-3 35-10z"/>
                </svg>
                Sign In With Google
            </button>
            <p class="text-sm text-gray-600 text-center">Don't have an account yet?
                <router-link :to="{ name: 'Signup' }" class="text-blue-500">Sign Up</router-link>
            </p>
        </div>
    </div>
  </div>
</template>

<script setup>
import store from '../../store';
import { useRouter } from 'vue-router'

  const router = useRouter()
  if(localStorage.getItem('TOKEN')){
    router.push({ name : 'LandingPage'})
  }

  const googleAuth = () => {
      store.dispatch('googleAuthenticate')
      .then((res) => {
        console.log(res);
      })
      .catch(res => {
          console.log(res);
      })
  }

</script>

<style>

</style>
