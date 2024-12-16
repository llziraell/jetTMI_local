<template>
  <section id="preview" class="preview section">
    <div class="preview__container">
      <div class="preview__container-img"></div>
      <div class="preview__inner">
        <div class="preview__title-content">
          <div class="preview__title">
            JetTMI<br /><span class="preview__title-strong">ПК ВПиГАПИ</span>
          </div>
          <div class="preview__subtitle">
            Программный комплекс визуального<br />представления и графического
            анализа<br />
            параметрической информации
          </div>
        </div>
        <div class="preview__image">
          <div class="preview__image-inner"></div>
        </div>
      </div>
    </div>
  </section>

  <section class="about section" id="about">
    <div class="about__container">
      <div class="about__inner">
        <div class="about__desc _container">
          <div class="about__desc-inner">
            <div class="about__title-content">
              <span class="about__title-top">Коротко о компании</span>
              <div class="about__title-bottom">НИЦ СПБ ЭТУ</div>
            </div>
            <div class="about__subtitle">
              Научно-инженерный центр Санкт-Петербургского электротехнического
              университета - АО «НИЦ СПб ЭТУ»
            </div>
            <div class="about__text">
              <p>
                Научно-инженерный центр - надежное, интенсивно развивающееся
                предприятие, заслужившее положительную репутацию среди
                заказчиков и партнеров.
              </p>
              <br />
              <p>
                Наша компания имеет двадцатилетний опыт реализации проектов
                различной сложности, необходимые лицензии и сертификаты,
                современную материально-техническую базу, что позволяет нам
                оказывать Заказчикам высококачественные комплексные услуги в
                области информационных технологий.
              </p>
              <br />
              <p>
                АО «НИЦ СПб ЭТУ» одна из первых ИТ-компаний в России, которая
                предлагает заказчикам комплексную услугу – от проектирования и
                разработки информационных систем и программного обеспечения до
                организации их повседневной эксплуатации и дальнейшего развития.
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="about__stats">
        <div class="about__stats-inner _container">
          <div class="about__stats-item item-stats">
            <div class="item-stats__icon">></div>
            <div class="item-stats__content">
              <div class="item-stats__value">20</div>
              <div class="item-stats__text">лет успешной работы</div>
            </div>
          </div>
          <div class="about__stats-item item-stats">
            <div class="item-stats__icon">></div>
            <div class="item-stats__content">
              <div class="item-stats__value">700</div>
              <div class="item-stats__text">сотрудников</div>
            </div>
          </div>
          <div class="about__stats-item item-stats">
            <div class="item-stats__icon"></div>
            <div class="item-stats__content">
              <div class="item-stats__value">4</div>
              <div class="item-stats__text">доктора наук</div>
            </div>
          </div>
          <div class="about__stats-item item-stats">
            <div class="item-stats__icon"></div>
            <div class="item-stats__content">
              <div class="item-stats__value">28</div>
              <div class="item-stats__text">кандидатов наук</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="why-us section" id="why-us">
    <div class="why-us__container _container">
      <div class="why-us__inner">
        <div class="why-us__title-content">
          <span class="why-us__title-top">Выбирайте нас</span>
          <div class="why-us__title-bottom">Что вы получаете</div>
        </div>
        <div class="why-us__content">
          <div class="why-us__content-inner">
            <AdvantageList :items="advantageList" />
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="areas subsection" id="areas">
    <div class="areas__container _container">
      <div class="areas__inner">
        <div class="areas__title-content">
          <div class="areas__title">Сферы применения продукции</div>
          <div class="areas__subtitle">
            Программный комплекс работают во многих сферах деятельности, где
            требуется надежное программное обеспечение
          </div>
        </div>
        <div class="areas__slider">
          <Slider :items="sliderItems" />
        </div>
      </div>
    </div>
  </section>

  <section class="charts subsection" id="charts">
    <div class="charts__container _container">
      <div class="charts__inner">
        <div class="charts__image">
          <picture>
            <source
              media="(min-width: 1200px)"
              srcset="@/assets/img/laptop.jpg"
            />
            <source
              media="(min-width: 0)"
              srcset="@/assets/img/laptop-mobile.jpg"
            />
            <img src="@/assets/img/laptop.jpg" alt="" />
          </picture>
        </div>
        <div class="charts__content">
          <div class="charts__title">
            Один из основных элементов программного комплекса <br />
            <span class="charts__title-strong">это графики</span>
          </div>
          <div class="charts__text">
            С помощью вычислительных инструментов вы сможете проводить глубокий
            анализ данных, выявлять зависимости и определять ключевые
            закономерности, что позволит принимать более обоснованные решения
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="comparison section" id="comparison">
    <div class="comparison__container _container">
      <div class="comparison__inner">
        <div class="comparison__title">
          Сравнение нашего решения <br />
          с решениями
          <span class="comparison__title-strong">других компаний</span>
        </div>
        <div class="comparison__content">
          <div class="comparison__card">
            <div class="comparison__card-inner">
              <div class="comparison__card-title">Другие программы</div>
              <ul class="comparison__card-list">
                <li class="comparison__card-item">
                  <div class="comparison__card-point"></div>
                  <div class="comparison__card-text">
                    Повседневная практика показывает
                  </div>
                </li>
                <li class="comparison__card-item">
                  <div class="comparison__card-point"></div>
                  <div class="comparison__card-text">
                    Повседневная практика показывает, что реализация намеченных
                    плановых
                  </div>
                </li>
                <li class="comparison__card-item">
                  <div class="comparison__card-point"></div>
                  <div class="comparison__card-text">
                    Широким активом в значительной степени обуславливает
                    создание системы обучения кадров
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <div class="comparison__card">
            <div class="comparison__card-inner">
              <div class="comparison__card-title">
                Программный комплекс
                <span class="comparison__card-title-strong">JetTMI</span>
              </div>
              <ul class="comparison__card-list">
                <li class="comparison__card-item">
                  <div class="comparison__card-point"></div>
                  <div class="comparison__card-text">
                    Заданий требуют определения и уточнения
                  </div>
                </li>
                <li class="comparison__card-item">
                  <div class="comparison__card-point"></div>
                  <div class="comparison__card-text">
                    Повседневная практика показывает, что реализация намеченных
                    плановых
                  </div>
                </li>
                <li class="comparison__card-item">
                  <div class="comparison__card-point"></div>
                  <div class="comparison__card-text">
                    Широким активом в значительной степени обуславливает
                    создание системы обучения кадров
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="performance subsection" id="performance">
    <div class="performance__container _container">
      <div class="performance__inner">
        <div class="performance__title-content">
          <div class="performance__title">
            Посмотрите ролик о нашем продукте
          </div>
          <div class="performance__subtitle">
            Участие в формировании системы обучения кадров, соответствует
            насущным потребностям. Повседневная практика показывает, что рамки и
            место обучения кадров играет важную роль в формировании систем
            массового участия.
          </div>
        </div>
        <div class="performance__video">
          <img src="@/assets/img/video-1.jpg" />
        </div>
      </div>
    </div>
  </section>

  <section class="analogs subsection" id="analogs">
    <div class="analogs__container _container">
      <div class="analogs__inner">
        <div class="analogs__title-content">
          <div class="analogs__title">Похожие решения</div>
          <div class="analogs__subtitle">
            Познакомитесь с другими решениями разрабатываемые нами
          </div>
        </div>
        <div class="analogs__content">
          <div class="analogs__content-inner">
            <div class="analogs__items">
              <AnalogsList :items="analogsList" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="solution subsection" id="solution">
    <div class="solution__container _container">
      <div class="solution__inner">
        <div class="solution__image">
          <img src="@/assets/img/po-image.jpg" alt="" />
        </div>
        <div class="solution__content">
          <div class="solution__title">
            Коробочное решение <br />
            <span class="solution__title-strong">для ваших задач</span>
          </div>
          <div class="solution__subtitle">
            Программный комплекс визуального представления и графического
            анализа параметрической информации комплекс визуального
            представления и графического анализа параметрической информации
          </div>
          <div class="solution__list">
            <div class="solution__item">
              <div class="solution__item-inner">
                <div class="solution__item-icon">
                  <img
                    src="@/assets/img/icons/fastforward-clock.svg"
                    class="svg-fastforward-clock-dims"
                    alt="fastforward-clock"
                  />
                </div>
                <div class="solution__item-text">Быстрое внедрение</div>
              </div>
            </div>
            <div class="solution__item">
              <div class="solution__item-inner">
                <div class="solution__item-icon">
                  <img
                    src="@/assets/img/icons/settings-machine.svg"
                    class="svg-settings-machine-dims"
                    alt="settings-machine"
                  />
                </div>
                <div class="solution__item-text">Настраиваемый интерфейс</div>
              </div>
            </div>
            <div class="solution__item">
              <div class="solution__item-inner">
                <div class="solution__item-icon">
                  <img
                    src="@/assets/img/icons/hierarchy.svg"
                    class="svg-hierarchy-dims"
                    alt="hierarchy"
                  />
                </div>
                <div class="solution__item-text">Большой функционал</div>
              </div>
            </div>
            <div class="solution__item">
              <div class="solution__item-inner">
                <div class="solution__item-icon">
                  <img
                    src="@/assets/img/icons/customer-support.svg"
                    class="svg-customer-support-dims"
                    alt="customer-support"
                  />
                </div>
                <div class="solution__item-text">Сопровождение</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="feedback section" id="feedback">
    <div class="feedback__container _container">
      <div class="feedback__inner">
        <div class="feedback__info">
          <div class="feedback__info-inner">
            <div class="feedback__title-content">
              <div class="feedback__title-top">Свяжитесь с нами</div>
              <div class="feedback__title-bottom">Хотите сотрудничать?</div>
            </div>
            <div class="feedback__subtitle">
              Заполните простую форму или позвоните по телефону.<br />
              Наши менеджеры бесплатно проконсультируют вас.
            </div>
            <div class="feedback__contacts">
              <div class="contact-info">
                <div class="contact-info__inner">
                  <span class="contact-info__icon _icon-address"></span>
                  <div class="contact-info__content">
                    <div class="contact-info__title">Адрес</div>
                    <div class="contact-info__text">
                      Санкт-Петербург ул. Политехническая, дом 22, литера K
                    </div>
                  </div>
                </div>
              </div>
              <div class="contact-info">
                <div class="contact-info__inner">
                  <span class="contact-info__icon _icon-clock"></span>
                  <div class="contact-info__content">
                    <div class="contact-info__title">Часы работы</div>
                    <div class="contact-info__text">
                      По будням<br />9:00 - 18.00
                    </div>
                  </div>
                </div>
              </div>
              <div class="contact-info">
                <div class="contact-info__inner">
                  <span class="contact-info__icon _icon-phone"></span>
                  <div class="contact-info__content">
                    <div class="contact-info__title">Телефон</div>
                    <div class="contact-info__text">+7 (812) 703-75-84</div>
                  </div>
                </div>
              </div>
              <div class="contact-info">
                <div class="contact-info__inner">
                  <span class="contact-info__icon _icon-email"></span>
                  <div class="contact-info__content">
                    <div class="contact-info__title">Email</div>
                    <div class="contact-info__text">info@nicetu.spb.ru</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="feedback__form">
          <Form />
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { advantageList, analogsList, sliderItems } from '@/js/utils/consts.js';
import Form from '@/js/Components/Landing/Form.vue';
import Slider from '@/js/Components/Landing/Slider.vue';
import AnalogsList from '@/js/Components/Landing/AnalogsList.vue';
import AdvantageList from '@/js/Components/Landing/AdvantageList.vue';
</script>
