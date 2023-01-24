<template>
  <div class="px-6 mx-12 my-8 md:px-12">
    <div class=" p-6 mx-auto bg-gray-100 shadow-lg lg:w-5/12">
        <h1 class="text-2xl font-semibold">Sign In</h1>
        <form @submit.prevent="signIn">
          <div class="space-y-8 mt-8">
              <div>
                <input v-model="model.email" type="text" :class=" model.errors.email ? 'w-full py-2 border border-red-500 focus:outline-red-500 px-2' : 'w-full py-2 border px-2'" placeholder="Email Address">
                <p class="text-sm absolute text-red-500"> {{ model.errors.email }}</p>
                <p class="text-sm absolute text-red-500"> {{ model.errors.invalid_credentials }}</p>
              </div>
              <div>
                <input v-model="model.password" type="password" :class=" model.errors.password ? 'w-full py-2 border border-red-500 focus:outline-red-500 px-2' : 'w-full py-2 border px-2'" placeholder="Password">
                <p class="text-sm absolute text-red-500"> {{ model.errors.password }}</p>
                <div class="flex items-start mt-8">
                    <div class="flex items-center h-5">
                    <input v-model="model.remember" type="checkbox" class="w-4 h-4 mt-1 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    </div>
                    <label for="remember" class="ml-2 text-gray-900">
                      Remember me
                    </label>
                </div>
              </div>
              <button class="px-3 py-2 mt-4 w-full bg-gray-800 text-white hover:bg-gray-700">
                  <div v-if="loadStatus">
                    Please wait...
                  </div>
                  <div v-else>
                    Sign In
                  </div>
              </button>
              <div class="text-center">
                  <router-link :to="{ name: 'ForgotPassword' }" class="text-sm text-gray-600 underline text-center m-0">
                      Forgot your password?
                  </router-link>
              </div>
              <div class="flex space-x-2">
                  <hr class="w-full h-1 border-t border-gray-400">
                  <p class="-m-3">Or</p>
                  <hr class="w-full h-1 border-t border-gray-400">
              </div>
              <button type="button" class="px-3 py-2 w-full border bg-gray-200 hover:bg-gray-300">
                  <svg class="w-6 inline-block mx-3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 48 48"><defs>
                      <path id="a" d="M44.5 20H24v8.5h11.8C34.7 33.9 30.1 37 24 37c-7.2 0-13-5.8-13-13s5.8-13 13-13c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.6 4.1 29.6 2 24 2 11.8 2 2 11.8 2 24s9.8 22 22 22c11 0 21-8 21-22 0-1.3-.2-2.7-.5-4z"/></defs><clipPath id="b"><use xlink:href="#a" overflow="visible"/></clipPath><path clip-path="url(#b)" fill="#FBBC05" d="M0 37V11l17 13z"/><path clip-path="url(#b)" fill="#EA4335" d="M0 11l17 13 7-6.1L48 14V0H0z"/><path clip-path="url(#b)" fill="#34A853" d="M0 37l30-23 7.9 1L48 0v48H0z"/><path clip-path="url(#b)" fill="#4285F4" d="M48 48L17 24l-4-3 35-10z"/>
                  </svg>
                  Sign In With Google
              </button>
              <p class="text-sm text-gray-600 text-center">Don't have an account yet?
                <span @click="signUpPage" class="cursor-pointer text-blue-500">Sign Up</span>
              </p>
          </div>
        </form>
    </div>
  </div>
</template>

<script setup>
import store from '../../store';
import alert from '../../alert.js'
import { useRoute, useRouter } from 'vue-router'
import { ref } from '@vue/reactivity';
import { computed, onMounted } from '@vue/runtime-core';

  const route = useRoute()
  const router = useRouter()

  const loadStatus = computed(() => store.state.authLoadStatus.loadStatus)
  const model = ref({
    email : '',
    password : '',
    remember : false,
    invalid_credentials : '',
    errors : {
      email : '',
      password : '',
      invalid_credentials : '',
    },
    params : {
      url : ''
    }
  })

  onMounted(() => {
    if(route.params.url) {
      model.value.params.url = route.params.url
    }

    if(store.state.user.token){
      router.push({ name : 'LandingPage'})
    }
  })

  const signIn = async () => {
    model.value.errors.email = ''
    model.value.errors.password = ''
    model.value.errors.invalid_credentials = ''
    const formData = new FormData()
    formData.append('email', model.value.email)
    formData.append('password', model.value.password)
    formData.append('remember', model.value.remember)
    try {
      await store.dispatch('signInUser', formData)
      if(localStorage.getItem('USER_ID')){
        router.push({ name : 'Signup'})
        alert('Verification code sent!')
      }else{
        if(model.value.params.url) {
          window.location.href = `${router.options.base}${model.value.params.url}`
        } else {
          window.location.href = '/'
        }
      }
    } catch (err) {
      store.state.authLoadStatus.loadStatus = false
      if (err.response.data.errors.hasOwnProperty('email')) {
        model.value.errors.email = err.response.data.errors.email[0]
      }
      if(err.response.data.errors.hasOwnProperty('password')){
        model.value.errors.password = err.response.data.errors.password[0]
      }
      if(err.response.data.errors.hasOwnProperty('invalid_credentials')){
        model.value.errors.invalid_credentials = err.response.data.errors.invalid_credentials[0]
      }
    }
  }

  const signUpPage = () => {
    if(model.value.params.url) {
      router.push({ name : 'Signup', params : { url : model.value.params.url}})
    } else {
      router.push({ name : 'Signup'})
    }
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
