<form action="" method="post" id="modalReadLater" class="modal popup popup__request ">
  <div class="popup-new call-back">
    <div class="popup-new__body">
      <div class="popup-new__top ">
        <p class="popup-new__title">Прочитать позже</p>
        <a data-modal="modalReadLater" class="close popup__close close-popup close-popup_request popup-new__close">
          <div class='svg popup-new__close__svg'></div>
        </a>
      </div>
      <p class="popup-new__text">Хотите прочитать статью позже? Пришлем ссылку на статью на ваш E-mail</p>
      <div class="js-mess-container" style="color:red;"></div>
      <div class="js-inputs-container popup-new__form call-back__form">
        <div class="popup-new__block-name">
          <input class="js-required js-name popup-new__input popup-new__input-name" name="name" type="text" value="" placeholder="Ваше имя"></input>
        </div>
        <div class="popup-new__block-email">
          <input class="js-required js-email popup-new__input popup-new__input-email" name="email" type="email" value="" placeholder="E-mail"></input>
        </div>
        <div class="popup-new__bottom-block">
          <button type='submit' class="popup-request button call-back__button shadow_green">Отправить</button>
        </div>
        <div class="popup-new__bottom-block__text">
          <p class="popup-new__bottom-text call-back__text">Нажимая на кнопку, вы соглашаетесь на обработку <u><a href='/personal/' class="popup-new__bottom-span">персональных данных</a></u></p>
        </div>

      </div>
    </div>
  </div>
</form>

<form action="https://echo.htmlacademy.ru" method="post" id="myModal1" class="modal popup popup__request ">
  <div class="popup-new ">
    <div class="popup-new__body">
      <div class="popup-new__top ">
        <p class="popup-new__title">Мы вам напишем</p>
        <a id="" data-modal="myModal1" class="close popup__close close-popup close-popup_request popup-new__close">
          <div class='svg popup-new__close__svg'></div>
        </a>
      </div>
      <p class="popup-new__text">Оставьте ваши данные и мы свяжемся с вами. Мы не занимаемся рассылкой рекламных сообщений, а так же не передаем контактные данные третьим лицам </p>
      <div class="popup-new__form">
        <div class="popup-new__block-name">
          <input class="popup-new__input popup-new__input-name" name="name" type="text" id="name" placeholder="Ваше имя"></input>
        </div>
        <div class="popup-new__block-email">
          <input class="popup-new__input popup-new__input-email" name="email" type="text" id="email" placeholder="Ваша почта"></input>
        </div>
        <div class="popup-new__block-text">
          <input class="popup-new__input popup-new__input-text" name="problem" type="text" id="text" placeholder="Отпишите свою проблему"></input>
        </div>
        <div class="popup-new__bottom-block">
          <button type='submit' class="popup-request button popup-new__button shadow_green">Напишите мне</button>
        </div>
        <div class="popup-new__bottom-block__text">
          <p class="popup-new__bottom-text">Нажимая на кнопку, вы соглашаетесь на обработку <u><a href='/personal/' class="popup-new__bottom-span">персональных данных</a></u></p>
        </div>

      </div>
    </div>
  </div>
</form>

<form action="" method="post" id="myModal2" class="modal popup popup__request formAuth">
  <div class="popup-new ">
    <div class="popup-new__body">
      <div class="popup-new__top ">
        <div class="personal-area">
          <p class="popup-new__title">Войти</p>
          <a href="#" class="personal-area__suptitle myBtn" data-modal="myModal3">Регистрация</a>
        </div>
        <a href="#" id="" data-modal="myModal2" class="close popup__close close-popup close-popup_request popup-new__close">
          <div class='svg popup-new__close__svg'></div>
        </a>
      </div>
      <p class="popup-new__text">Оставьте ваши данные и мы свяжемся с вами. Мы не занимаемся рассылкой рекламных сообщений, а так же не передаем контактные данные третьим лицам
      </p>
      <div class="popup-new__form personal-area__form">
        <div class="popup-new__block-name personal-area__input-b">
          <input class="popup-new__input popup-new__input-name phoneMask" type="tel" name="phone" placeholder="Ваш телефон" required></input>
        </div>
        <div class="popup-new__block-email personal-area__input-b">
          <input class="popup-new__input popup-new__input-email" type="text" name="password" placeholder="Пароль" required></input>
        </div>
        <div class="popup-new__bottom-block">
          <button type='submit' class="popup-request button popup-new__button shadow_green">Войти</button>
        </div>
        <div class="popup-new__bottom-block__text">
          <p class="popup-new__bottom-text">Нажимая на кнопку, вы соглашаетесь на обработку <u><a href='/personal/' class="popup-new__bottom-span">персональных данных</a></u></p>
        </div>
      </div>
    </div>
  </div>
