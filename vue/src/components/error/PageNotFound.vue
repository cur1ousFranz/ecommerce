<template>
  <div>
    <section>
      <div class="w-full py-24">
        <div class="flex justify-center">
          <img src="/img/page-404.png" class="w-44" alt="404" oncontextmenu="return false;">
        </div>
        <h1 class="text-lg text-center text-gray-500">Ooops. Page not found</h1>
        <div class="flex justify-center my-6">
          <div @click="goHome()" class="cursor-pointer px-6 py-1 border border-gray-800 text-gray-800 hover:bg-gray-800 hover:text-white">
            BACK TO HOME
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { useRouter } from "vue-router"
  const router = useRouter()
  const goHome = () => router.push({ name : 'LandingPage'})
</script>
