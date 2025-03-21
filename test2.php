<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

echo 'ok<br>';

use Bitrix\Main\Loader,
    Bitrix\Main\Context,
    Bitrix\Currency\CurrencyManager,
    Bitrix\Sale\Order,
    Bitrix\Sale\Basket,
    Bitrix\Sale\Delivery,
    Bitrix\Sale\PaySystem;

\Bitrix\Main\Loader::includeModule('sale');
\Bitrix\Main\Loader::includeModule('catalog');

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

// отправка почты
// if (mail('mukhanov.au@gmail.com','test1','test1'))
// 	echo 'ok gmail';
// else
// 	echo 'no gmail';
//
// echo '<br>';
//
// if (mail('mukhanov.au@ya.ru','test2','test2'))
// 	echo 'ok ya';
// else
// 	echo 'no ya';
//
// echo '<br>';
//
// if (mail('muxa___@mail.ru','test3','test3'))
// 	echo 'ok mail';
// else
// 	echo 'no mail';

// $orderID = 320;
// $order = Order::load($orderID);
// $paymentCollection = $order->getPaymentCollection();
// foreach ($paymentCollection as $payment) {
//   $psID = $payment->getPaymentSystemId(); dump($psID);
//   $paySystemObject = PaySystem\Manager::getObjectById($psID); // dump($paySystemObject);
//   $paySystemBufferedOutput = $paySystemObject->initiatePay($payment, null, PaySystem\BaseServiceHandler::STRING);
//   dump($paySystemBufferedOutput);
//   $arDate['url_pay'] = $paySystemBufferedOutput->getTemplate();
//   dump($arDate);
// }
