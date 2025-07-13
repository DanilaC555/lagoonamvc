<section>
    <div class="admin__container container">
      <h2>Список пользователей</h2>
      <div class="admin__block" id="usersContainer">
        <!-- Таблица пользователей будет вставлена сюда -->
        <p id="usersLoading">Загрузка пользователей...</p>
      </div>
      <div id="adminError" class="error"></div>
    </div>
    <!-- Модальное окно измененеия пользователя -->
    <div id="changeModal" class="modules">
      <div class="modules__content">
        <span class="modules__close">&times;</span>
        <h3 class="modules__title">Изменить пользователя</h3>
        <form id="changeFormModal" class="modules__form-block-input modules__form">
          <div class="form__wrapper">
            <label class="label" for="changeModalEmailInput">Новый Email:</label>
            <input type="text" id="changeModalEmailInput" class="modules__form-input" required>
          </div>
          <div class="form__wrapper">
            <label class="label label-password" for="changeModalPasswordInput">Новый пароль (необязательно):</label>
            <input type="password" id="changeModalPasswordInput" class="modules__form-input">
          </div>
          <div class="modules__form-group-btn-save-cansel">
            <button type="submit" class="modules__form-button-save-contact">Сохранить</button>
          </div>
        </form>
      </div>
    </div>
    <!-- модальное окно удаление -->
    <div id="deleteModal" class="modules">
      <div class="modules__content">
        <span class="modules__close">&times;</span>
        <h3 class="modules__title">Удалить файл 📤</h3>
        <form id="deleteFormModal" class="modules__form-block-input modules__form">
          <div class="modules__form-group-btn-save-cansel">
              <button type="submit" class="modules__form-button-save-contact">Удалить</button>
          </div>
        </form>
      </div>
    </div>
</section>
<script type="module" src="./js/admin.js"></script>
