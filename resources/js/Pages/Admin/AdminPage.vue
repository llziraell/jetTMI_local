<template>
  <v-app class="no-tailwind">
    <nav-bar :current-tab="currentTab" @select-tab="selectTab" />
    <v-main>
      <v-container fluid class="pa-6">
        <component
          @refresh-data="refreshData"
          :is="currentComponent"
          :feedbacksData="feedbacks"
          :websites="websites"
        />
      </v-container>
    </v-main>
  </v-app>
</template>

<script setup>
import { computed, defineProps, ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import FeedbackTable from '@/js/Components/AdminPanel/FeedbackTable.vue';
import NavBar from '@/js/Components/AdminPanel/NavBar.vue';

defineProps({
  feedbacks: Array,
  websites: Array,
});

const refreshData = () => {
  Inertia.reload({
    onFinish: () => {},
  });
};

const currentTab = ref('feedbacks');

const selectTab = (tab) => {
  currentTab.value = tab;
};

const currentComponent = computed(() => {
  switch (currentTab.value) {
    case 'feedbacks':
      return FeedbackTable;
    case 'users':
      return;
    default:
      return;
  }
});
</script>
