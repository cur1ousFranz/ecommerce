<template>
  <div class="px-6 mx-12 my-8 md:px-12">
    <div class=" p-6 mx-auto bg-gray-100 shadow-lg lg:w-5/12">
        <h1 class="text-2xl font-semibold">Forgot Password</h1>
        <form @submit.prevent="forgotPasswordEmail">
          <div class="space-y-4 mt-8">
              <div>
                <p class="my-2">Enter your email to search for your account.</p>
                <input v-model="model.email" type="text" :class=" model.errors.email ? 'w-full py-2 border border-red-500 focus:outline-red-500 px-2' : 'w-full py-2 border px-2'" placeholder="Email Address">
                <p class="text-sm absolute text-red-500"> {{ model.errors.email }}</p>
              </div>
              <div class="flex justify-center">
                <router-link :to="{ name : 'Signin' }" class="cursor-pointer underline">Sign In instead?</router-link>
              </div>

              <button class="px-3 py-2 mt-3 w-full bg-gray-800 text-white hover:bg-gray-700">
                  <div v-if="loadStatus">
                    Please wait...
                  </div>
                  <div v-else>
                    Submit
                  </div>
              </button>
          </div>
        </form>
    </div>
  </div>
</template>

<script setup>
import { computed, ref } from "@vue/runtime-core";
import store from "../../store";
import alert from '../../alert.js'

  const loadStatus = computed(() => store.state.authLoadStatus.loadStatus)
  const model = ref({
    email : '',
    errors : {
      email : ''
    }
  })

  const forgotPasswordEmail = async () => {
    model.value.errors.email = ''
    const formData = new FormData()
    formData.append('email', model.value.email)
    try {
      const res = await store.dispatch('forgotPasswordEmail', formData)
      model.value.email = ''
      alert('Reset link has been sent to your email')
    } catch (err) {
      store.state.authLoadStatus.loadStatus = false
      if (err.response.data.errors.hasOwnProperty('email')) {
        model.value.errors.email = err.response.data.errors.email[0]
      }
    }
  }

</script>

<style>

</style>
