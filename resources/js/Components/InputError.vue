<template>
  <div v-show="message">
    <p
      class="text-sm"
      :class="
        status
          ? 'text-green-600 dark:text-green-400'
          : 'text-red-600 dark:text-red-400'
      "
    >
      {{ message }}
    </p>
  </div>
</template>

<script setup>
defineProps({
  message: {
    type: String,
  },
  status: Boolean,
});
</script>
