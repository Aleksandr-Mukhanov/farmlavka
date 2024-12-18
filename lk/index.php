<?//define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");

global $USER;
$userID = $USER->GetID();

$request = $context->getRequest();
$sendForm = $request->getPost('sendForm');
$userFIO = $request->getPost('FIO');
$userBirthday = $request->getPost('BIRTHDAY');
$userGender = $request->getPost('GENDER');
$userEmail = $request->getPost('EMAIL');
$new_password = $request->getPost("NEW_PASSWORD");
$confirm_password = $request->getPost("CONFIRM_PASSWORD");

// получим пользователя
$by = 'id'; $order = 'desc';
$arFilter = ['ID' => $userID];
$arParams = [
  'FIELDS' => ['ID','PERSONAL_BIRTHDAY','PERSONAL_GENDER'],
  // 'SELECT' => ['UF_*']
];
$rsUsers = CUser::GetList($by, $order, $arFilter, $arParams);
$arUser = $rsUsers->Fetch();
// dump($_REQUEST);
if ($sendForm) {
  $user = new CUser;
  if ($userFIO) {
    $arUserFIO = explode(' ',$userFIO); // dump($arUserFIO);
    $arFieldsUser['LAST_NAME'] = $arUserFIO[0];
    $arFieldsUser['NAME'] = $arUserFIO[1];
    $arFieldsUser['SECOND_NAME'] = $arUserFIO[2];
  }
  if ($userBirthday) {
    $arUserBirthday = explode('-',$userBirthday);
    $userBirthday = $arUserBirthday[2].'.'.$arUserBirthday[1].'.'.$arUserBirthday[0];
    $arFieldsUser['PERSONAL_BIRTHDAY'] = $userBirthday;
  }
  $arFieldsUser['PERSONAL_GENDER'] = $userGender;
  $arFieldsUser['EMAIL'] = $userEmail;

  if ($new_password) {
    $arFieldsUser['PASSWORD'] = $new_password;
    $arFieldsUser['PASSWORD_CONFIRM'] = $confirm_password;
  }

  if($user->Update($userID,$arFieldsUser))
    $arResult['USER'] = $arFieldsUser;
  else
    echo $user->LAST_ERROR;
}

$rsStatus = CSaleStatus::GetList([],[],false,false,['ID','NAME']);
while ($arStatusDB = $rsStatus->Fetch())
  $arStatus[$arStatusDB['ID']] = $arStatusDB['NAME'];

// получим заказы
$rsSales = \CSaleOrder::GetList(
  ['ID'=>'DESC'],['USER_ID' => $userID],false,false,['ID','DATE_INSERT','STATUS_ID']
);
while ($arSalesDB = $rsSales->Fetch()){ // dump($arSalesDB);
  $arDate = explode(' ',$arSalesDB['DATE_INSERT']);
  $arSalesDB['DATE'] = $arDate[0];
  $arSales[] = $arSalesDB;
  $arOrderIds[] = $arSalesDB['ID'];
}

$dbBasketItems = CSaleBasket::GetList(
  [],
  [
    'ORDER_ID' => $arOrderIds
  ],
  false,
  false,
  []
);
while ($arItems = $dbBasketItems->Fetch())
{
  $arItemIds[] = $arItems['PRODUCT_ID'];
  $arOrderItems[$arItems['ORDER_ID']][] = $arItems;
}