</form>

<form action="" method="post" id="myModal3" class="modal popup popup__request formReg">
  <div class="popup-new ">
    <div class="popup-new__body">
      <div class="popup-new__top ">
        <div class="personal-area">
          <p class="popup-new__title">Регистрация</p>
          <a class="personal-area__suptitle myBtn" data-modal="myModal2">Войти</a>
        </div>
        <a href="#" data-modal="myModal3" class="close popup__close close-popup close-popup_request popup-new__close">
          <div class='svg popup-new__close__svg'></div>
        </a>
      </div>
      <p class="popup-new__text">Оставьте ваши данные и мы свяжемся с вами. Мы не занимаемся рассылкой рекламных сообщений, а так же не передаем контактные данные третьим лицам
      </p>
      <div class="popup-new__form registration__form">
        <div class="popup-new__block-name personal-area__input-b">
          <input class="popup-new__input popup-new__input-name phoneMask" type="tel" name="phone" placeholder="Ваш телефон" required></input>
        </div>
        <div class="popup-new__block-email personal-area__input-b">
          <input class="popup-new__input popup-new__input-email" type="text" name='password' placeholder="Пароль" required></input>
        </div>
        <div class="popup-new__block-email  personal-area__input-b registration__input-b_1">
          <input class="popup-new__input popup-new__input-email" type="text" name="password_confirm" placeholder="Пароль ещё раз" required></input>
        </div>
        <div class="popup-new__bottom-block">
          <button type='submit' class="popup-request button popup-new__button shadow_green">регистрация</button>
        </div>
        <div class="popup-new__bottom-block__text">
          <p class="popup-new__bottom-text">Нажимая на кнопку, вы соглашаетесь на обработку <u><a href='/personal/' class="popup-new__bottom-span">персональных данных</a></u></p>
        </div>
      </div>
    </div>
  </div>
</form>

<form action="https://echo.htmlacademy.ru" method="post" id="myModal4" class="modal popup popup__request ">
  <div class="popup-new order__popup">
    <div class="popup-new__body">
      <div class="popup-new__top ">
        <div class="personal-area">
          <p class="popup-new__title">Заказ в 1 клик</p>

        </div>
        <a data-modal="myModal4" class="close popup__close close-popup close-popup_request popup-new__close">
          <div class='svg popup-new__close__svg'></div>
        </a>
      </div>
      <p class="popup-new__text">Оставьте ваши данные и мы свяжемся с вами. Мы не занимаемся рассылкой рекламных сообщений, а так же не передаем контактные данные третьим лицам
      </p>
      <div class="order">
        <div class="product-card__block__img">
          <div class="product-card__img order__left__img">
            <img src="./img/main-content/product-4.jpg" id="oneClickIMG">
          </div>
        </div>
        <div class="order__right">
          <div class="product-card__top order__right__top">
            <p class="product-card__available fz-12px">
              Есть в наличии
            </p>
            <div class="stars second-block__item__stars product-card__start" id="oneClickRating">
              <div class="svg star-small star"></div>
              <div class="svg star-small star"></div>
              <div class="svg star-small star"></div>
              <div class="svg star-small star"></div>
              <div class="svg star-small star-minus"></div>
            </div>
          </div>
          <p class="product-card__title fz-16px" id="oneClickName">
            Велсон таблетки покрыт. плен. об. 3 мг, 30 шт.
          </p>
          <div class="product-card__price-block">
            <div class="product-card__price order__price" id="oneClickPrice">
              <p class="product-card__price__1 fz-24px">
                41 108 руб.
              </p>
              <p class="product-card__price__2 fz-14px">
                49 999 руб.
              </p>
            </div>
            <div class="counter order__counter">
              <div class="counter__minus">-</div>
              <div class="counter__numer" id="oneClickQuantity">1</div>
              <div class="counter__plus">+</div>
            </div>
          </div>
        </div>

      </div>
      <div class="popup-new__form order__form">
        <div class="popup-new__block-name">
          <input class="popup-new__input popup-new__input-name" type="text" id="buyOneName" name="name" placeholder="Ваше имя" required></input>
        </div>
        <div class="popup-new__block-email">
          <input class="popup-new__input popup-new__input-email phoneMask" type="tel" id="buyOnePhone" name="phone" placeholder="Телефон" required></input>
        </div>
        <div class="popup-new__bottom-block">
          <button type='submit' class="popup-request button popup-new__button shadow_green buyOneSend" data-id="">Сделать заказ</button>
        </div>
        <div class="popup-new__bottom-block__text">
          <p class="popup-new__bottom-text order__form__text">Нажимая на кнопку, вы соглашаетесь на обработку <u><a href='/personal/' class="popup-new__bottom-span">персональных данных</a></u></p>
        </div>

      </div>
    </div>
  </div>
