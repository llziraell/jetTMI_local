<template>
  <FormKit
    id="form"
    class="form"
    type="form"
    :actions="false"
    @submit="submitHandler"
  >
    <FormKit
      class="form__item"
      type="text"
      name="name"
      label="Контактное лицо"
      placeholder="Имя"
      validation="required"
      maxlength="255"
    />
    <FormKit
      class="form__item"
      type="text"
      name="email"
      label="Email"
      placeholder="Email"
      validation="required|email"
      maxlength="255"
    />
    <FormKit
      class="form__item"
      type="text"
      name="phone_number"
      label="Номер телефона"
      placeholder="+7 (000) 000 00-00"
      v-mask="'+7 (###) ### ##-##'"
      validation="required|matches:/^\+7 \(\d{3}\) \d{3} \d{2}-\d{2}$/"
      :validation-messages="{
        matches: 'Пожалуйста, введите действительный номер телефона.',
      }"
    />
    <FormKit
      class="form__item"
      type="textarea"
      name="message"
      label="Описание"
      placeholder="Кратко опишите ваш вопрос"
      validation="required"
      maxlength="600"
    />
    <v-container fluid class="pa-0 d-flex ga-4 flex-wrap">
      <vue-recaptcha
        v-show="showCaptcha"
        :sitekey="recaptchaSiteKey"
        @verify="onCaptchaVerified"
      />
      <v-btn type="submit" class="btn v-btn--primary-flat"> Отправить </v-btn>
    </v-container>
    <v-snackbar v-model="snackbar" location="top">
      Форма успешно отправлена.
    </v-snackbar>
  </FormKit>
</template>

<script setup>
import { ref, inject, computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
import VueRecaptcha from 'vue3-recaptcha2';
import { Inertia } from '@inertiajs/inertia';

const windowWidth = inject('windowWidth');

const snackbar = ref(false);

const recaptchaSiteKey =
  import.meta.env.RECAPTCHA_SITE_KEY || 'default-sitekey';

const showCaptcha = ref(false);

// Токен капчи
const recaptchaToken = ref(null);

const submitHandler = async (values) => {
  const form = useForm({
    ...values,
  });

  if (form) {
    if (recaptchaToken.value) {
      const form = useForm({
        ...values,
        recaptcha_token: recaptchaToken.value,
      });
      form.post('/home', {
        onSuccess: () => {
          form.reset();
          Inertia.reload({
            onFinish: () => {
              snackbar.value = true;
            },
          });
        },
        onError: (errors) => {},
        preserveScroll: true,
      });
    } else {
      showCaptcha.value = true;
      return;
    }
  }
};

const onCaptchaVerified = (token) => {
  recaptchaToken.value = token;
};
</script>

<style scoped lang="scss">
:deep(.formkit-wrapper) {
  max-width: 100%;
}

.formkit-form {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.v-btn {
  width: 179px;
}

:deep(.formkit-input) {
  padding: 20px 16px;
}

:deep(.formkit-label) {
  font-size: 18px;
  margin-bottom: 6px;
  font-family: 'Roboto';
}

:deep(.v-snackbar__content) {
  background: white;
  color: black;
  font-size: 18px;
}
</style>
