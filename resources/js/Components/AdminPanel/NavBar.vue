<template>
  <v-app-bar color="primary" prominent>
    <v-app-bar-nav-icon
      variant="text"
      @click.stop="drawer = !drawer"
    />
    <v-toolbar-title>JetTMI Admin</v-toolbar-title>
    <v-spacer></v-spacer>
    <template v-if="!mobile"></template>
    <a
      :href="route('logout')"
      methods="get"
      class="mr-1"
    >
      <v-btn
        icon="mdi-logout"
        variant="text"
        color="white"
      />
    </a>
  </v-app-bar>
  <v-navigation-drawer
    v-if="!mobile"
    rail
    v-model="drawer"
    permanent
    expand-on-hover
  >
    <v-list density="compact" nav>
      <v-list-item
        title="Отзывы"
        prepend-icon="mdi-comment-text"
        :class="{ 'v-list-item--active': isActive('feedbacks') }"
        @click="selectTab('feedbacks')"
      />
      <v-list-item
        title="Пользователи"
        prepend-icon="mdi-account-group-outline"
        :class="{ 'v-list-item--active': isActive('users') }"
        @click="selectTab('users')"
      />
    </v-list>
  </v-navigation-drawer>
  <v-navigation-drawer v-else v-model="drawer">
    <v-list density="compact" nav>
      <v-list-item
        title="Отзывы"
        prepend-icon="mdi-comment-text"
        :class="{ 'v-list-item--active': isActive('feedbacks') }"
        @click="selectTab('feedbacks')"
      />
      <v-list-item
        title="Пользователи"
        prepend-icon="mdi-account-group-outline"
        :class="{ 'v-list-item--active': isActive('users') }"
        @click="selectTab('users')"
      />
    </v-list>
  </v-navigation-drawer>
</template>

<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { useDisplay } from 'vuetify';

const props = defineProps({
  currentTab: String,
});

const emit = defineEmits(['select-tab']);

const { mobile } = useDisplay();

const drawer = ref(true);
const rail = ref(true);

const isActive = (tab) => props.currentTab === tab;

const selectTab = (tab) => {
  emit('select-tab', tab);
};

const logout = () => {
  const url = route('logout');
  useForm({}).get(url);
};

watch(
  mobile,
  (isMobile) => {
    drawer.value = !isMobile;
  },
  { immediate: true },
);
</script>

<style scoped>
.v-list-item--active {
  background-color: rgba(255, 255, 255, 0.1);
}
</style>
