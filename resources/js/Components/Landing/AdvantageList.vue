<template>
  <div v-for="(item, i) in items" :key="item.title" class="advantage">
    <div class="advantage__inner">
      <div class="advantage__title">
        <div class="advantage__number">
          {{ i + 1 > 10 ? i + 1 : `0${i + 1}` }}
        </div>
        <div class="advantage__line-container">
          <span class="advantage__line"></span>
        </div>
      </div>
      <div class="advantage__content">
        <div class="advantage__title">{{ item.title }}</div>
        <div class="advantage__text">
          {{ item.text }}
        </div>
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
