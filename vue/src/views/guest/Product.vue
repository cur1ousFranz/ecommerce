<template>
  <div>
    <section>
      <div class="px-12 flex flex-col justify-between bg-gray-50 md:px-24 md:flex-row">
        <div class="py-6 flex space-x-2 text-gray-600" aria-label="Breadcrumb">
          <router-link :to="{ name : 'LandingPage'}" class="hover:text-gray-900 hover:underline">Home</router-link>
          <div>/</div>
          <router-link :to="{ name : 'Product', params : { slug : slug}}" class="hover:text-gray-900 hover:underline">{{ convertSlug(slug) }}</router-link>
        </div>
        <div class="w-full py-6 flex text-gray-600 md:w-fit">
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
      <div class="my-6 space-x-4 flex">
        <AttributeLoadingSkeleton v-if="attributesLoading"/>
        <div v-else class="hidden max-w-2/12 max-h-screen space-y-6 overflow-auto md:block">
          <!-- ATTRIBUTES -->
          <div class="px-1 w-full flex justify-center lg:px-3 ">
            <button @click="clearFilter" v-if="model.filterProduct.length" class="border w-full border-gray-800 py-1 px-8 hover:bg-gray-800 hover:text-white">Clear All ({{ model.filterProduct.length }})</button>
          </div>
          <div v-for="attribute in attributes" :key="attribute">
            <div v-if="attribute.name !== 'Size' && attribute.name !== 'Color'" class="px-0 text-gray-700 md:pr-4">
              <h1 class="text-gray-900 font-semibold">{{ attribute.name }}</h1>
                <Checkbox :id="value.id" @change="selectCheckBox(attribute.name, value.name, value.id)" v-for="value in sort(attribute.values)" :key="value.id" :label="value.name"/>
            </div>

            <div id="size" v-if="attribute.name === 'Size'" class="px-0 md:pr-4">
              <h1 class="text-gray-900 font-semibold">{{ attribute.name }}</h1>
              <div class="grid grid-cols-2">
                <Checkbox :id="'size-' + size" @change="selectSizeCheckbox(size)" v-for="size in model.sizeList" :key="size" :label="size"/>
              </div>
            </div>

            <div v-if="attribute.name === 'Color'" class="px-0 md:pr-4">
              <h1 class="text-gray-900 font-semibold">{{ attribute.name }}</h1>
              <div  class="grid grid-cols-5 gap-1">
                <Color v-for="color in model.colors" :key="color" @click="selectColor(color.color)" :selected="color.selected" :circleColor="color.class"/>
              </div>
            </div>

          </div>
        </div>

        <ProductLoadingSkeleton v-if="productsLoading"/>
        <div v-else class="w-12/12 px-3 md:w-10/12">
          <div v-if="model.products.productList.length" class="grid gap-y-6 gap-x-1 grid-cols-3 md:grid-cols-4">
            <div @mouseleave="replaceImage(product.id, product.product_item.product_image, 0)"
            @mouseover="replaceImage(product.id, product.product_item.product_image, 1)" v-for="product in model.products.productList" :key="product.id" class="cursor-pointer mx-2 relative">
              <img :id="'img-default-'+ product.id" src="/img/atc-default.png">
              <img :id="'img-'+ product.id" :src="JsonParse(product.product_item.product_image)" @load="defaultImage(product.id)" class="hidden object-fill abosulute">
              <h1 class="text-sm py-1 px-1 text-gray-600"  style="width: 100%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ product.name }}</h1>
              <h1 class="font-semibold px-2 text-orange-500 text-sm">₱ {{ formatPrice(product.product_item.price) }}</h1>
            </div>
          </div>
          <div v-if="!model.products.productList.length && model.products.productLoaded" class="w-full text-center py-44">
            <div class="flex justify-center">
              <img src="/img/empty-cart.png" class="w-24" alt="">
            </div>
            <h1 class="text-2xl text-gray-400 font-bold">No products to show</h1>
            <div class="flex justify-center space-x-2 mt-1 cursor-pointer underline" @click="back()">
              <span class="mt-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
              </svg>
              </span>
              <h1 class="text-lg text-gray-800 font-bold">Get back</h1>
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
      color : ''
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
    filterProduct : []
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

  const formatPrice = (price) => price.toLocaleString()
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

  const selectCheckBox = (attribute, value, id) => {
    let checkbox = document.getElementById(`${id}`)
    filterProduct(attribute, value, checkbox.checked)
  }

  const selectSizeCheckbox = (name) => {
    let sizeCheckbox = document.getElementById(`size-${name}`)
    filterProduct('Size', name, sizeCheckbox.checked)
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

  const filterProduct = async (attribute, value, checked) => {
    if(checked) {
      model.value.filterProduct.push({ attribute : attribute, value : value})
    } else {
      model.value.filterProduct.forEach((element, index) => {
        if(element.attribute === attribute && element.value === value) {
          model.value.filterProduct.splice(index, 1)
        }
      })
    }

    if(model.value.filterProduct.length) {
      const formData = new FormData()
      formData.append('slug', route.params.slug)
      formData.append('filters', JSON.stringify(model.value.filterProduct))
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


