<template>
  <div>
    <section>
      <div class="w-10/12 mx-auto py-6 max-h-screen">
        <div class="flex space-x-1 text-sm text-gray-500">
          <div class="pulse bg-gray-200 pt-3 w-full md:w-1/3"></div>
        </div>
        <div class="flex flex-col md:flex-row space-x-2">
          <div  class="w-full my-3 flex justify-between mx-auto space-x-1 max-h-screen md:w-7/12 ">
            <div class="hidden w-1/12 space-y-1 md:block">
              <!-- Small images -->
              <div class="pulse bg-gray-200 pt-16" v-for="count in smallImageCount" :key="count"></div>
            </div>
            <div class="w-full h-full md:pr-24 md:w-11/12">
              <div>
                <!-- Big image -->
                <div class="pulse bg-gray-200 py-72 w-full"></div>
              </div>
              <div class="flex space-x-2 overflow-auto my-2 max-w-full md:hidden">
                <!-- Small images in small device -->
                <div class="pulse bg-gray-200 pt-14 w-full" v-for="count in smallImageCount" :key="count"></div>
              </div>
            </div>
          </div>
          <div class="w-12/12 my-12 pr-0 max-h-screen md:overflow-auto md:w-5/12 md:my-0 md:pr-12">
            <!-- Product Name -->
            <div class="pulse bg-gray-200 pt-3 mt-4 w-full"></div>
            <!-- SKU -->
            <div class="pulse bg-gray-200 pt-3 mt-4 w-2/3"></div>
            <div class="text-2xl py-3 my-1 font-semibold font-monospace flex justify-start space-x-1 text-orange-500">
              <!-- Price / Old Price / Discount-->
              <div class="pulse bg-gray-200 pt-4 mt-4 w-1/6"></div>
              <div class="pulse bg-gray-200 pt-4 mt-4 w-1/6"></div>
              <div class="pulse bg-gray-200 pt-4 mt-4 w-1/6"></div>
            </div>
            <!-- Available Size caption -->
            <div class="pulse bg-gray-200 pt-6 mt-12 w-1/2"></div>
            <div class="grid grid-cols-5 gap-2 my-3">
             <!-- Sizes buttons -->
             <div class="pulse bg-gray-200 pt-5 mt-3 w-2/3"></div>
             <div class="pulse bg-gray-200 pt-5 mt-3 w-2/3"></div>
             <div class="pulse bg-gray-200 pt-5 mt-3 w-2/3"></div>
             <div class="pulse bg-gray-200 pt-5 mt-3 w-2/3"></div>
            </div>
            <!-- ADD TO CART BUTTON -->
            <div class="hidden pulse bg-gray-200 pt-12 mt-6 w-full md:hidden"></div>
            <div class="my-4 p-6 space-y-4">
              <div class="pulse bg-gray-200 pt-4 w-2/3"></div>
              <div class="pulse bg-gray-200 pt-4 w-full"></div>
              <div class="pulse bg-gray-200 pt-4 w-2/3"></div>
              <div class="pulse bg-gray-200 pt-4 w-1/4"></div>
            </div>
            <div class="my-6 max-h-screen overflow-y-auto">
              <!-- Description caption -->
              <div class="pulse bg-gray-200 pt-6 w-1/2"></div>
              <div class="mt-2 mb-14">
                <!-- Descriptions -->
                <div class="flex text-sm mt-4 mb-1 space-x-6" v-for="count in smallImageCount" :key="count">
                  <div class="pulse bg-gray-200 pt-4 w-1/2"></div>
                  <div class="pulse bg-gray-200 pt-4 w-1/2"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
  const smallImageCount = 5
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
