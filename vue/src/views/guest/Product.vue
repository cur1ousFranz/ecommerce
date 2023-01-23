<template>
  <div>
    <section>
      <div class="flex flex-col py-6 justify-between px-12 w-full md:flex-row">
        <div class="flex space-x-2 text-gray-600" aria-label="Breadcrumb">
          <router-link :to="{ name : 'LandingPage'}" class="uppercase text-sm  hover:text-gray-900 hover:underline">Home</router-link>
          <div class="text-sm">/</div>
          <router-link :to="{ name : 'Product', params : { slug : slug}}" class="uppercase text-sm  hover:text-gray-900 hover:underline">{{ convertSlug(slug) }}</router-link>
          <div class="text-sm">/</div>
          <h1 @click="clearFilter" class="uppercase text-sm  cursor-pointer text-gray-900 hover:underline">View All</h1>
        </div>
        <div class="w-full text-gray-600 md:w-fit">
          <form @submit.prevent="searchProduct" class="flex">
            <div class="px-2 border flex justify-between w-full bg-white">
              <input v-model="model.search" type="text" placeholder="Search" class="w-full px-4 py-2 ring-white focus:ring-0 focus:outline-none">
              <span @click="clearSearch" :class="[model.search ? 'mt-3 cursor-pointer hover:text-red-500'
              : 'hidden mt-3 cursor-pointer hover:text-red-500']">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                  <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                </svg>
              </span>
            </div>
            <button class="bg-gray-800 py-2 px-2 text-white cursor-pointer" :disabled="model.search == ''">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
              </svg>
            </button>
          </form>
        </div>
      </div>
    </section>

    <section>
      <div class="my-6 space-x-4 flex">
        <AttributeLoadingSkeleton v-if="attributesLoading"/>
        <div v-else class="hidden w-2/12 max-h-screen h-screen space-y-6 shadow-sm overflow-auto md:block">
          <!-- ATTRIBUTES -->
          <div class="px-1 w-full flex justify-center lg:px-3">
            <button @click="clearFilter" v-if="model.filterProduct.length" class="border w-full border-gray-800 py-1 px-8 hover:bg-gray-800 hover:text-white">Clear All ({{ model.filterProduct.length }})</button>
          </div>
          <div v-for="attribute in attributes" :key="attribute">
            <div v-if="attribute.name !== 'Size' && attribute.name !== 'Color'" class="px-6 text-gray-700">
              <h1 class="text-gray-900 font-semibold">{{ attribute.name }}</h1>
                <Checkbox :id="value.id" @change="selectCheckBox(attribute.name, value.name, value.id)" v-for="value in sort(attribute.values)" :key="value.id" :label="value.name"/>
            </div>

            <div id="size" v-if="attribute.name === 'Size'" class="px-6">
              <h1 class="text-gray-900 font-semibold">{{ attribute.name }}</h1>
              <div class="grid grid-cols-2">
                <Checkbox :id="'size-' + size" @change="selectSizeCheckbox(size)" v-for="size in model.sizeList" :key="size" :label="size"/>
              </div>
            </div>

            <div v-if="attribute.name === 'Color'" class="px-6">
              <div class="flex justify-between">
                <h1 class="text-gray-900 font-semibold">{{ attribute.name }}</h1>
                <h1 @click="clearColorSelected" class="text-sm my-1 cursor-pointer hover:underline">Clear</h1>
              </div>
              <div  class="grid grid-cols-5 gap-1">
                <Color v-for="color in model.colors" :key="color" @click="selectColor(color.color)" :selected="color.selected" :circleColor="color.class"/>
              </div>
            </div>

          </div>
          <div class="px-6">
            <h1 class="text-gray-900 font-semibold">Price Range (PHP)</h1>
            <h1 class="text-sm">₱ {{ model.details.priceRange }}</h1>
            <input @change="selectPrice" v-model="model.details.priceRange" type="range"
            class="w-full mb-12 accent-gray-700" min="100" max="9999" step="20">
          </div>
        </div>

        <div v-if="productsLoading" class="w-full md:w-10/12 px-6">
          <ProductLoadingSkeleton />
        </div>

        <div v-else class="w-full px-6 md:w-10/12">
          <div v-if="model.products.productList.length" class="grid gap-y-6 gap-x-1 grid-cols-3 md:grid-cols-4">
            <router-link :to="{ name : 'ProductShow', params : { slug : slug, name : productNameSlug(product.name), sku : product.product_item.sku }}" @mouseleave="replaceImage(product.id, product.product_item.product_image, 0)"
            @mouseover="replaceImage(product.id, product.product_item.product_image, 1)" v-for="product in model.products.productList" :key="product.id" class="cursor-pointer mx-2 relative">
              <img :id="'img-default-'+ product.id" src="/img/atc-default.png">
              <div v-if="product.product_item.sale_price" class="absolute mt-2 px-1 text-sm bg-gray-800 text-white">
                -{{ product.product_item.sale_price }}%
              </div>
              <img :id="'img-'+ product.id" :src="JsonParse(product.product_item.product_image)" @load="defaultImage(product.id)" class="hidden object-contain">
              <h1 class="text-sm py-1 px-1 text-gray-600" style="width: 100%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ product.name }}</h1>
              <div class="flex justify-start">
                <h1 class="font-semibold px-2 text-orange-500 text-sm">
                  ₱ {{ formatPrice(product.product_item.price, product.product_item.sale_price) }}
                </h1>
                <h1 v-if="product.product_item.sale_price" class="font-semibold text-gray-400 line-through text-xs">₱ {{ formatOriginalPrice(product.product_item.price) }}</h1>
              </div>
            </router-link>
          </div>
          <div v-if="!model.products.productList.length && model.products.productLoaded" class="py-32">
            <div class="flex justify-center">
              <img src="/img/empty-cart.png" class="w-12 md:w-24" alt="">
            </div>
            <h1 class="text-lg text-center text-gray-400 font-bold md:text-2xl ">No products to show</h1>
            <div class="flex justify-center space-x-2 mt-1 cursor-pointer underline" @click="back()">
              <span class="mt-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
              </svg>
              </span>
              <h1 class="text-sm text-gray-800 font-bold md:text-lg">Get back</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { computed, onMounted, onUnmounted, ref, watch } from "@vue/runtime-core";
