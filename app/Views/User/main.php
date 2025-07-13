
    <section class="hero">
      <div class="container">
        <div class="hero__content">
          <h1 class="hero__title">Отели высокого уровня и комфорта</h1>
          <p class="hero__descr">
            Идейные соображения высшего порядка, а так же
            ответсвенность за работу. отличное качество,
            прислушиваемся к вашему выбору
          </p>
            <a aria-label="ссылка хочу тур для перехода, чтобы оставить заявку" class="hero__btn btn btn-reset" href="#tour" >хочу тур</a>
        </div>
      </div>
    </section>
    <section class="special__offers">
      <div class="container special__offers-container">
        <h2 class="title special__offers-title">Спецпредложения</h2>
        <div class="special-offers-content flex">
          <div class="offers-column-one offers__full flex">
            <article class="special-offers-item-left-column special-offers-img-one">
              <h3 class="special-offers-title-item-left">
                Мальдивские острова
              </h3>
              <p class="price-deskr-left">
                от 55 000 ₽
              </p>
              <a aria-label="Cсылка подробнее Мальдивские острова" href="#application" class="section-offset-link">
                Подробнее
                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="18" viewBox="0 0 11 18" fill="none">
                  <path d="M1.49998 1.00002L9.27815 8.7782L1.49998 16.5564" stroke-width="2"/>
                </svg>
              </a>
              </article>
              <article class="special-offers-item-left-column special-offers-img-two">
                <h3 class="special-offers-title-item-left">
                  Остров Крит
                </h3>
                <p class="price-deskr-left">
                  от 30 000 ₽
                </p>
                <a aria-label="Cсылка подробнее Остров Крит" href="#application" class="section-offset-link">
                  Подробнее
                  <svg xmlns="http://www.w3.org/2000/svg" width="11" height="18" viewBox="0 0 11 18" fill="none">
                    <path d="M1.49998 1.00002L9.27815 8.7782L1.49998 16.5564" stroke-width="2"/>
                  </svg>
                </a>
              </article>
          </div>
          <div class="offers-column-two offers__full flex">
            <article class="special-offers-item-right-column special-offers-img-three">
              <h3 class="special-offers-title-item-right">
                Номера категории люкс
              </h3>
              <p class="price-deskr-right">
                от 5 000 ₽
              </p>
              <a aria-label="Cсылка подробнее 'Номера категории люкс'" href="#application" class="section-offset-link">
                Подробнее
                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="18" viewBox="0 0 11 18" fill="none">
                  <path d="M1.49998 1.00002L9.27815 8.7782L1.49998 16.5564" stroke-width="2"/>
                </svg>
              </a>
              </article>
          </div>
      </div>
      </div>
    </section>
    <section class="about">
      <div class="container">
        <h2 id="about-us" class="about__title title">О нас</h2>
        <p class="about__descr descr">
          Надежные партнёрские связи. С нами сотрудничают как владельцы небольших объектов, так и крупные мировые гостиничные сети. На сайте уже для Вас работают около 350 тыс. единиц размещения в более чем 75 странах мира.
          Лучшие предложения по выгодной цене. Вас ждут лучшие цены для проживания в любой точке планеты. Многие гостиницы предоставляют дополнительные скидки на размещение при бронировании через платформу 101Hotels.com.
          Легкость и удобство. Наши усилия направлены на то, чтобы сделать портал понятным, простым и эффективным. Для этого на сайте разработана гибкая система сортировки и фильтрации, которая позволяет найти самый подходящий отель!
        </p>
        <article class="about__content flex">
          <div class="about__content-full about__content-left flex">
            <div class="about__wrapper flex">
              <p class="about__descr descr">
                Принимая во внимание показатели успешности,
                перспективное планирование способствует подготовке
                и реализации новых принципов
              </p>
              <button aria-label="Кнопка подробнее О нас" class="about__btn btn btn-reset">
                Подробнее
              </button>
            </div>
          </div>
          <div class="about__content-full about__content-right flex">
            <div class="about__block about__img-one">
              <h3 class="about__title title-h-three">
                Консультация с широким активом
              </h3>
              <p class="about__descr descr">
                Лучшие предложения по выгодной цене. Вас ждут лучшие цены для проживания в любой точке планеты. Многие гостиницы предоставляют дополнительные скидки на размещение при бронировании
              </p>
            </div>
            <div class="about__block about__img-two">
              <h3 class="about__title title-h-three">
                В своём стремлении повысить
              </h3>
              <p class="about__descr descr">
                Постоянное развитие. Команда специалистов непрерывно трудится над улучшением сервиса. Мы внедряем новые технологии и учитываем современные тенденции. Поэтому делаем акцент на мобильной версии сайта и приложении, чтобы бронирование было максимально комфортным.
              </p>
            </div>
          </div>
        </article>
      </div>
    </section>
    <section class="tour" id="tour">
      <div class="container">
        <h2 class="title title-tour">Хочу тур</h2>
        <div class="tour-content">
          <div class="tour-main">
            <form class="form-content" action="https://jsonplaceholder.typicode.com/posts" method="POST">
              <ul class="tour-list list-reset flex">
                <li class="form-item">
                  <label for="departure" class="form-label form-label-option">Город вылета</label>
                  <select id="departure" class="form-select" name="departure">
                    <option value="Город вылета" disabled selected>Город вылета</option>
                    <option value="Санкт-Петербург">Санкт-Петербург</option>
                    <option value="Москва">Москва</option>
                    <option value="Казань">Казань</option>
                  </select>
                </li>
                <li class="form-item">
                  <label for="country" class="form-label form-label-option">Страна</label>
                  <select id="country" class="form-select" name="country">
                    <option value="Страна" disabled selected>Страна</option>
                    <option value="Санкт-Петербург">Австралия</option>
                    <option value="Москва">Москва</option>
                    <option value="Казань">Казань</option>
                    <option value="Санкт-Петербург">Санкт-Петербург</option>
                  </select>
                </li>
                <li class="form-item">
                  <label for="date" class="form-label">Дата прибытия</label>
                  <input id="date" class="tour-input" name="date" type="date">
                </li>
                <li class="form-item tour-input-bottom">
                  <label for="tourist" class="form-label">Туристы</label>
                  <input id="tourist" class="tour-input" required type="number" name="tour" placeholder="2">
                </li>
                <li class="form-item tour-input-bottom">
                  <label for="night" class="form-label">Ночей</label>
                  <input id="night" class="tour-input" type="number" name="night" placeholder="3">
                </li>
                <li>
                  <button aria-label="Кнопка найти тур" class="btn stages__btn btn-reset btn-form">Найти</button>
                </li>
              </ul>
            </form>
          </div>
        </div>
      </div>
    </section>
    <section class="placement">
    <section class="placement">
  <div class="container">
    <h2 id="placement" class="title placement-title">Размещение</h2>
    <div class="placement__full-house">
      <ul class="placement-list list-reset flex">
        <?php foreach ($hotels as $hotel): ?>
          <li class="placement-list-item">
            <img class="placement__img"
                 src="<?= htmlspecialchars($hotel['image_path']) ?>"
                 alt="<?= htmlspecialchars($hotel['name']) ?>">
            <div class="placement-content">
              <div class="placement-item">
                <span class="placement-price-prefix">от </span>
                <span class="placement-price">
                  <?= number_format($hotel['price_per_night'], 0, ',', ' ') ?> ₽/ночь
                </span>
                <span class="svg-stars">
                  <?php for ($i = 0; $i < 5; $i++): ?>
                    <img src="/img/star<?= $i < $hotel['rating'] ? '' : '-white' ?>.svg" alt="">
                  <?php endfor; ?>
                </span>
              </div>
              <h3 class="placement-title-item">
                <?= htmlspecialchars($hotel['name']) ?>
              </h3>
              <p class="placement-descr">
                <?= htmlspecialchars($hotel['city']) ?>, <?= htmlspecialchars($hotel['country']) ?>
              </p>
              <!-- <a href="#"
                 class="stages__btn btn-reset btn placement-btn">
                Подробнее
              </a> -->
              <button class="stages__btn btn-reset btn placement-btn book-btn" data-hotel-id="<?= $hotel['id'] ?>">
                Забронировать
              </button>
            </div>
          </li>
        <?php endforeach; ?>
        <li class="placement-list-item-last placement-list-item placement-img">
          <a href="#" class="section-placement-link" >Посмотреть все варианты</a>
        </li>
      </ul>
      <!-- Booking Modal -->
