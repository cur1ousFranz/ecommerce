<template>
  <div>
    <section>
      <div class="w-10/12 mx-auto py-6 flex space-x-4">
        <div class="w-3/12 shadow-md p-3 h-fit">
          <h1 class="font-semibold text-lg text-center text-gray-800">My Profile</h1>
          <div class="p-4 space-y-2">
            <h1 @click="toggleTab('info')" :class="model.toggle.information ? 'cursor-pointer font-semibold text-gray-700 hover:underline hover:text-gray-900' : 'cursor-pointer text-gray-700 hover:underline hover:text-gray-900'">
              Information
            </h1>
            <hr>
            <h1 @click="toggleTab('pass')" :class="model.toggle.change_password ? 'cursor-pointer font-semibold text-gray-700 hover:underline hover:text-gray-900' : 'cursor-pointer text-gray-700 hover:underline hover:text-gray-900'">
              Change Password
            </h1>
          </div>
        </div>
        <div class="w-9/12">
          <div v-if="model.toggle.information" class=" space-y-3">
            <div class="shadow-md px-6 py-4">
              <h1 class="font-semibold text-2xl text-gray-800">Personal Details</h1>
              <div class="flex space-x-6 py-4">
                <div class="w-1/2 pb-1">
                  <label class="text-sm">First Name</label>
                  <input v-model="model.details.first_name" type="text" :class=" model.errors.first_name ? 'w-full py-1 border border-red-500 focus:outline-red-500 px-2' : 'w-full py-1 border px-2'">
                  <p class="text-sm absolute text-red-500"> {{ model.errors.first_name }}</p>
                </div>
                <div class="w-1/2 pb-1">
                  <label class="text-sm">Last Name</label>
                  <input v-model="model.details.last_name" type="text" :class=" model.errors.last_name ? 'w-full py-1 border border-red-500 focus:outline-red-500 px-2' : 'w-full py-1 border px-2'"/>
                  <p class="text-sm absolute text-red-500"> {{ model.errors.last_name }}</p>
                </div>
              </div>
              <div class="flex space-x-6">
                <div class="w-1/2 pb-1">
                  <label for="gender" class="text-sm">Gender</label>
                  <select v-model="model.details.gender" name="" id="gender" :class=" model.errors.gender ? 'w-full py-1 border border-red-500 focus:outline-red-500 px-2' : 'w-full py-1 border px-2'">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                  </select>
                  <p class="text-sm absolute text-red-500"> {{ model.errors.gender }}</p>
                </div>
                <div class="w-1/2 pb-1">
                  <label class="text-sm">Birth Date</label>
                  <input v-model="model.details.birth_date" type="date" :class=" model.errors.birth_date ? 'w-full py-1 border border-red-500 focus:outline-red-500 px-2' : 'w-full py-1 border px-2'"/>
                  <p class="text-sm absolute text-red-500"> {{ model.errors.birth_date }}</p>
                </div>
              </div>
              <div class="flex justify-end py-2">
                <button @click="savePersonal" class="px-4 py-1 bg-gray-700 hover:bg-gray-900 text-white">Save</button>
              </div>
            </div>

            <div class="shadow-md px-6 py-4">
              <h1 class="font-semibold text-2xl text-gray-800">Contact Information</h1>
              <div class="w-1/2 pt-4">
                <label class="text-sm">Phone Number</label>
                <input type="text" class="w-full py-1 border px-2"/>
              </div>
              <h1 class="cursor-pointer text-sm underline text-gray-800">Change</h1>
            </div>

            <div class="shadow-md px-6 py-4">
              <h1 class="font-semibold text-2xl text-gray-800">Address Information</h1>
              <div class="flex space-x-6 py-4">
                <div class="w-1/2">
                  <label class="text-sm">Country</label>
                  <input type="text" class="w-full py-1 border px-2"/>
                </div>
                <div class="w-1/2">
                  <label class="text-sm">Province</label>
                  <input type="text" class="w-full py-1 border px-2"/>
                </div>
              </div>
              <div class="flex space-x-6">
                <div class="w-1/2">
                  <label class="text-sm">City</label>
                  <input type="text" class="w-full py-1 border px-2"/>
                </div>
                <div class="w-1/2">
                  <label class="text-sm">Street</label>
                  <input type="text" class="w-full py-1 border px-2"/>
                </div>
              </div>
              <div class="flex space-x-6 pt-4">
                <div class="w-1/2">
                  <label class="text-sm">NOTE</label>
                  <input type="text" class="w-full py-1 border px-2" placeholder="Phase/Unit/Floor, Landmark"/>
                </div>
                <div class="w-1/2">
                  <label class="text-sm">Zipcode</label>
                  <input type="text" class="w-full py-1 border px-2"/>
                </div>
              </div>
              <div class="flex justify-end py-2">
                <button class="px-4 py-1 bg-gray-700 hover:bg-gray-900 text-white">Save</button>
              </div>
            </div>
          </div>

          <div v-if="model.toggle.change_password" class="shadow-md px-6 py-4">
            <h1 class="font-semibold text-2xl text-gray-800">Change Password</h1>
            <h1 class="text-xs text-gray-800">
              For your account's security, do not share your password with anyone else
            </h1>
            <div class="w-1/2 pt-4">
              <label class="text-sm">Current Password</label>
              <input @keyup="enableChangePassButton" v-model="model.details.current_password" type="password" :class=" model.errors.current_password ? 'w-full py-1 border border-red-500 focus:outline-red-500 px-2' : 'w-full py-1 border px-2'"/>
              <p class="text-sm absolute text-red-500"> {{ model.errors.current_password }}</p>
            </div>
            <div class="w-1/2 pt-4">
              <label class="text-sm">New Password</label>
              <input @keyup="enableChangePassButton" v-model="model.details.password" type="password" :class=" model.errors.password ? 'w-full py-1 border border-red-500 focus:outline-red-500 px-2' : 'w-full py-1 border px-2'"/>
              <p class="text-sm absolute text-red-500"> {{ model.errors.password }}</p>
            </div>
            <div class="w-1/2 pt-4">
              <label class="text-sm">Confirm New Password</label>
              <input @keyup="enableChangePassButton" v-model="model.details.password_confirmation" type="password" class="w-full py-1 border px-2"/>
            </div>
            <div class="w-1/2 flex justify-end py-2">
              <button id="btn-change-pass" @click="changePassword" :class="model.button.disableChangePassword ? 'px-4 py-1 cursor-not-allowed bg-gray-300 text-white' :  'px-4 py-1 bg-gray-700 hover:bg-gray-900 text-white'" :disabled="model.button.disableChangePassword">Confirm</button>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { computed, onMounted, ref } from "@vue/runtime-core";
