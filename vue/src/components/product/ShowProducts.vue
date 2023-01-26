<template>
  <div v-if="products.length" class="grid gap-y-6 gap-x-1 grid-cols-3 md:grid-cols-4">
    <router-link :to="{ name : 'ProductShow', params : { slug : slug !== '' ? slug : product.categories[0].slug, name : productNameSlug(product.name), sku : product.product_item.sku }}" @mouseover="replaceImage(product, 1)" @mouseleave="replaceImage(product, 0)" v-for="product in products" :key="product.id" class="cursor-pointer mx-2 relative">
      <img :id="'img-default-'+ product.id" src="/img/atc-default.png">
      <div v-if="product.product_item.sale_price" class="absolute mt-2 px-1 text-sm bg-gray-800 text-white">
        -{{ product.product_item.sale_price }}%
      </div>
      <img :id="'img-'+ product.id" :src="JSON.parse(product.product_item.product_image)[0]" @load="defaultImage(product.id)" class="hidden object-contain">
      <h1 class="text-sm py-1 px-1 text-gray-600" style="width: 100%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ product.name }}</h1>
      <div class="flex justify-start">
        <h1 class="font-semibold px-2 text-orange-500 text-sm">
          ₱ {{ formatPrice(product.product_item.price, product.product_item.sale_price) }}
        </h1>
        <h1 v-if="product.product_item.sale_price" class="font-semibold text-gray-400 line-through text-xs">₱ {{ formatOriginalPrice(product.product_item.price) }}</h1>
      </div>
    </router-link>
  </div>
</template>

<script setup>
  defineProps({
    products : {
      type : Array,
      default : []
    },
    slug : {
      type : String,
      default : ''
    }
  })

  const productNameSlug = (name) => {
    return name
    .replace(/[^a-zA-Z0-9]+/g, '-')
    .replace(/^-+|-+$/g, '');
  }

  const replaceImage = (product, index) => {
    let img = document.getElementById(`img-${product.id}`)
    img.src = JSON.parse(product.product_item.product_image)[index]
  }

  const defaultImage = (id) => {
    let imgDefault = document.getElementById(`img-default-${id}`)
    let img = document.getElementById(`img-${id}`)
    imgDefault.classList.add('hidden')
    img.classList.remove('hidden')
  }

  const formatPrice = (price, sale) => {
    let percentage = sale/100
    let newPrice = price - (price * percentage)
    return Math.ceil(newPrice).toLocaleString()
  }

  const formatOriginalPrice = (price, sale) => price.toLocaleString()

</script>

<style>

</style>
