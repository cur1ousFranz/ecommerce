<template>
  <div>
    <nav class="py-4 flex justify-between px-4 border-b md:px-14">
      <div class="flex justify-center">
        <router-link :to="{ name : 'LandingPage' }" class="cursor-pointer">
          <img src="/img/nav-logo.png" class="w-16 mt-2" alt="" oncontextmenu="return false;">
        </router-link>
      </div>
      <div class="flex justify-center">
        <router-link :to="{ name : 'LandingPage' }" class="cursor-pointer flex">
          <h1 class="text-sm uppercase text-gray-600 hover:underline">Continue Shopping</h1>
          <span class="text-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="py-1 bi bi-caret-right-fill" viewBox="0 0 16 16">
              <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
            </svg>
          </span>
        </router-link>
      </div>
    </nav>
    <main class="max-w-screen-xl mx-auto">
      <router-view></router-view>
    </main>
  </div>
</template>

<script setup>

</script>

<style>

</style>
