<template>
  <div class="slider">
    <div class="slider__inner">
      <div class="slider__content">
        <v-carousel v-model="model">
          <v-carousel-item
            v-for="(item, i) in items"
            :key="item.title"
            :value="i"
          >
            <div class="slider__info">
              <div class="slider__info-inner">
                <div class="slider__title-content">
                  <div class="slider__icon">
                    <img src="@/assets/img/rocket.svg" />
                  </div>
                  <div class="slider__title">
                    {{ item.title }}
                  </div>
                </div>
                <div class="slider__text">{{ item.text }}</div>
                <div class="slider__counter">
                  <span class="slider__counter-value">
                    {{ model > 10 ? model + 1 : `0${model + 1}` }}
                    /
                    {{ items.length > 10 ? items.length : `0${items.length}` }}
                  </span>
                </div>
              </div>
            </div>
            <div class="slider__image">
              <img src="@/assets/img/slider-1.jpg" alt="" />
            </div>
          </v-carousel-item>
        </v-carousel>
      </div>
      <div class="slider__navigation navigation-arrows">
        <button
          class="navigation-arrows__item navigation-arrows__item--prev"
          @click="model = Math.max(model - 1, 0)"
        >
          <img src="@/assets/img/arr-left.svg" alt="" />
        </button>
        <button
          class="navigation-arrows__item navigation-arrows__item--next"
          @click="model = Math.min(model + 1, items.length - 1)"
        >
          <img src="@/assets/img/arr-right.svg" alt="" />
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

defineProps({
  items: {
    type: Array,
  },
});

const model = ref(0);
</script>

<style scoped lang="scss">
:deep(.v-responsive__content) {
  display: flex;
  flex-direction: column;
  @media (min-width: 1200px) {
    flex-direction: row;
  }
}

:deep(.v-carousel__controls) {
  display: none;
}

:deep(.v-window) {
  height: 100% !important;

  .v-window__controls {
    display: none;
  }
}
</style>
