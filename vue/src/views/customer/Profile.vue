<template>
  <div>
    <section>
      <div class="md:w-10/12 mx-auto py-6 flex justify-center space-x-4">
        <div class="hidden w-3/12 shadow-md p-3 h-fit md:block">
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
        <div class="w-12/12 md:w-9/12">
          <div v-if="model.toggle.information" class=" space-y-3">
            <div class="shadow-md px-6 py-4">
              <h1 class="font-semibold text-2xl text-gray-800">Personal Details</h1>
              <div class="flex flex-col py-4 md:flex-row md:space-x-6">
                <div class="w-full pb-1">
                  <label class="text-sm">First Name</label>
                  <input v-model="model.details.first_name" type="text" :class=" model.errors.first_name ? 'w-full py-1 border border-red-500 focus:outline-red-500 px-2' : 'w-full py-1 border px-2'">
                  <p class="text-sm absolute text-red-500"> {{ model.errors.first_name }}</p>
                </div>
                <div class="w-full pb-1">
                  <label class="text-sm">Last Name</label>
                  <input v-model="model.details.last_name" type="text" :class=" model.errors.last_name ? 'w-full py-1 border border-red-500 focus:outline-red-500 px-2' : 'w-full py-1 border px-2'"/>
                  <p class="text-sm absolute text-red-500"> {{ model.errors.last_name }}</p>
                </div>
              </div>
              <div class="flex flex-col md:flex-row md:space-x-6">
                <div class="w-full pb-1">
                  <label for="gender" class="text-sm">Gender</label>
                  <select v-model="model.details.gender" name="" id="gender" :class=" model.errors.gender ? 'w-full py-1 border border-red-500 focus:outline-red-500 px-2' : 'w-full py-1 border px-2'">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                  </select>
                  <p class="text-sm absolute text-red-500"> {{ model.errors.gender }}</p>
                </div>
                <div class="w-full pb-1">
                  <label class="text-sm">Birth Date</label>
                  <input v-model="model.details.birth_date" type="date" :class=" model.errors.birth_date ? 'w-full py-1 border border-red-500 focus:outline-red-500 px-2' : 'w-full py-1 border px-2'"/>
                  <p class="text-sm absolute text-red-500"> {{ model.errors.birth_date }}</p>
                </div>
              </div>
              <div class="flex justify-end py-2">
                <button @click="savePersonal" class="px-4 py-1 bg-gray-800 hover:bg-gray-900 text-white">
                  Save
                </button>
              </div>
            </div>

            <div class="shadow-md px-6 py-4">
              <h1 class="font-semibold text-2xl text-gray-800">Contact Information</h1>
              <div class="w-full md:w-1/2 pt-4">
                <label class="text-sm">Phone Number</label>
              </div>
              <input type="text" class="w-full py-1 border px-2 md:w-1/2" :value="model.customer.verified ? model.details.phone_number : ''" disabled/>
              <div class="flex justify-end py-2">
                <button @click="showPhoneNumberModal" class="uppercase px-4 py-1 flex bg-gray-800 hover:bg-gray-900 text-white">
                  <div class="flex" v-if="!model.details.phone_number && !model.customer.verified">
                    <span>
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                      </svg>
                    </span>
                    <h1 class="text-white">Phone Number</h1>
                  </div>
                  <div class="flex" v-else>
                    <h1 class="text-white">Change Number</h1>
                  </div>
                </button>
              </div>
            </div>

            <div class="shadow-md px-6 py-4">
              <h1 class="font-semibold text-2xl text-gray-800">Address Information</h1>
              <div v-if="model.details.customer_address.country && model.details.addressLoaded" class="border border-l-0 border-gray-300 shadow-sm w-2/3 my-3 flex space-x-4">
                <div class="w-fit h-full space-y-2">
                  <div class="px-0.5 py-3 bg-blue-700"></div>
                  <div class="px-0.5 py-3 bg-red-600"></div>
                  <div class="px-0.5 py-3 bg-blue-700"></div>
                  <div class="px-0.5 py-3 bg-red-600"></div>
                  <div class="px-0.5 py-3 bg-blue-700"></div>
                </div>
                <div class="py-2 px-3">
                  <div class="flex space-x-4">
                    <h1 class="text-gray-800">{{ model.details.first_name }}</h1>
                    <h1 class="text-sm text-gray-800">{{ model.details.phone_number }}</h1>
                  </div>
                  <h1 class="text-sm mt-6 text-gray-800">
                    {{ model.details.customer_address.address_line1 }}
                  </h1>
                  <h1 class="text-sm text-gray-800">
                    {{ model.details.customer_address.note }}
                  </h1>
                  <h1 class="text-sm my-2 text-gray-800">
                    {{ model.details.customer_address.barangay }} {{ model.details.customer_address.city }}, {{ model.details.customer_address.province }},  {{ model.details.customer_address.country }} {{ model.details.customer_address.zipcode }}
                  </h1>
                </div>
              </div>
              <div v-else>
                <h1 class="py-4 text-center text-gray-600">No address yet.</h1>
              </div>

              <div v-if="!model.details.customer_address.country && model.details.addressLoaded" class="flex justify-end py-2">
                <button @click="showAddressModal" class="uppercase px-4 py-1 flex bg-gray-800 hover:bg-gray-900 text-white">
                  <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                  </span>
                  Address
                </button>
              </div>
              <div v-else class="flex justify-end py-2">
                <button class="uppercase px-4 py-1 flex bg-gray-800 hover:bg-gray-900 text-white">
                  Update
                </button>
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

    <Modal v-show="isAddressModalVisible" @closeModal="closeAddressModal" @confirmModal="confirmAddressModal">
      <template v-slot:header>
        <h1 class="font-semibold text-gray-800 md:text-2xl md:px-4">Address</h1>
      </template>

      <template v-slot:body>
        <div class="w-full md:px-4">
          <div class="pt-4">
            <label class="text-sm">Country</label>
            <input v-model="model.address.country" type="text" class="w-full py-1 border px-2" disabled/>
          </div>
          <div class="flex flex-col space-y-2 pt-4 md:flex-row md:space-y-0 md:space-x-2">
            <div class="w-full">
              <label class="text-sm">Province</label>
              <select @change="selectProvince" id="province" :class="model.errors.province ? 'w-full py-1 border border-red-500 focus:outline-red-500 px-2' : 'w-full py-1 border px-2'"></select>
              <p class="text-sm absolute text-red-500">{{ model.errors.province }}</p>
            </div>
            <div class="w-full">
              <label class="text-sm">City</label>
              <select @change="selectCity" id="city" :class="model.errors.city ? 'w-full py-1 border border-red-500 focus:outline-red-500 px-2' : 'w-full py-1 border px-2'"></select>
              <p class="text-sm absolute text-red-500">{{ model.errors.city }}</p>
            </div>
          </div>
          <div class="flex flex-col space-y-2 pt-4 md:flex-row md:space-y-0 md:space-x-2">
            <div class="w-full">
              <label class="text-sm">Barangay</label>
              <select @change="selectBarangay" id="barangay" :class="model.errors.barangay ? 'w-full py-1 border border-red-500 focus:outline-red-500 px-2' : 'w-full py-1 border px-2'"></select>
              <p class="text-sm absolute text-red-500">{{ model.errors.barangay }}</p>
            </div>
            <div class="w-full">
              <label class="text-sm">Address Line 1</label>
              <input v-model="model.address.address_line1" type="text" :class="model.errors.address_line1 ? 'w-full py-1 border border-red-500 focus:outline-red-500 px-2' : 'w-full py-1 border px-2'"/>
              <p class="text-sm absolute text-red-500">{{ model.errors.address_line1 }}</p>
            </div>
          </div>
          <div class="flex flex-col space-y-2 pt-4 md:flex-row md:space-y-0 md:space-x-2">
            <div class="w-full">
              <label class="text-sm">NOTE (Optional)</label>
              <input v-model="model.address.note" type="text" class="w-full py-1 border px-2" placeholder="Phase/Unit/Floor, Landmark"/>
            </div>
            <div class="w-full">
              <label class="text-sm">Zipcode</label>
              <input v-model="model.address.zipcode" type="text" :class="model.errors.zipcode ? 'w-full py-1 border border-red-500 focus:outline-red-500 px-2' : 'w-full py-1 border px-2'"/>
              <p class="text-sm absolute text-red-500">{{ model.errors.zipcode }}</p>
            </div>
          </div>
        </div>
      </template>
    </Modal>

    <SmallModal v-show="isPhoneNumberModalVisible" @closeModal="closePhoneNumberModal" @confirmModal="confirmPhoneNumberModal">
      <template v-slot:header>
        <h1 class="px-4 font-semibold text-gray-800 md:text-xl">Phone Number</h1>
      </template>

      <template v-slot:body>
        <div class="w-full px-8">
          <label class="text-sm">Phone Number</label>
        </div>
        <div class="flex space-x-2 px-8">
          <input v-model="model.details.phone_number" v-on:keypress="numberkey" type="text" class="w-full py-1 border px-2" placeholder="+63" maxlength="10"/>
          <button @click="storePhoneNumber" class="px-3 py-1 bg-gray-800 text-white hover:bg-gray-900">Verify</button>
        </div>
        <div class="w-full mt-1 px-8">
          <label class="text-sm">Verification Code</label>
          <input v-model="model.details.verify_code" type="text" v-on:keypress="numberkey" :class="model.errors.verify_code ? 'w-full py-1 border border-red-500 focus:outline-red-500 px-2' : 'w-full py-1 border px-2'">
          <p class="text-sm absolute text-red-500">{{ model.errors.verify_code }}</p>
        </div>
      </template>

    </SmallModal>

  </div>
