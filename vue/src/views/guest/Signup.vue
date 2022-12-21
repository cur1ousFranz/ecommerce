<template>
  <div class="px-6 mx-12 my-8 md:px-12">
    <div v-if="showSignUpForm" class=" p-6 mx-auto bg-gray-100 shadow-lg lg:w-5/12">
        <h1 class="text-2xl font-semibold">Sign Up</h1>
        <form @submit.prevent="signUp">
            <div class="space-y-7 mt-8">
                <div>
                  <input v-model="model.email" type="text"
                  :class=" model.errors.email ? 'w-full py-2 border border-red-500 focus:outline-red-500 px-2' : 'w-full py-2 border px-2'" placeholder="Email Address">
                  <p class="text-sm absolute text-red-500"> {{ model.errors.email }}</p>
                </div>
                <div>
                  <input v-model="model.password" type="password" :class=" model.errors.password ? 'w-full py-2 border border-red-500 focus:outline-red-500 px-2' : 'w-full py-2 border px-2'" placeholder="Password">
                  <p class="text-sm absolute text-red-500"> {{ model.errors.password }}</p>
                </div>
                <input v-model="model.password_confirmation" type="password" class="w-full py-2 border px-2" placeholder="Confirm Pasword">
                <button class="px-3 py-2 mt-4 w-full bg-gray-800 text-white hover:bg-gray-700">
                  <div v-if="loadStatus">
                    Please wait...
                  </div>
                  <div v-else>
                    Signup
                  </div>
                </button>
                <p class="text-sm text-gray-600 text-center">Already have an account?
                    <router-link :to="{ name: 'Signin' }" class="text-blue-500">Sign In</router-link>
                </p>
                <div class="flex space-x-2">
                    <hr class="w-full h-1 border-t border-gray-400">
                    <p class="-m-3">Or</p>
                    <hr class="w-full h-1 border-t border-gray-400">
                </div>
                <button class="px-3 py-2 w-full border bg-gray-200 hover:bg-gray-300">
                    <svg class="w-6 inline-block mx-3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 48 48"><defs>
                        <path id="a" d="M44.5 20H24v8.5h11.8C34.7 33.9 30.1 37 24 37c-7.2 0-13-5.8-13-13s5.8-13 13-13c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.6 4.1 29.6 2 24 2 11.8 2 2 11.8 2 24s9.8 22 22 22c11 0 21-8 21-22 0-1.3-.2-2.7-.5-4z"/></defs><clipPath id="b"><use xlink:href="#a" overflow="visible"/></clipPath><path clip-path="url(#b)" fill="#FBBC05" d="M0 37V11l17 13z"/><path clip-path="url(#b)" fill="#EA4335" d="M0 11l17 13 7-6.1L48 14V0H0z"/><path clip-path="url(#b)" fill="#34A853" d="M0 37l30-23 7.9 1L48 0v48H0z"/><path clip-path="url(#b)" fill="#4285F4" d="M48 48L17 24l-4-3 35-10z"/>
                    </svg>
                    Sign Up With Google
                </button>
            </div>
        </form>
    </div>
    <!-- EMAIL VERIFICATION FORM -->
    <div v-if="!showSignUpForm" class=" p-6 mx-auto bg-gray-100 shadow-lg lg:w-5/12">
        <h1 class="text-2xl font-semibold">Email Verification</h1>
        <form @submit.prevent="verifyEmail">
            <div class="space-y-2 mt-8">
                <div>
                  <input v-model="model.verify_code" type="text" :class=" model.errors.verify_code ? 'w-full py-2 border border-red-500 focus:outline-red-500 px-2' : 'w-full py-2 border px-2'" placeholder="Enter Verfication Code">
                    <p class="text-sm absolute px-1 mt-2 text-red-500">{{ model.errors.verify_code }}</p>
                  <div class="flex justify-end space-x-2 ">
                    <p class="text-sm my-2 text-end">
                      Didn't recieve a code?
                    </p>
                    <button id="resendBtn" @click="resendCode" :class="[!model.resendTimerShow ? 'text-blue-500 text-sm underline cursor-pointer' : 'text-gray-500 text-sm cursor-not-allowed']">
                      {{ !model.resendTimerShow ? 'Resend' : 'Resend in: ' + model.resendTimer}}
                    </button>
                  </div>
                </div>
                <button class="px-3 py-2 w-full bg-gray-800 text-white hover:bg-gray-700">
                  <div v-if="loadStatus">
                    Please wait...
                  </div>
                  <div v-else>
                    Confirm
                  </div>
                </button>
            </div>
        </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from "@vue/reactivity"
import store from '../../store';
import alert from '../../alert.js'
import { useRouter } from 'vue-router'
import { computed, onMounted } from "@vue/runtime-core";

  const router = useRouter()
  const showSignUpForm = ref(true)
  const loadStatus = computed(() => store.state.authLoadStatus.loadStatus)
  const model = ref({
      email : '',
      password : '',
      password_confirmation : '',
      verify_code : '',
      resendTimer : 59,
      resendTimerShow : false,
      intervalValid : '',
      errors : {
        email : '',
        password : '',
        verify_code : ''
      }
  })

  if(localStorage.getItem('USER_ID')){
    showSignUpForm.value = false
  }

  if(localStorage.getItem('TOKEN')){
    router.push({ name : 'LandingPage'})
  }

  const signUp = async () => {
    model.value.errors.email = ''
    model.value.errors.password = ''
    const formData = new FormData()
    formData.append('email', model.value.email)
    formData.append('password', model.value.password)
    formData.append('password_confirmation', model.value.password_confirmation)
    try {
      await store.dispatch('signUpUser', formData)
      showSignUpForm.value = false
      alert('Verification code sent!')
    } catch (err) {
      store.state.authLoadStatus.loadStatus = false
      if (err.response.data.errors.hasOwnProperty('email')) {
        model.value.errors.email = err.response.data.errors.email[0]
      }
      if (err.response.data.errors.hasOwnProperty('password')) {
        model.value.errors.password = err.response.data.errors.password[0]
      }
    }
  }

  const verifyEmail = async () => {
    model.value.errors.verify_code = ''
    const formData = new FormData()
    formData.append('verify_code', model.value.verify_code)
    formData.append('user_id', localStorage.getItem('USER_ID'))

    try {
      const res = await store.dispatch('verifyEmail', formData)
      // TODO redirect user
      alert('Verification successful!')
      setTimeout(() => {
        router.push({ name : 'Signin'})
      }, 1000)

    } catch (err) {
      store.state.authLoadStatus.loadStatus = false
      model.value.errors.verify_code = err.response.data.errors.verify_code[0]
    }

  }

  const resendCode = () => {
    document.querySelector('#resendBtn').disabled = true;
    const formData = new FormData()
    formData.append('user_id', localStorage.getItem('USER_ID'))

    store.dispatch('resendEmailCode', formData)
      .then(() => {
        alert('Verification code sent!')
        model.value.resendTimerShow = true
        model.value.intervalValid = setInterval(() => {
          model.value.resendTimer--;
          if(model.value.resendTimer == 0){
            document.querySelector('#resendBtn').disabled = false;
            model.value.resendTimer = 59
            model.value.resendTimerShow = false
            clearInterval(model.value.intervalValid)
          }
        }, 1000);
      })
  }

</script>

<style>

</style>
