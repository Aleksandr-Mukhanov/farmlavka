<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

echo 'ok<br>';

\Bitrix\Main\Loader::includeModule('sale');

// код купона, который следует применить к корзине
$coupon = 'SL-5WFJS-EMD4IO2S';

// $arInfo = \Bitrix\Sale\DiscountCouponsManager::getData($coupon);
// dump($arInfo);
// // применяем купон
// \Bitrix\Sale\DiscountCouponsManager::add($coupon);
//
// // получаем объект корзины для текущего пользователя
// $oBasket = \Bitrix\Sale\Basket::loadItemsForFUser(
//   \Bitrix\Sale\Fuser::getId(),
//   \Bitrix\Main\Context::getCurrent()->getSite()
// );
//
// // получаем объект скидок для корзины
// $oDiscounts = \Bitrix\Sale\Discount::loadByBasket($oBasket);
//
// // обновляем поля в корзине
// $oBasket->refreshData(['PRICE','COUPONS']);
//
// // пересчёт скидок для корзины
// $oDiscounts->calculate();
//
// // получаем результаты расчёта скидок для корзины
// $result = $oDiscounts->getApplyResult();
// dump($result);
