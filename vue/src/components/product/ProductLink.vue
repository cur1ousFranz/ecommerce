<template>
  <router-link :to="{ name : 'Product', params : { slug : slug}}" class="flex cursor-pointer py-2 justify-center flex-col border shadow-lg md:flex-row hover:shadow-xl">
    <img :src="icon" alt="" class="w-20" oncontextmenu="return false;">
    <p class="px-4 text-center text-sm font-semibold overflow-hidden whitespace-normal text-gray-700 md:mt-8">{{ sub }}</p>
  </router-link>
</template>

<script setup>
import { computed, onMounted } from "@vue/runtime-core"
import { useRouter } from "vue-router"
import store from "../../store"

  const router = useRouter()
  const props = defineProps({
    sub : {
      type : String,
      default : ""
    },
    slug : {
      type : String,
      default : ""
    },
    icon : {
      type : String
    }
  })

</script>