</template>

<script setup>
import { computed, onMounted, ref, watch } from "@vue/runtime-core";
import { useRouter } from "vue-router";
import store from "../../store";
import alert from "../../alert";
import Modal from '../../components/Modal.vue'
import SmallModal from '../../components/SmallModal.vue'
import numberkey from '../../numberkey.js'

  const isAddressModalVisible = ref(false)
  const isPhoneNumberModalVisible = ref(false)
  const router = useRouter()
  const model = ref({
    details : {
      first_name : '',
      last_name : '',
      gender : '',
      birth_date : '',
      phone_number : '',
      verify_code : '',
      current_password : '',
      password : '',
      password_confirmation : '',
      customer_address : [],
      addressLoaded : false
    },
    customer : [],
    address : {
      country : 'Philippines',
      province : '',
      city : '',
      barangay : '',
      address_line1 : '',
      zipcode : '',
      note : '',
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
      province : '',
      city : '',
      barangay : '',
      address_line1 : '',
      zipcode : '',
      verify_code : '',

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
      model.value.details.phone_number = profile.phone_number
      model.value.details.customer_address = profile.address
      model.value.details.addressLoaded = true
    }

  })

  watch(() => store.state.customer.data,
  (newVal, oldVal) => model.value.details.customer_address = newVal.address
  )

  watch(() => store.state.customer.data,
  (newVal, oldVal) => model.value.details.phone_number = newVal.phone_number
  )

  watch(() => store.state.customer.data,
  (newVal, oldVal) => model.value.customer = newVal
  )

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

  const showAddressModal = () => isAddressModalVisible.value = true
  const closeAddressModal = () => isAddressModalVisible.value = false
  const confirmAddressModal = async () => {
    model.value.errors.province = ''
    model.value.errors.city = ''
    model.value.errors.barangay = ''
    model.value.errors.address_line1 = ''
    model.value.errors.zipcode = ''

    const country = model.value.address.country
    const province = model.value.address.province
    const city = model.value.address.city
    const barangay = model.value.address.barangay
    const address_line1 = model.value.address.address_line1
    const zipcode = model.value.address.zipcode
    const note = model.value.address.note

    let provinceSelected = false
    let citySelected = false
    let barangaySelected = false
    let addressLineSelected = false
    let zipcodeSelected = false

    if(!province) {
      model.value.errors.province = 'Province is required'
    } else {
      provinceSelected = true
    }

    if(!city) {
      model.value.errors.city = 'City is required'
    } else {
      citySelected = true
    }

    if(!barangay) {
      model.value.errors.barangay = 'Barangay is required'
    } else {
      barangaySelected = true
    }

    if(!address_line1) {
      model.value.errors.address_line1 = 'Address Line is required'
    } else {
      addressLineSelected = true
    }

    if(!zipcode) {
      model.value.errors.zipcode = 'Zipcode is required'
    } else {
      zipcodeSelected = true
    }

    if(provinceSelected && citySelected && barangaySelected && addressLineSelected && zipcodeSelected) {
      try {
        const formData = new FormData()
        formData.append('country', country)
        formData.append('province', province)
        formData.append('city', city)
        formData.append('barangay', barangay)
        formData.append('address_line1', address_line1)
        formData.append('zipcode', zipcode)
        formData.append('note', note)
        await store.dispatch('setCustomerAddress', formData)
        alert('Address added!')
        isAddressModalVisible.value = false
      } catch (error) {

      }
    }
  }

  const showPhoneNumberModal = () => isPhoneNumberModalVisible.value = true
  const closePhoneNumberModal = () => isPhoneNumberModalVisible.value = false
  const confirmPhoneNumberModal = async () => {
    if(model.value.customer.phone_number && !model.value.customer.verified) {
      try {
      model.value.errors.verify_code = ''
      const formData = new FormData()
      formData.append('verify_code', model.value.details.verify_code)
      await store.dispatch('setVerifyPhone', formData)
      alert('Phone verified!')
      closePhoneNumberModal()
      model.value.details.verify_code = ''
    } catch (error) {
      if (error.response.data.errors.hasOwnProperty('verify_code')) {
        model.value.errors.verify_code = error.response.data.errors.verify_code[0]
      }
    }
   }
  }

  const storePhoneNumber = async () => {
    if(model.value.details.phone_number) {
      const formData = new FormData()
      formData.append('phone_number', model.value.details.phone_number)
      await store.dispatch('setPhoneNumber', formData)
      alert('Verification code sent!')
    }
  }

  const selectProvince = (event) => {
    model.value.address.province = $( `#${event.target.id} option:selected` ).text()
  }

  const selectCity = (event) => {
    model.value.address.city = $( `#${event.target.id} option:selected` ).text()
  }

  const selectBarangay = (event) => {
    model.value.address.barangay = $( `#${event.target.id} option:selected` ).text()
  }

  var my_handlers = {

  fill_provinces:  function(){

    $('#province').ph_locations('fetch_list', [{"region_code": 12}]);
    },

    fill_cities: function(){
        var province_code = $(this).val();
        $('#city').ph_locations( 'fetch_list', [{"province_code": province_code}]);
    },

    fill_barangays: function(){
        var city_code = $(this).val();
        $('#barangay').ph_locations('fetch_list', [{"city_code": city_code}]);
    }
  };

  $(function(){
    $('#province').on('change', my_handlers.fill_cities);
    $('#city').on('change', my_handlers.fill_barangays);

    $('#region').ph_locations({'location_type': 'regions'});
    $('#province').ph_locations({'location_type': 'provinces'});
    $('#city').ph_locations({'location_type': 'cities'});
    $('#barangay').ph_locations({'location_type': 'barangays'});

    $('#province').ph_locations('fetch_list');
  });

</script>

<style>

</style>
