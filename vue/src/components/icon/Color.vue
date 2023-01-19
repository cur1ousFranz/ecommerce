<template>
  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"
  :class="[ currentColor === color ? 'bi bi-circle-fill m-1 border border-gray-800 rounded-full cursor-pointer ring ring-gray-500 ring-offset-2' : 'bi bi-circle-fill m-1 border border-gray-800 rounded-full cursor-pointer hover:ring hover:ring-gray-500 hover:ring-offset-2']">
      <circle cx="8" cy="8" r="8" :class="circleColor"/>
  </svg>
</template>

<script setup>
defineProps({
  color : {
      type: String,
  },
  currentColor : {
      type : String,
  },
  circleColor : {
      type : String
  }
})
</script>
