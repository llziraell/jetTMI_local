// import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h, provide } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

import '@mdi/font/css/materialdesignicons.css';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import 'vuetify/styles';

import VCalendar from 'v-calendar';
import 'v-calendar/style.css';

import { ru } from '@formkit/i18n';
import '@formkit/themes/genesis';
import { defaultConfig, plugin as formkitPlugin } from '@formkit/vue';
import VueTheMask from 'vue-the-mask';

const vuetify = createVuetify({
  components,
  directives,
});

const config = {
  locales: { ru },
  locale: 'ru',
};

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

import { useWindowSize } from '@vueuse/core';

const { width } = useWindowSize();

provide(width.value, 'windowWidth');

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) =>
    resolvePageComponent(
      `./Pages/${name}.vue`,
      import.meta.glob('./Pages/**/*.vue'),
    ),
  setup({ el, App, props, plugin }) {
    return createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(vuetify)
      .use(ZiggyVue)
      .use(VCalendar, {})
      .use(formkitPlugin, defaultConfig(config))
      .use(VueTheMask)
      .mount(el);
  },
  progress: {
    color: '#4B5563',
  },
});
