<template>
  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"
  :class="[ selected ? 'bi bi-circle-fill m-1 border border-gray-800 rounded-full cursor-pointer ring ring-gray-800 ring-offset-2' : 'bi bi-circle-fill m-1 border border-gray-800 rounded-full cursor-pointer hover:ring hover:ring-gray-800 hover:ring-offset-2']">
      <circle cx="8" cy="8" r="8" :class="circleColor"/>
  </svg>
</template>

<script setup>
defineProps({
  selected : {
      type : Boolean,
  },
  circleColor : {
      type : String
  }
})
</script>
