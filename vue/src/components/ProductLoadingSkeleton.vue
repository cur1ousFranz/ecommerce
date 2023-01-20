<template>
  <div class="w-10/12 lg:w-10/12 px-4">
    <div class="grid gap-y-6 gap-x-4 px-4 grid-cols-3 md:grid-cols-4">
      <div class="space-y-2" v-for="count in productCount" :key="count">
        <div class="pulse bg-gray-200 pt-72 w-full"></div>
        <div class="pulse bg-gray-200 pt-3 w-full"></div>
        <div class="pulse bg-gray-200 pt-3 w-1/3"></div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "@vue/reactivity";

  const productCount = ref(12)

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