// получим фото товаров
$arOrder = ['SORT'=>'ASC'];
$arFilter = ['IBLOCK_ID'=>1,'ID'=>$arItemIds];
$arSelect = ['ID','PREVIEW_PICTURE'];
$rsElements = CIBlockElement::GetList($arOrder,$arFilter,false,false,$arSelect);
while ($arElement = $rsElements->Fetch()) {
  $arBasketItems[$arElement['ID']]['IMG'] = CFile::GetPath($arElement['PREVIEW_PICTURE']);
}
// dump($arOrderItems);
?>
<div class="_container personal-area__a-main">
  <div class="a-main__a-left">
    <ul class="a-left__items">
      <li class="a-left__item">
        <a href="#a-content" class="a-left__item-body">
          <p class="a-left__text">Личные данные</p>
        </a>
      </li>
      <li class="a-left__item">
        <a href="#order" class="a-left__item-body">
          <p class="a-left__text">Ваши заказы</p>
        </a>
      </li>
      <li class="a-left__item">
        <a href="#feedback" class="a-left__item-body">
          <p class="a-left__text">Обратная связь</p>
        </a>
      </li>
      <?if($userID):?>
        <li class="a-left__item">
          <a href="?logout=yes&<?=bitrix_sessid_get()?>" class="a-left__item-body">
            <p>Выйти</p>
          </a>
        </li>
      <?endif;?>
    </ul>
  </div>
  <div class="a-main__a-right">
    <?if (!$USER->IsAuthorized()):?>
      <div class="block_auth">
        <h3 class="footer__question__title feedback__title">Вы не авторизованы!</h3>
        <br>
        <p>Авторизировавшись, вы сможете управлять своими личными данными и следить за состоянием заказов.</p>
        <br>
        <p><a class="popup-new__bottom-span myBtn" data-modal="myModal2">Авторизация</a> | <a class="popup-new__bottom-span myBtn" data-modal="myModal3">Регистрация</a><p>
      </div>
    <?else:?>
      <form class="a-right__a-content" id="a-content" action="" method="post">
        <h3 class="footer__question__title feedback__title">Личный данные</h3>
        <div class="a-content__input-block">
          <input class="a-content__input" name="FIO" placeholder="Укажите фамилию, имя и отчество" value="<?=$USER->GetFullName()?>">
        </div>
        <p class="a-right__suptitle">Дата рождения</p>
        <div class="a-content__block-inputs">
          <div class="a-content__input-item">
            <input class="a-content-i" type="date" placeholder="Дата рождения" name="BIRTHDAY" value="<?=$arUser['PERSONAL_BIRTHDAY_DATE']?>">
          </div>
          <div class="a-content__input-item">
            <select class="a-content-i" name="GENDER" placeholder="Пол">
              <option value="">Пол</option>
              <option value="M" <?if($arUser['PERSONAL_GENDER'] == 'M')echo 'selected'?>>Мужской</option>
              <option value="F" <?if($arUser['PERSONAL_GENDER'] == 'F')echo 'selected'?>>Женский</option>
            </select>
          </div>
        </div>
        <div class="a-content__input-block">
          <input class="a-content__input" name="EMAIL" placeholder="Электронная почта" value="<?=$USER->GetEmail()?>">
        </div>
        <div class="a-content__input-block">
          <input class="a-content__input phoneMask" name="PHONE" placeholder="Телефон" value="<?=$USER->GetLogin()?>">
        </div>
        <div class="a-content__input-block">
          <input class="a-content__input" name="NEW_PASSWORD" placeholder="Новый пароль">
        </div>
        <div class="a-content__input-block">
          <input class="a-content__input" name="CONFIRM_PASSWORD" placeholder="Подтверждение">
        </div>
        <div class="a-content__block-button">
          <button type="submit" class="button a-content__button" name="sendForm" value="Y">Сохранить</button>
        </div>
      </form>

      <div id="order" class="checkout__ch-order display-none">
        <h3 class="footer__question__title">Ваш заказ</h3>
        <table class="ch-order__table">
          <tbody>
            <tr>
              <td class="a-order__text-1">16.12.2021</td>
              <td class="a-order__text-2">Заказ №:154544516</td>
              <td class="a-order__text-3">Выполнен</td>
            </tr>
            <tr class="ch-order__tr">
              <td class="ch-order__td">
                <div class="b-order__right">
                  <div class="product-card__block__img b-order__block-img">
                    <div class="product-card__img ch-order__p-img ">
                      <img class="b-order__img ch-order__img" src="./img/main-content/product-3.jpg" alt="таблетка">
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <div class="order__right ch-order__right">
                  <p class="product-card__title fz-16px">
                    Велсон таблетки покрыт. плен. об. 3 мг, 30 шт.
                  </p>
                </div>
              </td>
              <td class="ch-order__td">
                <div class="product-card__price ch-order__price a-ch-order__price">
                  <p class="product-card__price__1 a-ch-order__card_1 fz-24px">
                    41 108 руб.
                  </p>
                  <div class="ch-order__card_2 a-ch-order__td">
                    <p class="product-card__price__2 ch-order__card_2__text fz-14px">
                      49 999 руб.
                    </p>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <?foreach ($arSales as $order) {?>
        <div class="checkout__ch-order personal-area__order-b">
          <h3 class="footer__question__title">Ваш заказ</h3>
          <table class="ch-order__table">
            <thead class="ch-order__thead">
              <tr class="ch-order__tr-1">
                <td class="ch-order__td-1">
                  <p class="ch-order__td-1_1"><?=$order['DATE']?></p>
                  <p class="ch-order__td-1_2">Заказ №:<?=$order['ID']?></p>
                </td>
                <td class="ch-order__td-2"><?=$arStatus[$order['STATUS_ID']]?></td>
              </tr>
            </thead>
            <tbody>
              <?foreach ($arOrderItems[$order['ID']] as $orderItems) {
                $arProductID[] = $orderItems['PRODUCT_ID'];?>
                <tr class="ch-order__tr">
                  <td class="ch-order__td">
                    <div class="b-order__right">
                      <div class="product-card__block__img b-order__block-img">
                        <div class="product-card__img ch-order__p-img ">
                          <img class="b-order__img ch-order__img" src="<?=$arBasketItems[$orderItems['PRODUCT_ID']]['IMG']?>" alt="<?=$orderItems['NAME']?>">
                        </div>
                      </div>
                      <div class="order__right ch-order__right">
                        <p class="product-card__title fz-16px">
                          <a href="<?=$orderItems['DETAIL_PAGE_URL']?>"><?=$orderItems['NAME']?></a>
                          <span>(<?=round($orderItems['QUANTITY'])?> шт)</span>
                        </p>
                      </div>
                    </div>
                  </td>
                  <td class="ch-order__td ">
                    <div class="product-card__price ch-order__price pa__order__price">
                      <p class="product-card__price__1 ch-order__card_1 pa__order__card_1 fz-24px">
                        <?=formatPrice($orderItems['QUANTITY'] * $orderItems['PRICE'])?> ₽
                      </p>
                      <?if($orderItems['DISCOUNT_PRICE']>0):?>
                        <div class="ch-order__card_2">
                          <p class="product-card__price__2 ch-order__card_2__text fz-14px">
                            <?=formatPrice($orderItems['QUANTITY'] * $orderItems['BASE_PRICE'])?> ₽
                          </p>
                        </div>
                      <?endif;?>
                    </div>
                  </td>
                </tr>
              <?}?>
            </tbody>
          </table>
          <div class="ch-order__cht-bottom">
            <a href="/info/reviews/#feedbackAdd" class="button">Оставить отзыв</a>
            <a href="/cart/" class="button cht-bottom__button orderRepeat" data-id="<?=implode(',',$arProductID)?>">Повторить заказ</a>
            <?if(!in_array($order['STATUS_ID'],['V','F'])):?>
              <a href="/lk/" class="button cht-bottom__button orderCancel" data-id="<?=$order['ID']?>">Отменить заказ</a>
            <?endif;?>
          </div>
        </div>
      <?}?>
    <?endif;?>

    <form class="feedback sendForm" id="feedback" action="" method="post" data-title="Обратная связь">
      <h3 class="footer__question__title feedback__title">Обратная связь</h3>
      <div class="feedback__body">
        <p class="feedback__text-1">Разнообразный и богатый опыт сложившаяся структура организации требуют определения и уточнения модели развития.</p>
        <p class="feedback__text-2">Идейные соображения высшего порядка, а также сложившаяся структура организации играет важную роль в формировании систем массового участия.</p>
        <div class="a-content__input-item">
          <input class="a-content-i" type="text" placeholder="Выбрать тему обращения" name="topic">
        </div>
        <div class="a-content__input-item">
          <input class="a-content-i" type="text" placeholder="Фамилия, Имя и Отчество" name="name" value="<?=$USER->GetFullName()?>" required>
        </div>
        <div class="a-content__flex">
          <div class="a-content__input-item">
            <input class="a-content-i phoneMask" type="tel" placeholder="Телефон" name="phone" value="<?=$USER->GetLogin()?>" required>
          </div>
          <div class="a-content__input-item">
            <input class="a-content-i" type="email" placeholder="Ваша почта" name="email" value="<?=$USER->GetEmail()?>">
          </div>
        </div>
        <div class="a-content__input-item">
          <input class="a-content-i" type="text" placeholder="Текст сообщения" name="text" required>
        </div>
        <div class="a-content__bottom">
          <button type="submit" class="button a-content__button">Сохранить</button>
          <p class="popup-new__bottom-text call-back__text">Нажимая на кнопку, вы соглашаетесь на обработку <u><a href="#" class="popup-new__bottom-span">персональных данных</a></u></p>
        </div>
      </div>
    </form>

  </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
