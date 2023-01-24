<template>
  <div>
    <section>
      <div class="w-11/12 mx-auto py-6 max-h-screen">
        <div v-if="model.cart.cartData.length" class="flex flex-col space-y-3 md:space-y-0 md:flex-row md:space-x-4">
          <div class="w-12/12 space-y-2 md:w-8/12">
            <div class="shadow-sm border p-4">
              <div class="text-lg flex space-x-2 font-semibold uppercase text-gray-800">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cart3 cursor-pointer mt-2" viewBox="0 0 16 16">
                  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                  </svg>
                </span>
                <h1 class="mt-1">Cart Items</h1>
              </div>
            </div>
            <div class="shadow-sm border p-6 max-h-96 overflow-auto">
              <div v-for="product in model.cart.cartData" :key="product.id" class="mb-5">
                <div class="flex space-x-4">
                  <div class="relative w-1/4">
                    <img @click="showProduct(product)" :src="JSON.parse(product.product_item.product_image)[0]" :alt="product.name" class="cursor-pointer">
                  </div>
                  <div class="w-full flex flex-col justify-between">
                    <div class="space-y-2">
                      <router-link :to="{ name : 'ProductShow', params : { slug : product.categories[0].slug, name : productNameSlug(product.name), sku : product.product_item.sku }}" class="text-sm text-gray-700 hover:underline">{{ product.name }}
                      </router-link>
                      <h1 class="px-3 text-xs h-fit w-fit border border-gray-800 text-gray-800">
                        {{ product.pivot.size }}
                      </h1>
                      <div class="flex justify-between">
                        <h1 class="text-sm px-3 w-fit bg-gray-800 text-white">
                          Only {{ product.product_item.qty_stock }} left
                        </h1>
                        <h1 @click="removeCartProduct(product)" class="uppercase cursor-pointer text-sm hover:underline md:hidden">Delete</h1>
                      </div>
                    </div>
                    <div class="hidden px-4 md:flex md:justify-between">
                      <div class="flex items-center space-x-1">
                        <div>
                          <h1 class="font-semibold text-sm text-orange-500">₱{{ formatPrice(product) }}</h1>
                          <h1 v-if="product.product_item.sale_price" class="text-sm line-through text-gray-400 ">₱{{ formatOriginalPrice(product.product_item.price) }}</h1>
                        </div>
                        <div v-if="product.product_item.sale_price" class="text-xs px-1 bg-gray-800 text-white">
                        -{{ product.product_item.sale_price }}%
                        </div>
                      </div>
                      <div class="flex justify-between">
                        <div class="flex h-fit">
                          <span @click="product.pivot.quantity > 1 ? updateQuantity(product, 'sub') : ''" :class="product.pivot.quantity > 1 ? 'px-2 border cursor-pointer hover:border-gray-800' : 'px-2 border cursor-pointer text-gray-400'">-</span>
                          <span class="px-2 border">{{ product.pivot.quantity }}</span>
                          <span @click="updateQuantity(product, 'add')" class="px-2 border cursor-pointer hover:border-gray-800">+</span>
                        </div>
                      </div>
                      <h1 class="font-semibold text-gray-800">Total: ₱{{ totalPriceQuantity(product) }}</h1>
                    </div>

                    <h1 @click="removeCartProduct(product)" class="hidden uppercase cursor-pointer text-sm hover:underline md:block">Delete</h1>
                  </div>
                </div>

                <div class="flex justify-between my-4 md:hidden md:justify-between">
                  <div class="flex items-center space-x-1">
                    <div>
                      <h1 class="font-semibold text-sm text-orange-500">₱{{ formatPrice(product) }}</h1>
                      <h1 v-if="product.product_item.sale_price" class="text-sm line-through text-gray-400 ">₱{{ formatOriginalPrice(product.product_item.price) }}</h1>
                    </div>
                    <div v-if="product.product_item.sale_price" class="text-xs px-1 bg-gray-800 text-white">
                    -{{ product.product_item.sale_price }}%
                    </div>
                  </div>
                  <div class="flex justify-between">
                    <div class="flex h-fit">
                      <span @click="product.pivot.quantity > 1 ? updateQuantity(product, 'sub') : ''" :class="product.pivot.quantity > 1 ? 'px-2 border cursor-pointer hover:border-gray-800' : 'px-2 border cursor-pointer text-gray-400'">-</span>
                      <span class="px-2 border">{{ product.pivot.quantity }}</span>
                      <span @click="updateQuantity(product, 'add')" class="px-2 border cursor-pointer hover:border-gray-800">+</span>
                    </div>
                  </div>
                  <h1 class="font-semibold text-gray-800">Total: ₱{{ totalPriceQuantity(product) }}</h1>
                </div>
              </div>
            </div>
          </div>
          <div class="w-12/12 md:w-4/12">
            <div class="p-4 h-fit border shadow-sm">
              <h1 class="text-lg font-semibold uppercase text-gray-800">Order Summary</h1>
              <h1 class="my-3 text-gray-800 space">
                Subtotal:
                <span class="my-3 text-end text-3xl font-semibold text-gray-800">
                  ₱
                </span>
              </h1>
              <div class="uppercase cursor-pointer w-full py-3 my-4 text-center font-bold bg-gray-800 text-white hover:bg-gray-900">
                Checkout Now
              </div>
            </div>
          </div>
        </div>
        <div v-if="!model.cart.cartData.length && model.productLoaded" class="shadow-sm py-24 max-h-96 ">
          <div class="flex justify-center">
            <img src="/img/empty-cart.png" class="w-6 md:w-16" alt="">
          </div>
          <h1 class="text-center text-lg font-semibold text-gray-400 py-2">Shopping Cart is Empty</h1>
          <div class="flex justify-center my-6">
            <div @click="goHome()" class="cursor-pointer px-6 py-1 border  bg-gray-800 text-white">
              SHOP NOW
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<!-- TODO:: DISPLAY SUB TOTAL WITH TOTAL OF DISCOUNT -->
<script setup>
import { onMounted, ref, watch } from "@vue/runtime-core";
import { useRouter } from "vue-router";
import store from "../../store";

  const router = useRouter()
  const model = ref({
      cart : {
        cartData : [],
      },
      productLoaded : false
    })

  watch(() => store.state.cart.data,
    (newVal, oldVal) => model.value.cart.cartData = newVal
  )

  onMounted(async () => {
    if(store.state.user.token) {
      await store.dispatch('getCustomerCart')
      model.value.productLoaded = true
    }
  })

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

  const totalPriceQuantity = (product) => {
    const price = product.product_item.price
    const percentage = product.product_item.sale_price / 100
    const quantity = product.pivot.quantity
    const newPrice = price - (price * percentage)
    const total = Math.ceil(newPrice) * quantity
    return total.toLocaleString()
  }

  const removeCartProduct = async (product) => {
    const formData = new FormData()
    formData.append('product_id', product.id)
    formData.append('cart_id', product.pivot.cart_id)
    formData.append('size', product.pivot.size)
    formData.append('_method', 'delete')
    await store.dispatch('deleteCartProduct', formData)
  }

  const showProduct = (product) => {
    router.push({ name : 'ProductShow', params : { slug : product.categories[0].slug, name : productNameSlug(product.name), sku : product.product_item.sku }})
  }

  const productNameSlug = (name) => {
    return name
    .replace(/[^a-zA-Z0-9]+/g, '-')
    .replace(/^-+|-+$/g, '');
  }

  const goHome = () => router.push({ name : 'LandingPage'})
  const formatOriginalPrice = (price, sale) => price.toLocaleString()
</script>

<style>

</style>
