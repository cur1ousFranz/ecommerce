<template>
  <div>
    <!-- BANNER -->
    <ErrorDialog  v-if="model.errors.connection"/>
    <section>
      <div class="grid grid-cols-1 px-12 lg:grid-cols-2">
        <div class="space-y-3 my-32">
          <h1 class="text-4xl font-semibold" style="letter-spacing: 2px">
            Discover products for a life well lived.
          </h1>
          <h1 class="text-justify text-lg font-semibold lg:text-left" style="letter-spacing: 2px">
            We get it. You want products that make you feel your best without devoting your life to finding them.
          </h1>
          <div class="flex justify-center">
            <router-link :to="{ name : 'Signin' }" class="px-3 py-2 mt-4 bg-gray-800 text-white hover:bg-gray-700">
              Shop Now!
            </router-link>
          </div>
        </div>
        <div class="hidden mt-8 lg:flex lg:justify-center">
          <img src="/img/banner.jpg" class="w-2/3" alt="">
        </div>
      </div>
    </section>

    <!-- CATEGORIES -->
    <section>
      <div class="px-6 my-12 w-42 md:px-12">
        <h1 class="text-lg mt-6 text-gray-600 text-center font-bold md:text-2xl">SHOP BY CATEGORY</h1>
        <div class="text-lg flex font-semibold justify-center md:justify-start">
          <div v-for="category in model.categories.main" :key="category"
          @click="selectCategory(category)" :class="[ model.categories.selectedCategory === category ? 'cursor-pointer uppercase px-2 py-3 border-b border-gray-700 text-gray-700' : 'cursor-pointer uppercase px-2 py-3 text-gray-400 hover:text-gray-700']" style="letter-spacing: 3px">{{ category }}</div>
        </div>
        <div v-if="model.categories.selectedCategory === 'Women'" class="grid grid-cols-2 my-4 gap-3 md:grid-cols-5">
          <ProductLink v-for="category in womenCategory.children" :key="category" :sub="category.name" :slug="category.slug" :icon="category.icon"/>
        </div>
        <div v-if="model.categories.selectedCategory === 'Men'" class="grid grid-cols-2 my-4 gap-3 md:grid-cols-4 lg:grid-cols-6">
          <ProductLink v-for="category in menCategory.children" :key="category" :sub="category.name" :slug="category.slug" :icon="category.icon"/>
        </div>
        <div v-if="model.categories.selectedCategory === 'Kids'" class="grid grid-cols-2 my-4 gap-3 md:grid-cols-5">
          <ProductLink v-for="category in kidsCategory.children" :key="category" :sub="category.name" :slug="category.slug" :icon="category.icon"/>
        </div>
      </div>
    </section>

    <!-- NEW ARRIVALS -->
    <section>
      <div class="px-6 my-32 md:px-12">
        <h1 class="text-lg my-6 text-gray-600 font-bold md:text-lg">
          <span class="inline-block text-yellow-500">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-lightning-charge" viewBox="0 0 16 16">
            <path d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09zM4.157 8.5H7a.5.5 0 0 1 .478.647L6.11 13.59l5.732-6.09H9a.5.5 0 0 1-.478-.647L9.89 2.41 4.157 8.5z"/>
            </svg>
          </span>
          NEW ARRIVALS
        </h1>
        <div class="grid grid-cols-2 md:grid-cols-5">
          <div class="shadow-md hover:shadow-xl cursor-pointer mx-2 my-3">
            <img src="/img/1.webp" alt="">
            <h1 class="text-lg font-semibold py-2 px-2" style="letter-spacing: 1px">$ 10.99</h1>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import { computed, onMounted } from "@vue/runtime-core";
import store from "../../store";
import ErrorDialog from '../../components/ErrorDialog.vue'
import ProductLink from '../../components/product/ProductLink.vue'

  const model = ref({
    categories : {
      main : ['Women', 'Men', 'Kids'],
      selectedCategory : 'Women'
    },
    errors : {
      connection : false
    }
  })

  const womenCategory = computed(() => store.state.category.women)
  const menCategory = computed(() => store.state.category.men)
  const kidsCategory = computed(() => store.state.category.kids)

  onMounted(async () => {
    try {
      await store.dispatch('getWomenCategory')
      await store.dispatch('getMenCategory')
      await store.dispatch('getKidsCategory')
    } catch (error) {
      model.value.errors.connection = true
    }
  })

  const selectCategory = (category) => {
    model.value.categories.selectedCategory = category
  }

  const convertSlug = (string) => {
    return string.replace(/\s+/g, '-');
  }

</script>
