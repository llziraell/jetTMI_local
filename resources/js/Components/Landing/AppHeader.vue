<template>
  <div class="header__overlay"></div>
  <header class="header">
    <div id="header-mobile" class="header__mobile-preview">
      <div class="header__mobile-preview-inner">
        <div class="header__mobile-preview-logo">
          <div class="header__top-logo-content logo">
            <div class="logo__icon _icon-logo"></div>
            <div class="logo__text">JetTMI</div>
          </div>
        </div>
        <div
          class="header__mobile-preview-burger"
          @click="drawerVisible = true"
        >
          <img
            src="@/assets/img/icons/burger.svg"
            class="svg-burger-dims"
            alt="burger"
          />
        </div>
      </div>
    </div>
    <div class="header__top">
      <div id="header-default" class="header__top-overlay">
        <div class="header__top-container">
          <div class="header__top-inner">
            <a
              class="header__top-logo-content logo"
              @click="scrollTo('preview')"
            >
              <div class="logo__icon _icon-logo"></div>
              <div class="logo__text">JetTMI</div>
            </a>
            <div class="header__top-info header-info">
              <div class="header-info__item header-info__item--flat">
                <img src="@/assets/img/icons/email-header.svg" />
                <span>sales@nicetu.spb.ru</span>
              </div>
              <div class="header-info__item">
                <img
                  src="@/assets/img/icons/phone.svg"
                  class="svg-phone-2-dims"
                  alt="phone-2"
                />
                <span>+7 981 (899) 02-33</span>
              </div>
              <div class="header-info__btn header-info__btn--secondary">
                <v-btn class="btn" @click="scrollTo('feedback')">
                  Заказать звонок
                </v-btn>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="header__bottom">
      <div class="header__bottom-container _container">
        <ul class="header__bottom-items">
          <li
            v-for="link in sectionLinks"
            class="header__bottom-item"
            :class="{
              'header__bottom-item--active': link.sections.includes(subsection),
            }"
          >
            <a @click="scrollTo(link.sections[0])">{{ link.title }}</a>
          </li>
        </ul>
      </div>
    </div>
  </header>

  <v-navigation-drawer
    v-model="drawerVisible"
    width="290"
    disable-resize-watcher
    :touchless="!drawerVisible"
  >
    <div class="header-mobile">
      <div class="header-mobile__inner">
        <div class="header-mobile__logo logo">
          <div class="logo__icon logo__icon--plain _icon-logo"></div>
          <div class="logo__text logo__text--plain">JetTMI</div>
        </div>
        <ul class="header-mobile__links">
          <li
            v-for="link in sectionLinks"
            class="header-mobile__link"
            :class="{
              'header-mobile__link--active': link.sections.includes(subsection),
            }"
          >
            <a @click="scrollTo(link.sections[0])">{{ link.title }}</a>
          </li>
        </ul>
        <div class="header-mobile__bottom">
          <div class="header-mobile__info header-info">
            <div class="header-info__item header-info__item--flat">
              <img
                src="@/assets/img/icons/email-black.svg"
                class="svg-email-2-black-dims"
                alt="email-2-black"
              />
              <span>sales@nicetu.spb.ru</span>
            </div>
            <div class="header-info__item">
              <img src="@/assets/img/icons/phone-black.svg" />
              <span>+7 981 (899) 02-33</span>
            </div>
            <div class="header-info__btn">
              <v-btn
                color="primary"
                class="btn btn--primary-flat"
                @click="scrollTo('feedback')"
              >
                Заказать звонок
              </v-btn>
            </div>
          </div>
        </div>
      </div>
    </div>
  </v-navigation-drawer>
</template>

<script setup>
import { onMounted, ref, watch } from 'vue';
import { useDisplay } from 'vuetify';

const { lgAndUp } = useDisplay();

const drawerVisible = ref(false);

const throttle = (callee, timeout) => {
  let timer = null;

  return function cb(...args) {
    if (timer) return;

    timer = setTimeout(() => {
      callee(...args);
      clearTimeout(timer);
      timer = null;
    }, timeout);
  };
};

const calcRgbAlpha = (from, to, factor) => {
  const value = from + factor * (to - from);
  return Math.max(0, Math.min(255, value));
};

const calcFadeFactor = (position, rangeStart, rangeEnd) => {
  return Math.max(
    0,
    Math.min(1, (position - rangeStart) / (rangeEnd - rangeStart)),
  );
};