import { useRoute, useRouter } from "vue-router";
import Checkbox from "../../components/form/Checkbox.vue";
import Loading from '../../components/Loading.vue'
import Color from '../../components/icon/Color.vue'
import ProductLoadingSkeleton from '../../components/ProductLoadingSkeleton.vue'
import AttributeLoadingSkeleton from '../../components/AttributeLoadingSkeleton.vue'
import store from "../../store";

  const route = useRoute()
  let slug = route.params.slug
  const model = ref({
    details : {
      color : '',
      priceRange : 9999
    },
    sizeList : [ 'XXS', 'XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL', '1XL', '2XL', '3XL', '4XL', '5XL'],
    colors : [
      { color : 'yellow', class : 'text-yellow-500', selected : false},  { color : 'green', class : 'text-green-500', selected : false},
      { color : 'blue', class : 'text-blue-500', selected : false},  { color : 'violet', class : 'text-violet-500', selected : false},
      { color : 'red', class : 'text-red-500', selected : false},  { color : 'orange', class : 'text-orange-500', selected : false},
      { color : 'gray', class : 'text-gray-500', selected : false},  { color : 'pink', class : 'text-pink-500', selected : false},
      { color : 'black', class : 'text-black', selected : false},  { color : 'white', class : 'text-white', selected : false},
      { color : 'brown', class : 'text-amber-600', selected : false},
    ],
    products : {
      productList : [],
      productLoaded : false
    },
    filterProduct : [],
    search : ''
  })

  const attributesLoading = computed(() => store.state.category.attributesLoading)
  const productsLoading = computed(() => store.state.category.loading)
  const attributes = computed(() => store.state.category.attributes)

  onMounted(async () => {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
    if(route.params){
      await store.dispatch('getCategoryProducts', route.params.slug)
      model.value.products.productLoaded = true
      store.dispatch('getCategoryAttributes', route.params.slug)
    }
  })

  onUnmounted(() => {
    store.state.category.products = []
    store.state.category.attributes = []
    store.state.category.attributesLoading = true
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

  const productNameSlug = (name) => {
    return name
    .replace(/[^a-zA-Z0-9]+/g, '-')
    .replace(/^-+|-+$/g, '');
  }

  const formatPrice = (price, sale) => {
    let percentage = sale/100
    let newPrice = price - (price * percentage)
    return Math.ceil(newPrice).toLocaleString()
  }

  const formatOriginalPrice = (price, sale) => {
    return price.toLocaleString()
  }

  const JsonParse = (imageString, index = 0) => JSON.parse(imageString)[index]
  const sort = (object) => {
    object.sort((a, b) => a.name.localeCompare(b.name));
    return object
  }

  const replaceImage = (id, imageString, index) => {
    let img = document.getElementById(`img-${id}`)
    img.src = JsonParse(imageString, index)
  }

  const defaultImage = (id) => {
    let imgDefault = document.getElementById(`img-default-${id}`)
    let img = document.getElementById(`img-${id}`)
    imgDefault.classList.add('hidden')
    img.classList.remove('hidden')
  }

  const selectPrice = async () => {
    const formData = new FormData()

    if(model.value.filterProduct.length) {
      formData.append('filters', JSON.stringify(model.value.filterProduct))
    }

    formData.append('slug', route.params.slug)
    formData.append('price_range', model.value.details.priceRange)
    formData.append('_method', 'get')
    model.value.products.productLoaded = false
    await store.dispatch('getFilteredProduts', formData)
    model.value.products.productLoaded = true
  }

  const selectCheckBox = (attribute, value, id) => {
    let checkbox = document.getElementById(`${id}`)
    filterProduct(attribute, value, checkbox.checked)
  }

  const selectSizeCheckbox = (name) => {
    let sizeCheckbox = document.getElementById(`size-${name}`)
    filterProduct('Size', name, sizeCheckbox.checked)
  }

  const clearColorSelected = () => {
    model.value.colors.forEach(obj => obj.selected = false)
    const updatedArr = model.value.filterProduct.filter(obj => obj.attribute !== 'Color');
    model.value.filterProduct = updatedArr
    searchFilterProduct()
  }

  const selectColor = (color) => {
    model.value.colors.forEach(element => {
      if(element.color == color) {
        if(!element.selected) {
          filterProduct('Color', color, true)
        } else {
          filterProduct('Color', color, false)
        }
        element.selected = !element.selected
      }
    })
  }

  const filterProduct = (attribute, value, checked) => {
    model.value.search = ''
    if(checked) {
      model.value.filterProduct.push({ attribute : attribute, value : value})
    } else {
      model.value.filterProduct.forEach((element, index) => {
        if(element.attribute === attribute && element.value === value) {
          model.value.filterProduct.splice(index, 1)
        }
      })
    }
    searchFilterProduct()
  }

  const searchFilterProduct = async () => {
    if(model.value.filterProduct.length) {
      const formData = new FormData()
      formData.append('slug', route.params.slug)
      formData.append('filters', JSON.stringify(model.value.filterProduct))
      formData.append('price_range', model.value.details.priceRange)
      formData.append('_method', 'get')
      model.value.products.productLoaded = false
      await store.dispatch('getFilteredProduts', formData)
      model.value.products.productLoaded = true
    } else {
      clearFilter()
    }
  }

  const clearFilter = async () => {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked')
    checkboxes.forEach(checkbox => checkbox.checked = false)
    model.value.colors.forEach(obj => obj.selected = false)
    model.value.filterProduct = []
    model.value.products.productLoaded = false
    await store.dispatch('getCategoryProducts', route.params.slug)
    model.value.products.productLoaded = true
  }

  const searchProduct = () => {
    clearFilter()
    store.state.category.products = []
    model.value.products.productLoaded = false
    if(model.value.search) {
      const formData = new FormData()
      formData.append('search', model.value.search)
      formData.append('slug', route.params.slug)
      store.dispatch('searchProduct', formData)
    } else {
      store.dispatch('getCategoryProducts', route.params.slug)
    }
    model.value.products.productLoaded = true
  }

  const clearSearch = () => {
    model.value.search = ''
    store.dispatch('getCategoryProducts', route.params.slug)
  }

  const back = () => {
    history.back()
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


