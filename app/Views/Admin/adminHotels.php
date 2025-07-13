<section>
  <div class="container">
    <h2>Управление отелями</h2>
    <button id="addHotelBtn">Добавить отель</button>
    <div id="hotelsContainer" class="flex placement-list placement__full-house"></div>
  </div>

  <!-- шаблон карточки отеля -->
  <template id="hotelCardTpl">
    <div class="placement-list-item">
      <img class="placement__img" />
      <div class="placement-content">
        <div class="placement-item">
          <span class="placement-price-prefix">от </span>
          <span class="placement-price"></span> / ночь
          <span class="svg-stars"></span>
        </div>
        <h3 class="placement-title-item"></h3>
        <p class="placement-descr"></p>
        <button class="edit-btn">Ред.</button>
        <button class="delete-btn">Удал.</button>
      </div>
    </div>
  </template>

  <!-- Modal для формы -->
  <div id="hotelModal" class="modules">
    <div class="modules__content">
      <span class="modules__close">&times;</span>
      <h3 class="modules__title">Отель</h3>
      <form id="hotelForm" class="modules__form" enctype="multipart/form-data">
        <input type="hidden" id="hotelId" />
        <input required type="text" name="name" id="hotelName" placeholder="Название" />
        <input required type="text" name="city" id="hotelCity" placeholder="Город" />
        <input required type="text" name="country" id="hotelCountry" placeholder="Страна" />
        <input required type="number" name="price_per_night" id="hotelPrice" placeholder="Цена за ночь" />
        <input required type="number" name="rating" id="hotelRating" min="0" max="5" placeholder="Рейтинг (0–5)" />
        <label for="hotelImageFile">Картинка отеля</label>
        <input type="file" id="hotelImageFile" name="image" class="modules__form-input" accept="image/*">
        <button type="submit">Сохранить</button>
      </form>
    </div>
  </div>
</section>
<script type="module" defer src="/js/adminHotels.js"></script>
