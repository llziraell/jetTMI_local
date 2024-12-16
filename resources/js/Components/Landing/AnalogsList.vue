<template>
  <div v-for="item in items" :key="item.title" class="analogs-item">
    <div class="analogs-item__image">
      <img src="@/assets/img/empty-image.jpg" alt="" />
    </div>
    <div class="analogs-item__content">
      <div class="analogs-item__title">{{ item.title }}</div>
      <div class="analogs-item__text">
        {{ item.text }}
      </div>
      <div class="analogs-item__actions">
        <v-btn variant="outlined">Подробнее</v-btn>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  items: {
    type: Array,
  },
});
</script>