</form>

<form action="https://echo.htmlacademy.ru" method="post" id="myModal5" class="modal popup popup__request ">
  <div class="popup-new thanks__popup">
    <div class="popup-new__body thanks__popup__body">
      <div class="popup-new__top ">
        <div class="personal-area">
        </div>
        <a data-modal="myModal5" class="close popup__close close-popup close-popup_request popup-new__close">
          <div class='svg popup-new__close__svg'></div>
        </a>
      </div>
      <div class="thanks">
        <div class="thanks__text">
          Спасибо за заявку!
          <div class="svg thanks__svg"></div>
        </div>
      </div>
    </div>
  </div>
</form>

<form action="" method="post" id="modalOutStock" class="modal popup popup__request">
  <div class="popup-new popupOutStock">
    <div class="popup-new__body">
      <div class="popup-new__top">
        <div class="personal-area">
        </div>
        <a data-modal="modalOutStock" class="close popup__close close-popup close-popup_request popup-new__close">
          <div class='svg popup-new__close__svg'></div>
        </a>
      </div>
      <div>
        Товары, отмеченные <span style="color: red;">***</span> недоступны для получения в выбранной аптеке в указанном количестве. Пожалуйста, удалите эти товары из заказа или уменьшите их количество, либо выберите другую аптеку. Обратите внимание, что при изменении выбранной аптеки стоимость заказа может измениться.
      </div>
    </div>
  </div>
</form>

<form action="" method="post" id="myModal6" class="modal popup popup__request sendForm" data-title="Мы вам перезвоним">
  <div class="popup-new call-back">
    <div class="popup-new__body">
      <div class="popup-new__top ">
        <p class="popup-new__title">Мы вам перезвоним</p>
        <a data-modal="myModal6" class="close popup__close close-popup close-popup_request popup-new__close">
          <div class='svg popup-new__close__svg'></div>
        </a>
      </div>
      <p class="popup-new__text">Оставьте ваши данные и мы свяжемся с вами. Мы не занимаемся рассылкой рекламных сообщений, а так же не передаем контактные данные третьим лицам </p>
      <div class="popup-new__form call-back__form">
        <div class="popup-new__block-name">
          <input class="popup-new__input popup-new__input-name" name="name" type="text" placeholder="Ваше имя" required>
        </div>
        <div class="popup-new__block-email">
          <input class="popup-new__input popup-new__input-email" name="phone" type="tel" placeholder="Телефон" required>
        </div>
        <div class="popup-new__bottom-block">
          <button type='submit' class="popup-request button call-back__button shadow_green">Перезвоните мне</button>
        </div>
        <div class="popup-new__bottom-block__text">
          <p class="popup-new__bottom-text call-back__text">Нажимая на кнопку, вы соглашаетесь на обработку <u><a href='/personal/' class="popup-new__bottom-span">персональных данных</a></u></p>
        </div>

      </div>
    </div>
  </div>
</form>

