<template>
  <div>
    <section>
      <ProductShowLoadingSkeleton v-if="!model.products.productLoaded"/>
      <div v-else class="w-10/12 mx-auto py-6 max-h-screen">
        <div v-if="product && model.imageList.length">
          <div class="flex space-x-1 text-sm text-gray-500">
            <router-link :to="{ name : 'LandingPage'}" class="hover:text-gray-900 hover:underline">
              Home
            </router-link>
            <div>/</div>
            <router-link :to="{ name : 'Product', params : { slug : slug}}" class="hover:text-gray-900 hover:underline">
              {{ convertSlug(slug) }}
            </router-link>
            <div>/</div>
            <h1 style="width: 100%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
              {{ removeSlug(productName) }}
            </h1>
          </div>
          <div class="flex flex-col  md:flex-row space-x-2">
            <div  class="w-12/12 my-3 flex justify-between mx-auto space-x-1 max-h-screen md:w-7/12 ">
              <div class="hidden w-1/12 space-y-1 md:block">
                <img @click="clickImage(index, model.imageList )" v-for="(image, index) in JsonParse(product.product_item.product_image)" :key="image" :src="image" :alt="image" :class="[model.images.currentImageIndex  === index ? 'h-54 w-full cursor-pointer border border-black p-1' : 'h-54 w-full cursor-pointer p-1']">
              </div>
              <div class="w-12/12 h-full md:pr-24 md:w-12/12">
                <div class="relative">
                  <img id="big-image" :src="model.imageList[model.images.currentImageIndex]" class="max-h-screen object-contain" alt=""/>
                    <a @click="slideImage(false)" class="prev p-2 ml-2 text-gray-800 bg-white">❮</a>
                    <a @click="slideImage(true)" class="next p-2 mr-2 text-gray-800 bg-white">❯</a>
                </div>
                <div class="flex space-x-2 overflow-auto my-2 max-w-full md:hidden">
                  <img @click="clickImage(index, model.imageList )" v-for="(image, index) in JsonParse(product.product_item.product_image)" :key="image" :src="image" :alt="image" :class="[model.images.currentImageIndex  === index ? 'h-16 w-14 cursor-pointer border border-black p-1' : 'h-16 w-14 cursor-pointer p-1']">
                </div>
              </div>
            </div>
            <div class="relative w-12/12 my-4 pr-0 max-h-screen md:overflow-auto md:w-5/12 md:my-0 md:pr-12">
              <h1 class="text-gray-800 mt-2">{{ product.name }}</h1>
              <h1 class="text-sm text-gray-500">SKU: {{ product.product_item.sku }}</h1>
              <div class="text-lg py-3 my-1 font-semibold font-monospace flex justify-start space-x-1 text-orange-500 md:text-2xl">
                <h1 class="font-bold px-2 text-orange-500">
                  ₱{{ formatPrice(product.product_item.price, product.product_item.sale_price) }}
                </h1>
                <h1 v-if="product.product_item.sale_price" class="font-semibold px-1 text-gray-400 line-through md:text-lg">₱{{ formatOriginalPrice(product.product_item.price) }}</h1>
                <div v-if="product.product_item.sale_price" class="my-2 px-2 text-xs bg-gray-800 text-white md:text-sm">
                  -{{ product.product_item.sale_price }}%
                </div>
              </div>
              <h1 class="px-2 w-fit bg-gray-800 text-white">Only {{ product.product_item.qty_stock }} left</h1>
              <div class="mt-4 flex space-x-4">
                <h1 class="text-lg font-semibold">Available Size</h1>
                <p v-if="model.errors.size" class="text-sm mt-1 text-red-500">Please select size</p>
              </div>
              <div id="size-container" class="grid grid-cols-4 gap-2 my-3 md:grid-cols-5">
                <div v-for="size in model.sizes" :key="size">
                  <h1 @click="selectSize(size.name)" :class="model.selectedSize === size.name ? 'cursor-pointer border-2 px-5 w-fit rounded-full border-gray-800' : 'cursor-pointer border px-5 w-fit rounded-full border-gray-700 hover:border-gray-800'">
                    {{ size.name }}
                  </h1>
                </div>
              </div>
              <div @click="addToCart(product.id)" class="hidden w-full text-lg cursor-pointer mt-6 py-2 text-center space-x-2 bg-gray-800 text-white hover:bg-gray-900 md:flex md:justify-center">
                <span class="inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                  </svg>
                </span>
                <h1 id="add-to-cart" class="font-bold">ADD TO CART</h1>
              </div>

              <div class="my-8 p-6 space-y-6 bg-gray-100">
                <div class="flex space-x-4">
                  <span class="inline-block font-bold text-green-800">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                      <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                    </svg>
                  </span>
                  <div class="space-y-1">
                    <h1 class="font-semibold text-gray-800">Free Shipping</h1>
                    <h1 class="text-sm text-gray-500">Free standard shipping on orders over ₱249</h1>
                  </div>
                </div>
                <div class="flex space-x-4">
                  <span class="inline-block font-bold text-green-800">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-shield-check" viewBox="0 0 16 16">
                        <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z"/>
                        <path d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                      </svg>
                  </span>
                  <div class="space-y-1">
                    <h1 class="font-semibold text-gray-800">Return Policy</h1>
                    <h1 class="text-sm underline text-gray-500">Learn More</h1>
                  </div>
                </div>
              </div>
              <div class="my-6 max-h-screen overflow-y-auto">
                <h1 class="text-lg font-semibold overflow-y-auto">Description</h1>
                <div class="mt-2 mb-14">
                  <div v-for="(value, key, index) in model.description" :key="index">
                    <div v-if="key !== 'Size' && key !== 'Color'" class="flex text-sm mb-1 text-gray-700">
                      <div class="w-1/2">
                        <h1>{{ key }}:</h1>
                      </div>
                      <div class="w-1/2">
                        <h1>{{ value }}</h1>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-if="model.errors.product && model.products.productLoaded" class="w-full py-24">
        <div class="flex justify-center">
          <img src="/img/product-404.png" alt="" class="w-24" oncontextmenu="return false;">
        </div>
        <h1 class="text-center text-sm text-gray-500">
          Sorry, we couldn't find the product. <br>  Please go back to the previous page and view other products.
        </h1>
        <div class="flex justify-center my-3">
          <div @click="goBack()" class="cursor-pointer px-6 py-1 border border-gray-800 text-gray-800  hover:bg-gray-800 hover:text-white">
            GO BACK
          </div>
        </div>
      </div>
      <div v-if="!model.errors.product && model.products.productLoaded" @click="addToCart(product.id)" class="fixed px-6 bottom-0 w-full">
        <div class="w-full text-lg cursor-pointer mt-6 py-2 text-center bg-gray-800 text-white hover:bg-gray-900 md:hidden">
          <span class="inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
          </span> ADD TO CART
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { computed, onMounted, ref, watch } from "@vue/runtime-core";
import { useRoute, useRouter } from "vue-router";
import ProductShowLoadingSkeleton from "../../components/ProductShowLoadingSkeleton.vue";
import store from "../../store";

  const route = useRoute()
  const router = useRouter()
  const slug = route.params.slug
  const sku = ref()
  const productName = route.params.name
  const model = ref({
    products : {
      productLoaded : false
    },
    images : {
      currentImageIndex : 0
    },
    sizes : [],
    selectedSize : '',
    description : [],
    imageList : [],
    errors : {
      size : false,
      product : false
    }
  })

  const product = computed(() => store.state.products.product)
  const productLoading = computed(() => store.state.products.loading)

  onMounted(async() => {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
    sku.value = route.params.sku
    getProduct()
    model.value.slides = document.querySelectorAll(".mySlides");
  })

  watch(() => route.params.sku, (newSku, oldSku) => {
    sku.value = newSku
    getProduct()
  })

  const getProduct = async () => {
    if(sku.value){
      try {
        const formData = new FormData()
        formData.append('sku', sku.value)
        formData.append('_method', 'get')
        await store.dispatch('getProduct', formData)
        model.value.products.productLoaded = true
        model.value.sizes = JSON.parse(product.value.description).Size
        model.value.sizes = model.value.sizes.filter(obj => obj.count !== 0)
        model.value.description = JSON.parse(product.value.description)
        model.value.imageList = JSON.parse(product.value.product_item.product_image)
      } catch (error) {
        model.value.products.productLoaded = true
        if(error.response.status === 404) {
          model.value.errors.product = true
        }
      }
    }
  }

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
  const parse = (string) => {
    model.value.description = JSON.parse(string)
    return model.value.description
  }
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

  const formatOriginalPrice = (price, sale) => price.toLocaleString()

  const slideImage = (isNext) => {
    let currentIndex = model.value.images.currentImageIndex
    let images = model.value.imageList.length - 1
    if(isNext) {
      if(images === currentIndex) {
        model.value.images.currentImageIndex = 0
      } else {
        model.value.images.currentImageIndex = currentIndex  + 1
      }
    } else {
      if(currentIndex == 0) {
        model.value.images.currentImageIndex = images
      } else {
        model.value.images.currentImageIndex = currentIndex  - 1
      }
    }
  }

  const selectSize = (size) => {
    if(model.value.selectedSize === size) {
      model.value.selectedSize = ''
    } else {
      model.value.selectedSize = size
    }
  }

  const addToCart = async (productId) => {
    model.value.errors.size = false
    if(!model.value.selectedSize) {
      model.value.errors.size = true
      const div = document.getElementById("size-container");
      div.classList.add("shake")
      setTimeout(() => {
        div.classList.remove("shake")
      },1000)

    } else {
      if(!store.state.user.token) {
        const currentUrl = router.currentRoute.value.fullPath.slice(1)
        router.push({ name : 'Signin', params : { url : currentUrl}})
      } else {
        // TODO:: ADD TO CART
        const button = document.getElementById('add-to-cart')
        const formData = new FormData()
        formData.append('product_id', productId)
        formData.append('size', model.value.selectedSize)
        await store.dispatch('addToCartProduct', formData)
        button.innerHTML = 'ADDED!'
        setTimeout(() => {
          button.innerHTML = 'ADD TO CART'
        }, 1000)
      }
    }
  }

  const goBack = () => history.back()

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

.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  margin-top: -22px;
  transition: 0.6s ease;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

@keyframes shake {
  0% { transform: translate(1px, 1px) rotate(0deg); }
  10% { transform: translate(-1px, -2px) rotate(-1deg); }
  20% { transform: translate(-3px, 0px) rotate(1deg); }
  30% { transform: translate(3px, 2px) rotate(0deg); }
  40% { transform: translate(1px, -1px) rotate(1deg); }
  50% { transform: translate(-1px, 2px) rotate(-1deg); }
  60% { transform: translate(-3px, 1px) rotate(0deg); }
  70% { transform: translate(3px, 1px) rotate(-1deg); }
  80% { transform: translate(-1px, -1px) rotate(1deg); }
  90% { transform: translate(1px, 2px) rotate(0deg); }
  100% { transform: translate(1px, -2px) rotate(-1deg); }
}

.shake {
  animation-name: shake;
  animation-duration: 1s;
}

</style>

