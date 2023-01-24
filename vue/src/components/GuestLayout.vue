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
          <img src="/img/nav-logo.png" class="w-24" alt="" oncontextmenu="return false;">
        </router-link>
      </div>

      <div class="hidden space-x-3 relative md:flex">
        <div id="small-banner-bg" class="px-12 mt-2 bg-slate-100">
          <h1 id="small-banner" class="text-end text-red-500 transition duration-500 ease-in-out">Free Standard Shipping!</h1>
        </div>
        <div class="relative">
          <div @mouseenter="showCartDropdown" class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-cart3 cursor-pointer mt-2" viewBox="0 0 16 16">
            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <span v-if="model.cart.cartData.length" class="absolute text-xs ml-3 -mt-8 rounded-full font-bold px-2 py-1 text-white bg-red-600">
              {{ model.cart.cartData.length }}
            </span>
          </div>
          <div @mouseleave="hideCartDropdown" v-if="showCart" class="w-full right-0 top-0 bg-black">
            <div class="origin-top-right absolute right-0 mt-3 w-96 z-10 border rounded-md shadow-lg bg-white ">
              <div class="flex space-x-3 px-2 pt-4">
                <span class="mt-1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-shop-window" viewBox="0 0 16 16">
                    <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h12V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zm2 .5a.5.5 0 0 1 .5.5V13h8V9.5a.5.5 0 0 1 1 0V13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5a.5.5 0 0 1 .5-.5z"/>
                  </svg>
                </span>
                <h1 class="text-lg font-semibold text-gray-800">ATC</h1>
              </div>
              <div class="rounded-md shadow-xs max-h-96 shadow-xl bg-white overflow-auto">
                <div class="h-full w-full px-2 py-2">
                  <div v-if="model.cart.cartData.length" class="pt-2 space-y-2">
                    <div class="flex space-x-2 border-b py-2" v-for="product in model.cart.cartData" :key="product.id">
                      <div class="w-1/3">
                        <img @click="showProduct(product)" :src="JSON.parse(product.product_item.product_image)[0]" :alt="product.name" class="cursor-pointer">
                      </div>
                      <div class="w-full">
                        <router-link :to="{ name : 'ProductShow', params : { slug : product.categories[0].slug, name : productNameSlug(product.name), sku : product.product_item.sku }}" class="text-sm text-gray-700 hover:underline">{{ product.name }}
                        </router-link>
                        <h1 class="font-semibold text-sm text-orange-500">₱{{ formatPrice(product) }}</h1>
                        <div class="flex justify-between">
                          <h1 class="rounded-full px-2 border w-fit text-sm border-gray-800">{{ product.pivot.size }}</h1>
                          <span @click="removeCartProduct(product)" class="cursor-pointer hover:text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                              <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                            </svg>
                          </span>
                        </div>
                        <div class="flex justify-between mt-4">
                          <div class="flex">
                            <span @click="product.pivot.quantity > 1 ? updateQuantity(product, 'sub') : ''" class="px-2 border cursor-pointer hover:border-gray-800">-</span>
                            <span class="px-2 border">{{ product.pivot.quantity }}</span>
                            <span @click="updateQuantity(product, 'add')" class="px-2 border cursor-pointer hover:border-gray-800">+</span>
                          </div>
                          <h1 class="font-semibold text-gray-800">Total: ₱{{ totalPriceQuantity(product) }}</h1>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div v-else class="py-4">
                    <div class="flex justify-center">
                      <img src="/img/empty-cart.png" class="w-6 md:w-16" alt="">
                    </div>
                    <h1 class="text-center text-gray-400 py-2">Shopping Cart is Empty</h1>
                    <h1 class="text-center text-sm text-gray-400 ">Welcome back! If you had items in your shopping cart, we have saved them for you. You can SIGN IN now to see them, or whenever you're ready to check out.</h1>
                  </div>
                </div>
              </div>
              <router-link :to="{ name : 'Cart'}">
                <div v-if="model.cart.cartData.length" class="py-3 font-semibold cursor-pointer w-full text-center text-white bg-gray-800 hover:bg-gray-900">ViEW CART ({{ model.cart.cartData.length }})
                </div>
              </router-link>
            </div>
          </div>
        </div>
        <!-- MENU -->
        <div v-if="authenticated" class="relative inline-block text-left">
          <div>
            <span class="rounded-md shadow-sm">
              <button @click="showDropdown" type="button" class="inline-flex justify-center w-full rounded-full border-gray-300 px-3 py-1 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                <img src="/img/profile-default.png" class="w-7" alt="">
              </button>
            </span>
          </div>
          <div v-if="show" class="origin-top-right absolute right-0 mt-2 w-56 z-10 rounded-md shadow-lg">
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
import { computed, onMounted, ref, watch } from 'vue'
import { useRouter } from 'vue-router'
import store from '../store'

  const router = useRouter()
  const show = ref(false)
  const showCart = ref(false)
  const alternate = ref(false)
  const authenticated = ref(false)
  const showDropdown = () => {
    show.value = !show.value
  }

  const model = ref({
    cart : {
      cartData : [],
    }
  })

  const cartLoading = computed(() => store.state.cart.loading)

  watch(() => store.state.cart.data,
    (newVal, oldVal) => model.value.cart.cartData = newVal
  )

  let smallBanner
  let smallBannerBg
  onMounted(async () => {
    let nav = document.querySelector('#nav-icon1')
    nav.addEventListener('click', () => nav.classList.toggle('open'))

    smallBanner = document.querySelector('#small-banner')
    smallBannerBg = document.querySelector('#small-banner-bg')

    if(localStorage.getItem('TOKEN')) {
      authenticated.value = true
    }

    if(store.state.user.token) {
      store.dispatch('getCustomerCart')
    }
  })

  setInterval(() => {
    if(alternate.value) {
      smallBannerBg.classList.remove('bg-blue-100')
      smallBannerBg.classList.add('bg-slate-100')
      smallBanner.classList.remove('text-gray-700')
      smallBanner.classList.add('text-red-500')
      smallBanner.innerHTML = 'Free Standard Shipping!'
    } else {
      smallBannerBg.classList.add('bg-blue-100')
      smallBannerBg.classList.remove('bg-slate-100')
      smallBanner.classList.remove('text-red-500')
      smallBanner.classList.add('text-gray-700')
      smallBanner.innerHTML = 'Get ₱150 off Your First Order'

    }
    alternate.value = !alternate.value
  }, 3000)

  const signOut = async () => {
    await store.dispatch('signOutUser')
    window.location = '/'
  }

  const showCartDropdown = () => showCart.value = true
  const hideCartDropdown = () => showCart.value = false

  const formatPrice = (product) => {
    const price = product.product_item.price
    let percentage = product.product_item.sale_price / 100
    let newPrice = price - (price * percentage)
    return Math.ceil(newPrice).toLocaleString()
  }

  const updateQuantity = (product, action) => {
    const formData = new FormData()
    formData.append('product_id', product.id)
    formData.append('cart_id', product.pivot.cart_id)
    formData.append('size', product.pivot.size)
    formData.append('quantity', product.pivot.quantity)
    formData.append('action', action)
    formData.append('_method', 'put')
    store.dispatch('addCartProductQuantity', formData)
  }

  const removeCartProduct = async (product) => {
    const formData = new FormData()
    formData.append('product_id', product.id)
    formData.append('cart_id', product.pivot.cart_id)
    formData.append('size', product.pivot.size)
    formData.append('_method', 'delete')
    await store.dispatch('deleteCartProduct', formData)
  }

  const totalPriceQuantity = (product) => {
    const price = product.product_item.price
    const percentage = product.product_item.sale_price / 100
    const quantity = product.pivot.quantity
    const newPrice = price - (price * percentage)
    const total = Math.ceil(newPrice) * quantity
    return total.toLocaleString()
  }

  const productNameSlug = (name) => {
    return name
    .replace(/[^a-zA-Z0-9]+/g, '-')
    .replace(/^-+|-+$/g, '');
  }

  const showProduct = (product) => {
    router.push({ name : 'ProductShow', params : { slug : product.categories[0].slug, name : productNameSlug(product.name), sku : product.product_item.sku }})
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

::-webkit-scrollbar {
  width: 0.4em;
  background-color: #F5F5F5;
}

/* Webkit browsers */
::-webkit-scrollbar-thumb {
  background-color: #c2bdbd;
}

</style>
