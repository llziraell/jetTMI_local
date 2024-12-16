<template>
  <v-app>
    <AppHeader />
    <div class="wrapper">
      <main class="page">
        <Landing />
      </main>
    </div>
    <AppFooter />
  </v-app>
</template>

<script setup>
import '@/css/index.scss';
import AppHeader from '@/js/Components/Landing/AppHeader.vue';
import AppFooter from '@/js/Components/Landing/AppFooter.vue';
import Landing from '@/js/Pages/Landing/Landing.vue';
</script>