const withRgbScrollToElement = (
  targetElement,
  toTarget,
  rgbCfg,
  alphaCfg,
  offset = 0,
) => {
  const rect = toTarget.getBoundingClientRect();
  const viewportHeight = window.innerHeight;

  const fadeFactor = calcFadeFactor(
    viewportHeight - rect.top + offset,
    0,
    viewportHeight,
  );
  const rgb = calcRgbAlpha(rgbCfg.from, rgbCfg.to, fadeFactor);
  const alpha = calcRgbAlpha(alphaCfg.from, alphaCfg.to, fadeFactor);

  targetElement.style.background = `rgba(${rgb}, ${rgb}, ${rgb}, ${alpha})`;
};

const withRgbAbsoluteScroll = (
  targetElement,
  rgbCfg,
  alphaCfg,
  scrollRange,
) => {
  const scrollPosition = Math.max(
    0,
    Math.min(scrollRange.end, window.scrollY - scrollRange.start),
  );

  const fadeFactor = calcFadeFactor(
    scrollPosition,
    0,
    scrollRange.end - scrollRange.start,
  );
  const rgb = calcRgbAlpha(rgbCfg.from, rgbCfg.to, fadeFactor);
  const alpha = calcRgbAlpha(alphaCfg.from, alphaCfg.to, fadeFactor);

  targetElement.style.background = `rgba(${rgb}, ${rgb}, ${rgb}, ${alpha})`;
};

const useOverlayBg = () => {
  const headerBlock = document.getElementById('header-default');
  const headerMobileBlock = document.getElementById('header-mobile');
  const about = document.getElementById('about');

  const handleScrollHeader = throttle(() => {
    if (lgAndUp.value) {
      withRgbScrollToElement(
        headerBlock,
        about,
        { from: 127, to: 106 },
        { from: 0.25, to: 1 },
        174,
      );
    }
  }, 60);

  const handleScrollHeaderMobile = throttle(() => {
    if (!lgAndUp.value) {
      withRgbAbsoluteScroll(
        headerMobileBlock,
        { from: 127, to: 106 },
        { from: 0, to: 1 },
        { start: 0, end: 100 },
      );
    }
  }, 60);

  watch(
    lgAndUp,
    (v) =>
      v
        ? document.addEventListener('scroll', handleScrollHeader)
        : document.addEventListener('scroll', handleScrollHeaderMobile),
    { immediate: true },
  );
};

const section = ref('preview');
const subsection = ref('');

const scrollTo = (sectionId) => {
  const target = document.getElementById(sectionId);

  drawerVisible.value = false;

  if (target) {
    window.scrollTo({
      top: target.offsetTop - (lgAndUp.value ? 173 : 84),
      behavior: 'smooth',
    });
  }
};

const useObserver = () => {
  const sections = document.querySelectorAll('.section');
  const subsections = document.querySelectorAll('.subsection');
  const rootSection = document.getElementById('preview');
  const prevendsection = document.getElementById('solution');
  const endsection = document.getElementById('feedback');

  const observerOptions = {
    threshold: 0,
    rootMargin: '-175px 0px -100% 0px',
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        if (entry.target === rootSection) {
          history.pushState(null, '', window.location.pathname);
        } else {
          history.pushState(null, '', `#${entry.target.id}`);
        }

        section.value = entry.target.id;

        if (subsection.value !== prevendsection.id) {
          subsection.value = section.value;
        }
      }
    });
  }, observerOptions);

  const subsectionObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        subsection.value = entry.target.id;
        sectionLinks.map(
          (v) =>
            v.sections.includes(entry.target.id) &&
            history.pushState(null, '', `#${v.sections[0]}`),
        );
      }
    });
  }, observerOptions);

  const endsectionObserver = new IntersectionObserver(
    ([entry]) => {
      if (entry.isIntersecting) {
        section.value = endsection.id;
        history.pushState(null, '', `#${entry.target.id}`);
      }
    },
    { threshold: 0.5 },
  );

  sections.forEach((section) => observer.observe(section));
  subsections.forEach((subsection) => subsectionObserver.observe(subsection));
  endsectionObserver.observe(endsection);
};

onMounted(() => {
  useOverlayBg();
  useObserver();
});

const sectionLinks = [
  {
    title: 'Главная',
    sections: ['preview'],
  },
  {
    title: 'О нас',
    sections: ['about'],
  },
  {
    title: 'Преимущества',
    sections: ['why-us', 'areas', 'charts'],
  },
  {
    title: 'Решения',
    sections: ['comparison', 'performance', 'analogs'],
  },
  {
    title: 'Контакты',
    sections: ['feedback', 'solution'],
  },
];
</script>
