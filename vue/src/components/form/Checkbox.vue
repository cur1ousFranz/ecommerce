<template>
  <div class="my-2 flex space-x-2 text-xs items-center">
    <input :id="id" type="checkbox" class="text-gray-900 text-sm accent-gray-900 focus:ring-0" :checked="check">
    <label class="relative flex items-center">{{ label }}</label>
  </div>
</template>

<script setup>
  defineProps({
    label : {
      type : String,
      default : ""
    },
    check : {
      type : Boolean,
      default : false
    },
    id : {
      type : [Number, String],
    }
  })
</script>
