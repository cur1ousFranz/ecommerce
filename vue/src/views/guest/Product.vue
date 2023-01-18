<template>
  <div>
    <section>
      <div class="px-24 py-6 flex space-x-2 text-gray-600" aria-label="Breadcrumb">
        <router-link :to="{ name : 'LandingPage'}" class="hover:text-gray-900 hover:underline">Home</router-link>
        <div>/</div>
        <router-link :to="{ name : 'Product', params : { slug : slug}}" class="hover:text-gray-900 hover:underline">{{ convertSlug(slug) }}</router-link>
      </div>
    </section>

    <section>
      <div class="mx-12 my-6 space-x-4 flex">
        <div class="w-2/12 border h-screen">
          <!-- ATTRIBUTES -->
        </div>
        <div class="w-10/12 px-3">
          <div class="grid gap-2 grid-cols-2 md:grid-cols-4">
            <div v-on:mouseout="backImage(product.id, product.product_item.product_image)"
            v-on:mouseover="replaceImage(product.id, product.product_item.product_image)" v-for="product in products" :key="product.id" class="cursor-pointer mx-2">
              <img :id="product.id" :src="JsonParse(product.product_item.product_image)" alt="">
              <h1 class="text-sm py-1 px-1 text-gray-600" >{{ product.name }}</h1>
              <h1 class="font-semibold px-2 text-orange-500">₱ {{ formatPrice(product.product_item.price) }}</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { computed, onMounted, ref } from "@vue/runtime-core";
import { useRoute, useRouter } from "vue-router";
import store from "../../store";

  const route = useRoute()
  let slug = route.params.slug
  const products = computed(() => store.state.category.products)
  const attributes = computed(() => store.state.category.attributes)

  onMounted(() => {
    if(route.params){
      store.dispatch('getCategoryProducts', route.params.slug)
      store.dispatch('getCategoryAttributes', route.params.slug)
    }
    onTop()
  })

  const convertSlug = (slug) => {
    return slug
      .replace(/^\w+-/, "")
      .replace(/-/g, " ")
      .split(" ")
      .map(word => word.charAt(0).toUpperCase() + word.slice(1))
      .join(" ");
  }

  const JsonParse = (imageString, index = 0) => {
    return JSON.parse(imageString)[index]
  }

  const formatPrice = (price) => {
    return price.toLocaleString()
  }

  const replaceImage = (id, imageString) => {
    let img = document.getElementById(`${id}`)
    img.src = JsonParse(imageString, 1)
  }

  const backImage = (id, imageString) => {
    let img = document.getElementById(`${id}`)
    img.style.transition = "all 2s";
    img.src = JsonParse(imageString, 0)
  }

  const onTop = () => {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }

</script>
<style scoped>

</style>