import { useRouter } from "vue-router";
import store from "../../store";
import alert from "../../alert";

  const router = useRouter()
  const model = ref({
    details : {
      first_name : '',
      last_name : '',
      gender : '',
      birth_date : '',
      current_password : '',
      password : '',
      password_confirmation : '',

    },
    toggle : {
      information : true,
      change_password : false,
    },
    button : {
      disableChangePassword : true
    },
    errors : {
      first_name : '',
      last_name : '',
      gender : '',
      birth_date : '',
      current_password : '',
      password : '',

    }
  })

  const customerProfileLoading = computed(() => store.state.customer.loading)

  onMounted(async() => {
    if(!store.state.user.token){
      router.push({ name : 'Signin'})
    } else {
      await store.dispatch('getCustomerProfile')
      const profile = store.state.customer.data
      model.value.details.first_name = profile.first_name
      model.value.details.last_name = profile.last_name
      model.value.details.gender = profile.gender
      model.value.details.birth_date = profile.birth_date
    }

  })

  const savePersonal = async () => {
    model.value.errors.first_name = ''
    model.value.errors.last_name = ''
    model.value.errors.gender = ''
    model.value.errors.birth_date = ''

    try {
      const formData = new FormData()
      formData.append('first_name', model.value.details.first_name)
      formData.append('last_name', model.value.details.last_name)
      formData.append('gender', model.value.details.gender)
      formData.append('birth_date', model.value.details.birth_date)
      await store.dispatch('setPersonalDetails', formData)
      alert('Personal details updated!')
    } catch (err) {
      if (err.response.data.errors.hasOwnProperty('first_name')) {
        model.value.errors.first_name = err.response.data.errors.first_name[0]
      }

      if (err.response.data.errors.hasOwnProperty('last_name')) {
        model.value.errors.last_name = err.response.data.errors.last_name[0]
      }

      if (err.response.data.errors.hasOwnProperty('gender')) {
        model.value.errors.gender = err.response.data.errors.gender[0]
      }

      if (err.response.data.errors.hasOwnProperty('birth_date')) {
        model.value.errors.birth_date = err.response.data.errors.birth_date[0]
      }

    }
  }

  const toggleTab = (option) => {
    if(option === 'info') {
      model.value.toggle.information = true
      model.value.toggle.change_password = false
    }

    if(option === 'pass') {
      model.value.toggle.change_password = true
      model.value.toggle.information = false
    }
  }

  const changePassword = async () => {
    model.value.errors.current_password = ''
    model.value.errors.password = ''
    try {
      const formData = new FormData()
      formData.append('current_password', model.value.details.current_password)
      formData.append('password', model.value.details.password)
      formData.append('password_confirmation', model.value.details.password_confirmation)
      await store.dispatch('changePassword', formData)
      alert('Password updated!')
      model.value.button.disableChangePassword = true
      model.value.details.current_password = ''
      model.value.details.password = ''
      model.value.details.password_confirmation = ''
    } catch (err) {
      if (err.response.data.errors.hasOwnProperty('current_password')) {
        model.value.errors.current_password = err.response.data.errors.current_password[0]
      }

      if (err.response.data.errors.hasOwnProperty('password')) {
        model.value.errors.password = err.response.data.errors.password[0]
      }
    }
  }

  const enableChangePassButton = () => {
    const current_password = model.value.details.current_password
    const password = model.value.details.password
    const password_confirmation = model.value.details.password_confirmation
    if(current_password && password && password_confirmation && (password === password_confirmation)) {
      model.value.button.disableChangePassword = false
    } else {
      model.value.button.disableChangePassword = true
    }

  }

</script>

<style>

</style>