<form action="https://echo.htmlacademy.ru" method="post" id="myModal8" class="modal popup popup__request ">
  <div class="popup-new call-back">
    <div class="popup-new__body">
      <div class="popup-new__top ">
        <p class="popup-new__title">Товара нет в наличии?</p>
        <a data-modal="myModal8" class="close popup__close close-popup close-popup_request popup-new__close">
          <div class='svg popup-new__close__svg'></div>
        </a>
      </div>
      <p class="popup-new__text">Оставьте ваши данные и мы свяжемся с вами. Мы не занимаемся рассылкой рекламных сообщений, а так же не передаем контактные данные третьим лицам </p>
      <div class="popup-new__form call-back__form">
        <div class="popup-new__block-name">
          <input class="popup-new__input popup-new__input-name" name="name" type="text" id="name" placeholder="Ваше имя"></input>
        </div>
        <div class="popup-new__block-email">
          <input class="popup-new__input popup-new__input-email" name="tell" type="text" id="tell" placeholder="Телефон"></input>
        </div>
        <div class="popup-new__bottom-block">
          <button type='submit' class="popup-request button call-back__button shadow_green">Перезвоните мне</button>
        </div>
        <div class="popup-new__bottom-block__text">
          <p class="popup-new__bottom-text call-back__text">Нажимая на кнопку, вы соглашаетесь на обработку <u><a href='/personal/' class="popup-new__bottom-span">персональных данных</a></u></p>
        </div>

      </div>
    </div>
  </div>
</form>

