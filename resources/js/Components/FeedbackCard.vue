<template>
  <v-card
    width="300"
    :subtitle="feedback.name"
    :text="feedback.question"
    :title="feedback.email"
  ></v-card>
</template>

<script setup>
defineProps({
  feedback: {},
});
</script>
