<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$request = $context->getRequest();
$action = $request->getPost('action');

if ($action == 'sendForm'){ // отправка заявки
  $mailFields = array(
    "FORM" => $request->getPost('title'),
    "NAME" => $request->getPost('name'),
    "PHONE" => $request->getPost('phone'),
    "TOPIC" => $request->getPost('topic'),
    "EMAIL" => $request->getPost('email'),
    "TEXT" => $request->getPost('text'),
    "PAGE" => $_SERVER['HTTP_REFERER'],
    "IP" => $_SERVER['REMOTE_ADDR']
  );
  $event = ($mailFields['TOPIC']) ? 'SEND_FORM_FULL' : 'SEND_FORM';
  if (CEvent::Send($event, "s1", $mailFields)) echo '<p>Спасибо! Ваше сообщение отправлено!</p>';
  else echo '<p>Ошибка! Данные не отправлены!</p>';
}
elseif ($action == 'buyOne') // купить в 1 клик
{
    $mailFields = array(
        "NAME" => $request->getPost('buyOneName'),
        "PHONE" => $request->getPost('buyOnePhone'),
        "PRODUCT" => $request->getPost('oneClickName'),
        "PRICE" => $request->getPost('oneClickPrice'),
        "QNT" => $request->getPost('quantity'),
        "ID" => $request->getPost('productID'),
        "PAGE" => $_SERVER['HTTP_REFERER'],
        "IP" => $_SERVER['REMOTE_ADDR']
    );
    $event = 'SEND_BUY_ONE';
    if (CEvent::Send($event, "s1", $mailFields)) echo '<p>Спасибо! Ваше сообщение отправлено!</p>';
    else echo '<p>Ошибка! Данные не отправлены!</p>';
}
elseif ($action == 'sendAuth') // авторизация
{
  $login = $request->getPost('login');
  $password = $request->getPost('password');

  global $USER;
  if (!is_object($USER)) $USER = new CUser;
  $arResult = $USER->Login($login, $password, "Y");
  echo json_encode($arResult);
}
elseif ($action == 'sendReg') // регистрация
{
  $login = $request->getPost('login');
  $password = $request->getPost('password');
  $passwordConfirm = $request->getPost('passwordConfirm');

  global $USER;
  $arResult = $USER->Register($login, "", "", $password, $passwordConfirm, "");
  echo json_encode($arResult);
}
elseif ($action == 'sendRestore') // восстановить пароль
{
  $login = $request->getPost('login');

  global $USER;
  $arResult = $USER->SendPassword($USER->GetLogin(), $USER->GetParam("EMAIL"));
  echo json_encode($arResult);
}
elseif ($action == 'sendReview') // отзыв
{
  \Bitrix\Main\Loader::includeModule('highloadblock');

  $hlBlockID = 9; // id HL
  $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById($hlBlockID)->fetch();
  $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
  $entity_data_class = $entity->getDataClass();

  $arField = [
    'UF_NAME' => $request->getPost('name'),
    'UF_EMAIL' => $request->getPost('email'),
    'UF_TEXT' => $request->getPost('text'),
    'UF_SCORE' => $request->getPost('score'),
    'UF_CITY' => $request->getPost('city'),
  ];

  $result = $entity_data_class::add($arField);
  $ID = $result->getId();
  if ($ID) echo 'Отзыв успешно добавлен!';
  else echo 'Ошибка добавления отзыва!';
}
elseif ($action == 'reviewLike') // лайк отзыва
{
  \Bitrix\Main\Loader::includeModule('highloadblock');

  $reviewID = $request->getPost('id');
  $type = $request->getPost('type');

  $arElHL = getElHL(9,[],['ID'=>$reviewID],['ID','UF_LIKE','UF_DISLIKE']);
  $arReview = $arElHL[$reviewID];

  if ($type == 'like') $arReview['UF_LIKE']++;
  elseif ($type == 'dislike') $arReview['UF_DISLIKE']++;

  $hlBlockID = 9; // id HL
  $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById($hlBlockID)->fetch();
  $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
  $entity_data_class = $entity->getDataClass();

  $arField = [
    'UF_LIKE' => $arReview['UF_LIKE'],
    'UF_DISLIKE' => $arReview['UF_DISLIKE'],
  ];

  $result = $entity_data_class::update($reviewID,$arField);
  $ID = $result->getId();
  if ($ID) echo '1';
  else echo '0';
}
elseif ($action == 'sendPromo') // промокод
{
  \Bitrix\Main\Loader::includeModule('sale');

  // код купона, который следует применить к корзине
  $coupon = $request->getPost('promo');

  $arInfo = \Bitrix\Sale\DiscountCouponsManager::getData($coupon);

  if ($arInfo['DISCOUNT_NAME'])
  {
    // применяем купон
    \Bitrix\Sale\DiscountCouponsManager::add($coupon);

    // получаем объект корзины для текущего пользователя
    $oBasket = \Bitrix\Sale\Basket::loadItemsForFUser(
      \Bitrix\Sale\Fuser::getId(),
      \Bitrix\Main\Context::getCurrent()->getSite()
    );

    // получаем объект скидок для корзины
    $oDiscounts = \Bitrix\Sale\Discount::loadByBasket($oBasket);

    // обновляем поля в корзине
    $oBasket->refreshData(['PRICE','COUPONS']);

    // пересчёт скидок для корзины
    $oDiscounts->calculate();

    // получаем результаты расчёта скидок для корзины
    $result = $oDiscounts->getApplyResult();

    if ($result['DISCOUNT_LIST']) $arResult['result'] = 'ok';
    else $arResult['result'] = 'no';
  }
  else $arResult['result'] = 'no';

  echo json_encode($arResult);
}
