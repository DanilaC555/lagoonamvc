
    <section class="register">
      <div class="container">
        <div class="register__main">
          <h2 class="title title__register">Регистрация</h2>
              <form class="form form__register flex" id="registerForm">
                <p class="error" id="registerError"></p>
                <input class="form__input" required type="name" id="name" placeholder="Login*">
                <input class="form__input" required type="email" id="email" placeholder="Email*">
                <input class="form__input" required type="password" id="password" placeholder="Password*">
                <div class="form__label">
                  <button class="footer__btn btn btn-reset" type="submit">Зарегестрироваться</button>
                  <label class="custom-checkbox">
                    <input class="form__label-input form__label-input--fuctional" required type="checkbox">
                    <span class="form__label-text form__label-text--functional">Согласен на обработку данных</span>
                  </label>
                </div>
                <a class="form__link" href="/">Выйти на главныю страницы</a>
              </form>
        </div>
      </div>
    </section>
    <script type="module" defer src="./js/register.js"></script>
