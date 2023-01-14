<template>
  <div>
    <!-- BANNER -->
    <section>
      <div class="grid grid-cols-1 px-24 h-screen md:grid-cols-2">
        <div class="space-y-3 order-last md:my-32 md:order-first">
          <h1 class="text-4xl font-semibold" style="letter-spacing: 2px">
            Discover a products for a life well lived.
          </h1>
          <h1 class="text-justify text-lg font-semibold md:text-left" style="letter-spacing: 2px">
            We get it. You want products that make you feel your best without devoting your life to finding them.
          </h1>
          <div class="flex justify-center">
            <router-link :to="{ name : 'Signin' }" class="px-3 py-2 mt-4 bg-gray-800 text-white hover:bg-gray-700">
              Shop Now!
            </router-link>
          </div>
        </div>
        <div class="mt-8 flex justify-center">
          <img src="/img/banner.jpg" class="w-2/3 h-fit" alt="">
        </div>
      </div>
    </section>

    <!-- CATEGORIES -->
    <section>
      <div class="px-6 mx-12 my-24 w-42 md:px-12">
        <h1 class="text-lg mt-6 text-gray-600 text-center font-bold md:text-2xl">SHOP BY CATEGORY</h1>
        <div class="text-lg flex font-semibold justify-center md:justify-start">
          <button @click="selectCategory('Women')" :class="[ model.categories.selectedCategory === 'Women' ? 'px-2 py-3 border-b border-gray-700 text-gray-700' : ' px-2 py-3 text-gray-400 hover:text-gray-700']" style="letter-spacing: 3px">WOMEN</button>
          <button @click="selectCategory('Men')" :class="[ model.categories.selectedCategory === 'Men' ? 'px-2 py-3 border-b border-gray-700 text-gray-700' : ' px-2 py-3 text-gray-400 hover:text-gray-700']" style="letter-spacing: 3px">MEN</button>
          <button @click="selectCategory('Baby')" :class="[ model.categories.selectedCategory === 'Baby' ? 'px-2 py-3 border-b border-gray-700 text-gray-700' : ' px-2 py-3 text-gray-400 hover:text-gray-700']" style="letter-spacing: 3px">KIDS</button>
        </div>
        <div v-if="model.categories.selectedCategory === 'Women'" class="grid grid-cols-2 my-4 gap-3 md:grid-cols-5">
          <div v-for="category in model.categories.Women" :key="category" class="flex py-2 justify-center flex-col border shadow-lg md:flex-row">
            <img :src="category.icon" alt="" class="w-20">
            <p class="px-4 text-center text-sm font-semibold overflow-hidden whitespace-normal text-gray-700 md:mt-8">{{ category.sub }}</p>
          </div>
        </div>
        <div v-if="model.categories.selectedCategory === 'Men'" class="grid grid-cols-2 my-4 gap-3 md:grid-cols-4 lg:grid-cols-6">
          <div v-for="category in model.categories.Men" :key="category" class="flex py-2 justify-center flex-col border shadow-lg md:flex-row">
            <img :src="category.icon" alt="" class="w-20">
            <p class="px-4 text-center text-sm font-semibold overflow-hidden whitespace-normal text-gray-700 md:mt-8">{{ category.sub }}</p>
          </div>
        </div>
        <div  v-if="model.categories.selectedCategory === 'Baby'">
          <h1 v-for="category in model.categories.Baby" :key="category">{{ category.sub }}</h1>
        </div>
        <!-- <div class="grid grid-cols-2 md:grid-cols-3">
              <div class="mt-2 mx-2 bg-gray-200 py-3 px-6">
                  <div class="flex justify-center">
                      <img src="/img/tops.png" class="w-1/3"  alt="">
                  </div>
                  <h1 class="font-semibold mx-2 text-center text-gray-900">Tops</h1>
              </div>

              <div class="mt-2 mx-2 bg-gray-200 py-3 px-6">
                  <div class="flex justify-center">
                      <img src="/img/dress.png" class="w-1/3"  alt="">
                  </div>
                  <h1 class="font-semibold mx-2 text-center text-gray-900">Dresses</h1>
              </div>

              <div class="mt-2 mx-2 bg-gray-200 py-3 px-6">
                  <div class="flex justify-center">
                      <img src="/img/bottom.png" class="w-1/3"  alt="">
                  </div>
                  <h1 class="font-semibold mx-2 text-center text-gray-900">Bottoms</h1>
              </div>

              <div class="mt-2 mx-2 bg-gray-200 py-3 px-6">
                  <div class="flex justify-center">
                      <img src="/img/bag-shoe.png" class="w-1/3"  alt="">
                  </div>
                  <h1 class="font-semibold mx-2 text-center text-gray-900 whitespace-nowrap">Shoes & Bags</h1>
              </div>

              <div class="mt-2 mx-2 bg-gray-200 py-3 px-6">
                  <div class="flex justify-center">
                      <img src="/img/accessories.png" class="w-1/3"  alt="">
                  </div>
                  <h1 class="font-semibold mx-2 text-center text-gray-900">Accessories</h1>
              </div>

              <div class="mt-2 mx-2 bg-gray-200 py-3 px-6">
                  <div class="flex justify-center">
                      <img src="/img/active-wear.png" class="w-1/3"  alt="">
                  </div>
                  <h1 class="font-semibold mx-2 text-center text-gray-900">Activewear</h1>
              </div>
          </div> -->
      </div>
    </section>

    <!-- NEW ARRIVALS -->
    <section>
        <div class="px-6 mx-12 my-32 md:px-12">
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

  const model = ref({
    categories : {
      Women : [
        {sub : 'Dresses', icon : "/img/women/Dresses.png"}, {sub : 'Tops', icon : "/img/women/Tops.png"}, {sub : 'Bottoms', icon : "/img/women/Bottoms.png"},
        {sub : 'Two-Piece', icon : "/img/women/Two-Piece.png"}, {sub : 'Jumpsuits', icon : "/img/women/Jumpsuits.png"}, {sub : 'Activewear', icon : "/img/women/Activewear.png"},
        {sub : 'Lingerie & Loungewear', icon : "/img/women/Lingerie.png"}, {sub : 'Accessories & Jewelry', icon : "/img/women/Accessories.png"},
        {sub : 'Shoes & Bags', icon : "/img/women/ShoesBags.png"}, {sub : 'Plus Size', icon : "/img/women/PlusSize.png"},
      ],
      Men : [
      {sub : 'Tops', icon : "/img/men/Tops.png"}, {sub : 'Bottoms', icon : "/img/men/Bottoms.png"},
      {sub : 'Co-ords', icon : "/img/men/Co-ords.png"}, {sub : 'Denim', icon : "/img/men/Denim.png"},
      {sub : 'Activewear', icon : "/img/men/Activewear.png"}, {sub : 'Extended Size', icon : "/img/men/Extended.png"},
      {sub : 'Hoodie & Sweatshirts', icon : "/img/men/Hoodies.png"}, {sub : 'Knitwear', icon : "/img/men/Knitwear.png"},
      {sub : 'Underwear & Sleepwear', icon : "/img/men/Underwear.png"},
      {sub : 'Shoes & Bags', icon : "/img/men/ShoesBags.png"},  {sub : 'Accessories & Jewelry', icon : "/img/men/Accessory.png"},
      {sub : 'Outerwear', icon : "/img/men/Outerwear.png"},
      ],
      Baby : [
        {sub : 'Baby', icon : ""}, {sub : 'Toddler Boys', icon : ""}, {sub : 'Toddler Girls', icon : ""},
        {sub : 'Boys', icon : ""}, {sub : 'Girls', icon : ""}, {sub : 'Bags', icon : ""},
        {sub : 'Accessories & Jewelry', icon : ""}, {sub : 'Shoes', icon : ""}, {sub : 'Maternity', icon : ""},
        {sub : 'Mommy & Me', icon : ""}
      ],
    selectedCategory : 'Women'

    },
  })

  // const mainCategories = computed(() => store.state.categories.mainCategory)
  // const subCategories = computed(() => store.state.categories.subCategory)

  // onMounted(async () => {
  //   try {
  //     await store.dispatch('getMainCategory')
  //     await store.dispatch('getSubCategory', model.value.categories.mainCategoryId)
  //   } catch (error) {
  //     model.value.errors.connection = true
  //   }
  // })

  const selectCategory = (category) => {
    model.value.categories.selectedCategory = category
  }

</script>

<style>

</style>