<form action="https://echo.htmlacademy.ru" method="post" id="myModal9" class="modal popup popup__request ">
  <div class="popup-new call-back">
    <div class="popup-new__body">
      <div class="popup-new__top ">
        <p class="popup-new__title">Служебные страницы</p>
        <a data-modal="myModal9" class="close popup__close close-popup close-popup_request popup-new__close">
          <div class='svg popup-new__close__svg'></div>
        </a>
      </div>
      <div class="service-page__section">
        <div class="_container service-page">
          <div class="service-page__grid">
            <div class="service-page__block">
              <h3 class="section__title">Интернет-заказ</h3>
              <ul class="medicine__ul">
                <li class="medicine__li">
                  <a href="#" class="medicine__link">
                    <p>
                      Каталог
                    </p>
                    <div class="svg categories-block__item-svg medicine__link__svg"></div>
                  </a>
                </li>
                <li class="medicine__li">
                  <a href="#" class="medicine__link">
                    <p>
                      Как сделать заказ
                    </p>
                    <div class="svg categories-block__item-svg medicine__link__svg"></div>
                  </a>
                </li>
                <li class="medicine__li">
                  <a href="#" class="medicine__link">
                    <p>
                      Блог о здоровье
                    </p>
                    <div class="svg categories-block__item-svg medicine__link__svg"></div>
                  </a>
                </li>
                <li class="medicine__li">
                  <a href="#" class="medicine__link">
                    <p>
                      Вопросы и ответы
                    </p>
                    <div class="svg categories-block__item-svg medicine__link__svg"></div>
                  </a>
                </li>
                <li class="medicine__li">
                  <a href="#" class="medicine__link">
                    <p>
                      Корзина
                    </p>
                    <div class="svg categories-block__item-svg medicine__link__svg"></div>
                  </a>
                </li>


              </ul>
            </div>
            <div class="service-page__block">
              <h3 class="section__title">Покупателям</h3>
              <ul class="medicine__ul">

                <li class="medicine__li">
                  <a href="#" class="medicine__link">
                    <p>
                      Бонусные карты
                    </p>
                    <div class="svg categories-block__item-svg medicine__link__svg"></div>
                  </a>
                </li>
                <li class="medicine__li">
                  <a href="#" class="medicine__link">
                    <p>
                      Партнеры в Европе
                    </p>
                    <div class="svg categories-block__item-svg medicine__link__svg"></div>
                  </a>
                </li>
                <li class="medicine__li">
                  <a href="#" class="medicine__link">
                    <p>
                      Подарочные сертификаты
                    </p>
                    <div class="svg categories-block__item-svg medicine__link__svg"></div>
                  </a>
                </li>
                <li class="medicine__li">
                  <a href="#" class="medicine__link">
                    <p>
                      Заказ редкого лекарства
                    </p>
                    <div class="svg categories-block__item-svg medicine__link__svg"></div>
                  </a>
                </li>
                <li class="medicine__li">
                  <a href="#" class="medicine__link">
                    <p>
                      Оставить отзыв
                    </p>
                    <div class="svg categories-block__item-svg medicine__link__svg"></div>
                  </a>
                </li>


              </ul>
            </div>
            <div class="service-page__block">
              <h3 class="section__title">О компании</h3>
              <ul class="medicine__ul">

                <li class="medicine__li">
                  <a href="#" class="medicine__link">
                    <p>
                      Общая информация
                    </p>
                    <div class="svg categories-block__item-svg medicine__link__svg"></div>
                  </a>
                </li>
                <li class="medicine__li">
                  <a href="#" class="medicine__link">
                    <p>
                      Новости
                    </p>
                    <div class="svg categories-block__item-svg medicine__link__svg"></div>
                  </a>
                </li>
                <li class="medicine__li">
                  <a href="#" class="medicine__link">
                    <p>
                      Статьи
                    </p>
                    <div class="svg categories-block__item-svg medicine__link__svg"></div>
                  </a>
                </li>
                <li class="medicine__li">
                  <a href="#" class="medicine__link">
                    <p>
                      Аптека Сервис Плюс

                    </p>
                    <div class="svg categories-block__item-svg medicine__link__svg"></div>
                  </a>
                </li>
                <li class="medicine__li">
                  <a href="#" class="medicine__link">
                    <p>
                      Вакансии
                    </p>
                    <div class="svg categories-block__item-svg medicine__link__svg"></div>
                  </a>
                </li>
                <li class="medicine__li">
                  <a href="#" class="medicine__link">
                    <p>
                      Журнал
                    </p>
                    <div class="svg categories-block__item-svg medicine__link__svg"></div>
                  </a>
                </li>
                <li class="medicine__li">
                  <a href="#" class="medicine__link">
                    <p>
                      Контакты
                    </p>
                    <div class="svg categories-block__item-svg medicine__link__svg"></div>
                  </a>
                </li>


              </ul>
            </div>
            <div class="service-page__block">
              <h3 class="section__title">Аптеки</h3>
              <ul class="medicine__ul">

                <li class="medicine__li">
                  <a href="#" class="medicine__link">
                    <p>
                      Каталог
                    </p>
                    <div class="svg categories-block__item-svg medicine__link__svg"></div>
                  </a>
                </li>
                <li class="medicine__li">
                  <a href="#" class="medicine__link">
                    <p>
                      Как сделать заказ

                    </p>
                    <div class="svg categories-block__item-svg medicine__link__svg"></div>
                  </a>
                </li>
                <li class="medicine__li">
                  <a href="#" class="medicine__link">
                    <p>
                      Вопросы и ответы

                    </p>
                    <div class="svg categories-block__item-svg medicine__link__svg"></div>
                  </a>
                </li>
                <li class="medicine__li">
                  <a href="#" class="medicine__link">
                    <p>
                      Корзина
                    </p>
                    <div class="svg categories-block__item-svg medicine__link__svg"></div>
                  </a>
                </li>


              </ul>
            </div>
            <div class="service-page__block">
              <h3 class="section__title">Партнерам</h3>
              <ul class="medicine__ul">

                <li class="medicine__li">
                  <a href="#" class="medicine__link">
                    <p>
                      Арендодателям
                    </p>
                    <div class="svg categories-block__item-svg medicine__link__svg"></div>
                  </a>
                </li>
                <li class="medicine__li">
                  <a href="#" class="medicine__link">
                    <p>
                      Рекламодателям
                    </p>
                    <div class="svg categories-block__item-svg medicine__link__svg"></div>
                  </a>
                </li>
                <li class="medicine__li">
                  <a href="#" class="medicine__link">
                    <p>
                      Юридическим лицам
                    </p>
                    <div class="svg categories-block__item-svg medicine__link__svg"></div>
                  </a>
                </li>


              </ul>
            </div>
            <div class="service-page__block">
              <h3 class="section__title">Проекты и акции</h3>
              <ul class="medicine__ul">

                <li class="medicine__li">
                  <a href="#" class="medicine__link">
                    <p>
                      Проекты
                    </p>
                    <div class="svg categories-block__item-svg medicine__link__svg"></div>
                  </a>
                </li>
                <li class="medicine__li">
                  <a href="#" class="medicine__link">
                    <p>
                      Акции
                    </p>
                    <div class="svg categories-block__item-svg medicine__link__svg"></div>
                  </a>
                </li>


              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
