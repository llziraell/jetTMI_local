<script setup>
import ApplicationLogo from '@/js/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import '@/css/app.css';
</script>

<template>
  <div
    class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0 dark:bg-gray-900"
  >
    <div class="d-flex align-center flex-row">
      <Link href="/">
        <ApplicationLogo class="fill-current text-gray-500" />
      </Link>
      <div class="site__title">JetTMI</div>
    </div>

    <div
      class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg dark:bg-gray-800"
    >
      <slot />
    </div>
  </div>
</template>

<style scoped lang="scss">
.site__title {
  font-weight: bolder;
  font-size: 40px;
}
</style>
