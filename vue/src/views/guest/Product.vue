<template>
  <div v-if="productsLoading">
    <div class="py-44 mt-12">
      <Loading/>
    </div>
  </div>
  <div v-else>
    <section>
      <div class="flex justify-between bg-gray-50">
        <div class="px-24 py-6 flex space-x-2 text-gray-600" aria-label="Breadcrumb">
          <router-link :to="{ name : 'LandingPage'}" class="hover:text-gray-900 hover:underline">Home</router-link>
          <div>/</div>
          <router-link :to="{ name : 'Product', params : { slug : slug}}" class="hover:text-gray-900 hover:underline">{{ convertSlug(slug) }}</router-link>
        </div>
        <div class="px-24 py-6 flex text-gray-600">
          <input type="text" placeholder="Search" class="w-full h-fit py-2 border px-2">
          <span class="bg-gray-800 py-2 px-2 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
          </span>
        </div>
      </div>
    </section>

    <section>
      <div class="mx-12 my-6 space-x-4 flex">
        <div class="hidden w-2/12 max-h-screen space-y-6 overflow-auto md:block">
          <!-- ATTRIBUTES -->
          <div v-for="attribute in attributes" :key="attribute">
            <div v-if="attribute.name !== 'Size' && attribute.name !== 'Color'" class="px-0 text-gray-700 md:px-4">
              <h1 class="text-gray-900 font-semibold">{{ attribute.name }}</h1>
                <Checkbox :id="value.id" @change="selectCheckBox(attribute.name, value.name, value.id)" v-for="value in attribute.values" :key="value.id" :label="value.name"/>
            </div>

            <div id="size" v-if="attribute.name === 'Size'" class="px-0 md:px-4">
              <h1 class="text-gray-900 font-semibold">{{ attribute.name }}</h1>
              <div class="grid grid-cols-2">
                <Checkbox v-for="size in model.sizeList" :key="size" :label="size"/>
              </div>
            </div>

            <div v-if="attribute.name === 'Color'" class="px-0 md:px-4">
              <h1 class="text-gray-900 font-semibold">{{ attribute.name }}</h1>
              <div  class="grid grid-cols-5">
                <Color v-for="color in model.colors" :key="color"  @click="selectColor(color.color)" :color="color.color"  :currentColor="model.details.color" :circleColor="color.class"/>
              </div>
            </div>

          </div>
        </div>
        <div class="w-10/12 px-3">
          <div>
            <div v-if="model.products.productList.length" class="grid gap-y-6 gap-x-1 grid-cols-2 md:grid-cols-4">
              <div v-on:mouseout="backImage(product.id, product.product_item.product_image)"
              v-on:mouseover="replaceImage(product.id, product.product_item.product_image)" v-for="product in model.products.productList" :key="product.id" class="cursor-pointer mx-2">
                <img :id="product.id" :src="JsonParse(product.product_item.product_image)" @error="defaultImage">
                <h1 class="text-sm py-1 px-1 text-gray-600"  style="width: 100%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ product.name }}</h1>
                <h1 class="font-semibold px-2 text-orange-500">₱ {{ formatPrice(product.product_item.price) }}</h1>
              </div>
            </div>
            <div v-else class="w-full text-center py-44">
             <h1 class="text-2xl text-gray-400 font-bold">No products to show.</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { computed, onMounted, ref, watch } from "@vue/runtime-core";
import { useRoute, useRouter } from "vue-router";
import Checkbox from "../../components/form/Checkbox.vue";
import Loading from '../../components/Loading.vue'
import Color from '../../components/icon/Color.vue'
import store from "../../store";

  const route = useRoute()
  let slug = route.params.slug
  const productsLoading = computed(() => store.state.category.loading)
  const attributes = computed(() => store.state.category.attributes)

  const model = ref({
    details : {
      color : ''
    },
    sizeList : [ 'XXS', 'XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL', '1XL', '2XL', '3XL', '4XL', '5XL'],
    colors : [
      { color : 'yellow', class : 'text-yellow-500'},  { color : 'green', class : 'text-green-500'},
      { color : 'blue', class : 'text-blue-500'},  { color : 'violet', class : 'text-violet-500'},
      { color : 'red', class : 'text-red-500'},  { color : 'orange', class : 'text-orange-500'},
      { color : 'gray', class : 'text-gray-500'},  { color : 'pink', class : 'text-pink-500'},
      { color : 'black', class : 'text-black'},  { color : 'white', class : 'text-white'},
      { color : 'brown', class : 'text-amber-600'},
    ],
    products : {
      productList : []
    },
    filterProduct : []
  })

  onMounted(() => {
    if(route.params){
      store.state.category.products = []
      store.dispatch('getCategoryProducts', route.params.slug)
      store.dispatch('getCategoryAttributes', route.params.slug)

      // const formData  = new FormData()
      // formData.append('slug', route.params.slug)
      // formData.append('key', 'Color')
      // formData.append('value', 'blue')
      // store.dispatch('getFilteredProduts', formData)
    }
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  })

  watch(() => store.state.category.products,
    (newVal, oldVal) => model.value.products.productList = newVal
  )

  const convertSlug = (slug) => {
    return slug
      .replace(/^\w+-/, "")
      .replace(/-/g, " ")
      .split(" ")
      .map(word => word.charAt(0).toUpperCase() + word.slice(1))
      .join(" ");
  }

  const formatPrice = (price) => {
    return price.toLocaleString()
  }

  const JsonParse = (imageString, index = 0) => {
    return JSON.parse(imageString)[index]
  }

  const defaultImage = (event) => {
    console.log(event);
    event.target.src = '/img/atc-default.png'
  }

  const replaceImage = (id, imageString) => {
    let img = document.getElementById(`${id}`)
    img.src = JsonParse(imageString, 1)
    console.log(JsonParse(imageString, 1));
  }

  const backImage = (id, imageString) => {
    let img = document.getElementById(`${id}`)
    img.style.transition = "all 2s";
    img.src = JsonParse(imageString, 0)
  }

  const selectCheckBox = (attribute, value, id) => {
    let checkbox = document.getElementById(`${id}`)
    if(checkbox.checked) {
      model.value.filterProduct.push({ attribute : attribute, value : value})
    } else {
      model.value.filterProduct.forEach((element, index) => {
        if(element.attribute === attribute && element.value === value) {
          model.value.filterProduct.splice(index, 1)
        }
      })
    }
  }

</script>
<style scoped>
::-webkit-scrollbar {
  width: 0.4em;
  background-color: #F5F5F5;
}

/* Webkit browsers */
::-webkit-scrollbar-thumb {
  background-color: #c2bdbd;
}

</style>


