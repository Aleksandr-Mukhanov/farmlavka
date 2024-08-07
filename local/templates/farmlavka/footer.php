<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)die();?>
</main>

<footer class="footer">
  <div class="_container footer_container">
    <div class="footer__main-body">
      <div class="footer__question__position">
        <div class="footer__question__body">
          <p class="footer__question__title">Остались вопросы?</p>
          <form class="footer__question__form sendForm" action="" method="post" data-title="Остались вопросы">
            <input class="footer__question__input footer__question__name" id="name" placeholder="Иванов Иван Иванович" name="name" type="text"/>
            <input class="footer__question__input footer__question__number phoneMask" id="number" placeholder="+7 (___) ___-__-__" name="phone" type="tel" required/>
            <p class="footer__question__text">
              Нажимая на кнопку, вы соглашаетесь на обработку
              <a href="/personal/" class="footer__question__span">персональных данных</a>
            </p>
            <!-- <a class="button footer__button myBtn" data-modal="myModal5">Задать вопрос</a> -->
            <button class="button footer__button myBtn" type="submit">Задать вопрос</button>
          </form>
        </div>
      </div>
      <div class="footer__body">
        <div class="footer__block">
          <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "inc",
              "EDIT_TEMPLATE" => "",
              "PATH" => "/local/include/footer_logo.php"
            )
          );?>
          <p class="footer__rights">
            <?$APPLICATION->IncludeComponent(
              "bitrix:main.include",
              "",
              Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/local/include/footer_copy.php"
              )
            );?>
          </p>
        </div>
        <?$APPLICATION->IncludeComponent("bitrix:menu", "bottom", Array(
        	"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
        		"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
        		"DELAY" => "N",	// Откладывать выполнение шаблона меню
        		"MAX_LEVEL" => "1",	// Уровень вложенности меню
        		"MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
        			0 => "",
        		),
        		"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
        		"MENU_CACHE_TYPE" => "A",	// Тип кеширования
        		"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
        		"ROOT_MENU_TYPE" => "bottom",	// Тип меню для первого уровня
        		"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
        	),
        	false
        );?>
        <div class="footer__contacts">
          <div class="footer__contacts-block">
            <a href="mailto:<?=$arSetting['email']?>" class="header__contact">
              <div class="svg header__contact__svg header__contact__svg__email"></div>
              <p class="header__contact__title footer__contact__title">
                <?=$arSetting['email']?>
              </p>
              <p class="header__contact__suptitle footer__contact__suptitle">
                Напишите нам
              </p>
            </a>
            <a href="tel:<?=formatPhone($arSetting['phone_1'])?>" class="header__contact footer__contact__last">
              <div class="svg header__contact__svg"></div>
              <p class="header__contact__title footer__contact__title">
                <?=$arSetting['phone_1']?>
              </p>
              <p class="header__contact__suptitle footer__contact__suptitle">
                Круглосуточно
              </p>
            </a>
          </div>
          <!-- <div class="footer__messages">
            <a href="<?=$arSetting['vk']?>" class="svg footer__massege footer__massege-1" target="_blank"></a>
            <a href="<?=$arSetting['facebook']?>" class="svg footer__massege footer__massege-2" target="_blank"></a>
            <a href="<?=$arSetting['ok']?>" class="svg footer__massege footer__massege-3" target="_blank"></a>
            <a href="<?=$arSetting['twitter']?>" class="svg footer__massege footer__massege-4" target="_blank"></a>
            <a href="<?=$arSetting['instagram']?>" class="svg footer__massege footer__massege-5" target="_blank"></a>
            <a href="<?=$arSetting['youtube']?>" class="svg footer__massege footer__massege-6" target="_blank"></a>
          </div> -->
        </div>
        <p class="footer__text">
          <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "inc",
              "EDIT_TEMPLATE" => "",
              "PATH" => "/local/include/footer_text.php"
            )
          );?>
        </p>
      </div>
    </div>
  </div>
</footer>

<?$APPLICATION->IncludeComponent(
  "bitrix:main.include",
  "",
  Array(
    "AREA_FILE_SHOW" => "file",
    "AREA_FILE_SUFFIX" => "inc",
    "EDIT_TEMPLATE" => "",
    "PATH" => "/local/include/forms.php"
  )
);?>

</body>
</html>
