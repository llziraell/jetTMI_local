<template>
  <GuestLayout class="tailwind-scope">
    <Head title="Вход" />

    <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
      {{ status }}
    </div>

    <form @submit.prevent="submit">
      <div class="mb-2">
        <div>
          <InputError
            class="my-2"
            :status="alreadyReg"
            :message="alreadyReg ? message : form.errors.email"
          />
          <v-spacer></v-spacer>
          <InputLabel for="email" value="Email" />
          <TextInput
            id="email"
            type="email"
            class="mt-1 block w-full"
            v-model="form.email"
            required
            autofocus
            autocomplete="username"
            @click="isMessageDisplayed = null"
          />
          <InputError class="mt-2" :message="form.errors.email" />
        </div>
        <div class="justify-space-between mt-4 flex items-center">
          <div class="mt-4 flex items-center justify-end">
            <Link
              v-if="canResetPassword"
              :href="route('login.checkEmail', { email: form.email })"
              class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
            >
              Вы входите первый раз?
            </Link>
          </div>
          <PrimaryButton
            v-if="!isEmailChecked"
            class="mt-4"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            @click="checkEmail"
          >
            Войти
          </PrimaryButton>
        </div>
      </div>
      <div v-if="emailExists">
        <div>
          <InputLabel for="password" value="Password" />
          <TextInput
            id="password"
            type="password"
            class="mt-1 block w-full"
            v-model="form.password"
            required
            autocomplete="current-password"
            @click="isMessageDisplayed = null"
          />
          <InputError class="mt-2" :message="form.errors.password" />
        </div>
        <div class="mt-4 block">
          <label class="flex items-center">
            <Checkbox name="remember" v-model:checked="form.remember" />
            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400"
              >Запомнить меня</span
            >
          </label>
        </div>
        <div class="mt-4 flex items-center justify-end">
          <Link
            :href="route('password.request', { email: form.email })"
            class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
          >
            Забыли пароль?
          </Link>

          <PrimaryButton
            class="ms-4"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Войти
          </PrimaryButton>
        </div>
      </div>
    </form>
  </GuestLayout>
</template>

<script setup>
import { computed, ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Checkbox from '@/js/Components/Checkbox.vue';
import GuestLayout from '@/js/Layouts/GuestLayout.vue';
import InputError from '@/js/Components/InputError.vue';
import InputLabel from '@/js/Components/InputLabel.vue';
import PrimaryButton from '@/js/Components/PrimaryButton.vue';
import TextInput from '@/js/Components/TextInput.vue';

const props = defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },
  emailExists: {
    type: Boolean,
  },
  message: {
    type: String,
  },
  alreadyReg: Boolean,
  form: Object,
});

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const isMessageDisplayed = ref(true);

const isEmailChecked = computed(() => props.emailExists);

const checkEmail = () => {
  const url = route('login.checkEmail', { email: form.email });
  form.get(url);
};

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
  });
};
</script>
