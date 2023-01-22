<template>
  <div>
    <section>
      <div class="w-10/12 mx-auto py-6">
        <div class="flex space-x-1 text-sm text-gray-500">
          <router-link :to="{ name : 'LandingPage'}" class="hover:text-gray-900 hover:underline">Home</router-link>
          <div>/</div>
          <router-link :to="{ name : 'Product', params : { slug : slug}}" class="hover:text-gray-900 hover:underline">{{ convertSlug(slug) }}</router-link>
          <div>/</div>
          <div>
            <h1>{{ removeSlug(productName) }}</h1>
          </div>
        </div>
        <div v-if="!model.products.productLoaded">Loading ...</div>
        <div v-else class="flex space-x-2">
          <div  class="w-1/2 my-3 flex justify-between space-x-2 border">
            <div class="w-2/12 space-y-1">
              <!-- IMAGES -->
              <img @click="clickImage(index, JsonParse(product.product_item.product_image) )" v-for="(image, index) in JsonParse(product.product_item.product_image)" :key="image" :src="image" :alt="image" :class="[model.images.currentImageIndex  === index ? 'cursor-pointer border border-black p-1' : 'cursor-pointer p-1']">
            </div>
            <div class="w-10/12">
              <img id="big-image" :src="JsonParse(product.product_item.product_image)[model.images.currentImageIndex]" alt=""/>
            </div>
          </div>

          <div class="w-1/2 my-3 px-12">
            <h1 class="text-gray-800">{{ product.name }}</h1>
            <h1 class="text-sm text-gray-500">SKU: {{ product.product_item.sku }}</h1>
            <div class="text-2xl py-3 font-bold font-monospace flex justify-start space-x-1 text-orange-500">
              <h1 class="font-semibold px-2 text-orange-500">
                ₱{{ formatPrice(product.product_item.price, product.product_item.sale_price) }}
              </h1>
              <h1 v-if="product.product_item.sale_price" class="font-semibold px-1 text-lg text-gray-400 line-through">₱{{ formatOriginalPrice(product.product_item.price) }}</h1>
              <div v-if="product.product_item.sale_price" class="my-2 px-2 text-sm bg-gray-800 text-white">
                -{{ product.product_item.sale_price }}%
              </div>
            </div>
            <h1 class="mt-12 text-lg font-semibold">Size</h1>
            <div class="flex justify-around">
              <div v-for="attribute in JSON.parse(product.description)" :key="attribute">
                <!-- {{ attribute }}
                <div v-if="attribute === 'Size'">
                </div> -->


                <!-- <div v-if="attribute === 'Size'">
                  <div  v-for="size in attribute" :key="size">
                    <h1 v-if="size.count !== 0">size.count</h1>
                  </div>
                </div> -->
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
  </div>
</template>

<script setup>
import { computed, onMounted, ref } from "@vue/runtime-core";
import { useRoute } from "vue-router";
import store from "../../store";

  const route = useRoute()
  const slug = route.params.slug
  const productName = route.params.name
  const model = ref({
    products : {
      productLoaded : false
    },
    images : {
      currentImageIndex : 0
    },
    sizes : []
  })

  const product = computed(() => store.state.products.product)
  const productLoading = computed(() => store.state.products.loading)

  onMounted(async() => {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
    if(route.params){
      const formData = new FormData()
      formData.append('sku', route.params.sku)
      formData.append('_method', 'get')
      await store.dispatch('getProduct', formData)
      model.value.products.productLoaded = true
      // model.value,sizes = product
      // const stringiy
      // fo
      // console.log(product.value.description);
    }
  })

  const convertSlug = (slug) => {
    return slug
      .replace(/^\w+-/, "")
      .replace(/-/g, " ")
      .split(" ")
      .map(word => word.charAt(0).toUpperCase() + word.slice(1))
      .join(" ");
  }

  const removeSlug = (slug) => slug.replace(/-/g, " ");
  const JsonParse = (string) => JSON.parse(string)
  const clickImage = (index, image) => {
    model.value.images.currentImageIndex = index
    const img = document.querySelector('#big-image')
    img.src = image[index]
  }

  const formatPrice = (price, sale) => {
    let percentage = sale/100
    let newPrice = price - (price * percentage)
    return Math.ceil(newPrice).toLocaleString()
  }

  const formatOriginalPrice = (price, sale) => {
    return price.toLocaleString()
  }

</script>

<style>

</style>