<div id="bookingModal" class="modules" style="display:none">
  <div class="modules__content">
    <span class="modules__close">&times;</span>
    <h3>Забронировать отель</h3>
    <form id="bookingForm" class="modules__form">
      <input type="hidden" id="bookingHotelId" name="hotelId">
      <label>Дата заезда:<input required type="date" name="start_date"></label>
      <label>Дата выезда:<input required type="date" name="end_date"></label>
      <label>Туристы:<input required type="number" name="guests" min="1" value="1"></label>
      <button type="submit">Подтвердить</button>
    </form>
  </div>
</div>

    </div>
  </div>
</section>

    </section>
    <section class="stages">
      <div class="container">
        <h2 id="stages" class="stages__title title">Этапы</h2>
        <div class="stages__content stages__img">
          <div class="stages__left-block">
            <h3 class="stages__title title-h-three">Проводим консультацию</h3>
            <p class="stages__descr descr">
              <span class="stages__descr-span">
              Рады приветствовать вас на консультации по выбору отеля
              для вашего пребывания. Мы понимаем, что правильный выбор места
              проживания играет важную роль в вашем путешествии или деловой поездке,
              поэтому наша цель - помочь вам сделать максимально осознанный выборe.
              </span>
              <span class="stages__descr-span">
              Для начала, давайте обсудим ваши предпочтения и потребности.
              Что важно для вас в отеле? Например, вы предпочитаете уютные бутик-отели
              или большие цепные отели с широким спектром услуг? Есть ли какие-то
              специальные удобства или услуги, которые вы бы хотели иметь в своем отеле?
              </span>
            </p>
            <div class="stages__button flex">
              <button aria-label="Кнопка подробнее о этапах" class="stages__btn btn btn-reset">
                Подробнее
              </button>
              <button aria-label="Кнопка подробнее о договоре" class="stages__btn btn btn-reset stages__btn--black">
                Договор
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="questions">
      <div class="container">
        <h2 id="question" class="questions__title title">Вопросы</h2>
        <ul class="questions__list list-reset flex">
          <li class="questions__item">
            <h3 class="questions__title title-h-three">
              <span class="questions__descr-span">Из чего формируется</span>
              <span class="questions__descr-span">конечная стоимость тура?</span>
            </h3>
            <p class="questions__descr descr">
              От топливного сбора, Доплата за смену тарифа на регулярном
              рейсе — в чью пользу взимают и кто это делает.
            </p>
          </li>
          <li class="questions__item">
            <h3 class="questions__title title-h-three">
              У меня есть свои мысли о путешествии. Можно ли их реализовать?
            </h3>
            <p class="questions__descr descr">
              Мы рассмотрим люой выбор, любые пожелания наших туристов,
              выберем cамые подходящие туры.
            </p>
          </li>
          <li class="questions__item">
            <h3 class="questions__title title-h-three">
              Я выбираю между разными компаниями. Почему вы?
            </h3>
            <p class="questions__descr descr">
              Надежные партнёрские связи. С нами
              сотрудничают как владельцы небольших объектов,
              так и крупные мировые гостиничные сети.
            </p>
          </li>
        </ul>
      </div>
    </section>
    <script type="module" src="/js/bookings.js"></script>
