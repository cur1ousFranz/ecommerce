<template>
  <div class="hidden w-2/12 max-h-screen h-screen space-y-6 overflow-auto md:block">
    <div class="px-6 w-full flex justify-center">
    </div>
    <div class="space-y-3 px-6" v-for="count in attributeCount" :key="count">
      <div class="pulse bg-gray-200 w-3/4 pt-4"></div>
      <div class="flex justify-start space-x-2">
        <div class="pulse bg-gray-200 w-4 pt-2"></div>
        <div class="pulse bg-gray-200 w-1/2 pt-3"></div>
      </div>
      <div class="flex justify-start space-x-2">
        <div class="pulse bg-gray-200 w-4 pt-2"></div>
        <div class="pulse bg-gray-200 w-1/2 pt-3"></div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "@vue/reactivity";

  const attributeCount = ref(8)

</script>

<style scoped>
@keyframes pulse {
  0% {
    background-color: #eee;
  }
  50% {
    background-color: #eaeaea;
  }
  100% {
    background-color: #eee;
  }
}

.pulse {
  animation: pulse 1s infinite;
}
</style>
