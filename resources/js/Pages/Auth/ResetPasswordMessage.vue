<template>
  <div class="modal-overlay" v-if="visible">
    <div class="modal">
      <p>{{ message }}</p>
      <button @click="handleOk">ОК</button>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

defineProps({
  message: {
    type: String,
    required: true,
  },
  redirectUrl: {
    type: String,
    default: '/login',
  },
});

const visible = ref(true);

const handleOk = () => {
  visible.value = false;
  window.location.href = '/admin/login';
};
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal {
  background: white;
  padding: 20px;
  border-radius: 8px;
  text-align: left;
  max-width: 400px;
  width: 90%;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

button {
  background: #005eff;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 4px;
  cursor: pointer;
  margin-top: 10px;
}

button:hover {
  background: #0241cd;
}
</style>
