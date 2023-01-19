<template>
  <div class="flex justify-center space-x-2">
    <div class="bg-gray-700 rounded-full h-4 w-4 animation-dots"></div>
    <div class="bg-gray-700 rounded-full h-4 w-4 animation-dots"></div>
    <div class="bg-gray-700 rounded-full h-4 w-4 animation-dots"></div>
  </div>
</template>

<script>
export default {

}
</script>

<style scoped>

@keyframes dots {
  50% {
    opacity: 0;
  }
}

.animation-dots {
  animation: dots 1s ease-in-out infinite;
}

.animation-dots:nth-child(1) {
  animation-delay: 0.2s;
}

.animation-dots:nth-child(2) {
  animation-delay: 0.4s;
}

.animation-dots:nth-child(3) {
  animation-delay: 0.6s;
}
</style>
