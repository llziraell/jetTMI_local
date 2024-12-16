<template>
  <footer class="footer">
    <div class="footer__container _container">
      <footer class="footer__inner">
        <div class="footer__logos">
          <div class="footer__logo _icon-nic-logo"></div>
          <div class="footer__inits">@ АО “НИЦ СПБ ЭТУ”</div>
        </div>
        <ul class="footer__link-list">
          <li v-for="link in links" :key="link.path" class="footer__link-item">
            <a @click="scrollToEl(link)">{{ link.title }}</a>
          </li>
        </ul>
        <div class="footer__contacts">
          <a class="footer__contact-item _icon-vk" href=""></a>
          <a class="footer__contact-item _icon-telegram" href=""></a>
        </div>
      </footer>
    </div>
  </footer>
</template>

<script setup>
import { useDisplay } from 'vuetify';

const { lgAndUp } = useDisplay();

const scrollToEl = (link) => {
  const targetElement = document.getElementById(link.path);

  if (targetElement) {
    window.scrollTo({
      top:
        document.getElementById(link.path).offsetTop -
        (lgAndUp.value ? 174 : 84),
      behavior: 'smooth',
    });
  }
};

const links = [
  {
    path: 'preview',
    title: 'Главная',
  },
  {
    path: 'why-us',
    title: 'Преимущества',
  },
  {
    path: 'comparison',
    title: 'Решения',
  },
  {
    path: 'feedback',
    title: 'Контакты',
  },
];
</script>
