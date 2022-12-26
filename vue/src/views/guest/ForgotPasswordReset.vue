<template>
  <div class="px-6 mx-12 my-8 md:px-12">
    <div class=" p-6 mx-auto bg-gray-100 shadow-lg lg:w-5/12">
        <h1 class="text-2xl font-semibold">Create New Password</h1>
        <form @submit.prevent="forgotPasswordReset">
          <div class="space-y-8 mt-8">
              <div>
                <p class="text-sm absolute text-red-500"> {{ model.errors.token }}</p>
                <input v-model="model.password" type="password" :class=" model.errors.password ? 'mt-6 w-full py-2 border border-red-500 focus:outline-red-500 px-2' : 'mt-6 w-full py-2 border px-2'" placeholder="Password">
                <p class="text-sm absolute text-red-500"> {{ model.errors.password }}</p>
              </div>
              <input v-model="model.password_confirmation" type="password" class="w-full py-2 border px-2" placeholder="Confirm Pasword">

              <button class="px-3 py-2 mt-4 w-full bg-gray-800 text-white hover:bg-gray-700">
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
import { useRoute, useRouter } from 'vue-router'

  const route = useRoute();
  const router = useRouter()
  const loadStatus = computed(() => store.state.authLoadStatus.loadStatus)

  const model = ref({
    password : '',
    password_confirmation : '',
    token : '',
    errors : {
      password : '',
      token : '',
    }
  })
  if(route.query.token){
    model.value.token = route.query.token
  }else{
    router.push({ name : 'Signin'})
  }

  const forgotPasswordReset = async () => {
    model.value.errors.password = ''
    model.value.errors.token = ''
    const formData = new FormData()
    formData.append('password', model.value.password)
    formData.append('password_confirmation', model.value.password_confirmation)
    formData.append('token', model.value.token)
    try {
      await store.dispatch('forgotPasswordReset', formData)
      router.push({ name : 'Signin'})
      alert('Password Updated!')
    } catch (err) {
      store.state.authLoadStatus.loadStatus = false
      if (err.response.data.errors.hasOwnProperty('password')) {
        model.value.errors.password = err.response.data.errors.password[0]
      }
      if (err.response.data.errors.hasOwnProperty('token')) {
        model.value.errors.token = err.response.data.errors.token[0]
      }
    }
  }

</script>

<style>

</style>
