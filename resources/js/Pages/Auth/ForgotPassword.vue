<template>
  <GuestLayout>
    <Head title="Forgot Password" />

    <ResetPasswordMessage
      v-if="showMessage"
      :message="resetMessage"
      redirect-url="/login"
    />

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
      Забыли пароль? Просто введите адрес электронной почты, и мы отправим вам
      ссылку для сброса пароля. Если ссылка не приходит, проверьте спам.
    </div>

    <div
      v-if="status"
      class="mb-4 text-sm font-medium text-green-600 dark:text-green-400"
    >
      {{ status }}
    </div>

    <form @submit.prevent="submit">
      <div>
        <InputLabel for="email" value="Email" />

        <TextInput
          id="email"
          type="email"
          class="mt-1 block w-full"
          v-model="form.email"
          required
          autofocus
          autocomplete="username"
        />

        <InputError class="mt-2" :message="form.errors.email" />
      </div>

      <div class="mt-4 flex items-center justify-end">
        <PrimaryButton
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Отправить ссылку на почту
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>

<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import GuestLayout from '@/js/Layouts/GuestLayout.vue';
import InputError from '@/js/Components/InputError.vue';
import InputLabel from '@/js/Components/InputLabel.vue';
import PrimaryButton from '@/js/Components/PrimaryButton.vue';
import TextInput from '@/js/Components/TextInput.vue';
import ResetPasswordMessage from '@/js/Pages/Auth/ResetPasswordMessage.vue';

defineProps({
  status: {
    type: String,
  },
});

const form = useForm({
  email: '',
});

const showMessage = ref(false);
const resetMessage = ref('');

const submit = () => {
  form.post(route('password.email'), {
    onSuccess: () => {
      resetMessage.value =
        'Письмо для сброса пароля отправлено. Проверьте вашу почту.';
      showMessage.value = true;
    },
  });
};
</script>
