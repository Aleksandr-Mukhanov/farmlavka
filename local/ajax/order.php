<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
// echo 'cart ok <br>';

use Bitrix\Main\Loader,
    Bitrix\Main\Config\Option,
    Bitrix\Main\Context,
    Bitrix\Currency\CurrencyManager,
    Bitrix\Sale,
    Bitrix\Sale\Order,
    Bitrix\Sale\Basket,
    Bitrix\Sale\Delivery,
    Bitrix\Sale\PaySystem;

Loader::includeModule("sale");
Loader::includeModule("catalog");

$action = $_REQUEST['action'];
$productID = $_REQUEST['productID'];
$quantity = ($_REQUEST['quantity']) ? $_REQUEST['quantity'] : 1;
$buyOneName = $_REQUEST['buyOneName'];
$buyOnePhone = $_REQUEST['buyOnePhone'];
$buyOneMail = $_REQUEST['buyOneMail'];

$siteID = Context::getCurrent()->getSite();
$userID = Sale\Fuser::getId();

if ($action == 'cart_add') // добавление в корзину
{
    $basket = Sale\Basket::loadItemsForFUser($userID, $siteID);

    // добавим в корзину
    if ($item = $basket->getExistsItem('catalog', $productID)) {
        $item->setField('QUANTITY', $item->getQuantity() + $quantity);
    }
    else
    {
        $item = $basket->createItem('catalog', $productID);
        $item->setFields([
            'QUANTITY' => $quantity,
            'CURRENCY' => CurrencyManager::getBaseCurrency(),
            'LID' => $siteID,
            'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
        ]);
    }
    // $basket->refresh();
    $basket->save();
}
elseif (in_array($action,['cart_change','cart_del_el','cart_clear'])) // редактирование корзины
{
    $basket = Sale\Basket::loadItemsForFUser($userID, $siteID);
    $basketItems = $basket->getBasketItems();
    foreach ($basketItems as $basketItem) {
        if ($action == 'cart_clear')
            $basketItem->delete();
        else
        {
            if ($basketItem->getProductId() == $productID)
            {
                if ($action == 'cart_change')
                    $basketItem->setField('QUANTITY', $quantity);
                elseif($action == 'cart_del_el')
                    $basketItem->delete();
            }
        }
    }
    $basket->save();
}
elseif ($action == 'buyOne') // купить в один клик
{
    $userID = Sale\Fuser::getId();

    print_r("from one click");
    $siteID = Bitrix\Main\Context::getCurrent()->getSite();
    $currencyCode = CurrencyManager::getBaseCurrency();

    $productName = $_REQUEST['oneClickName'];
    $productPrice = $_REQUEST['oneClickPrice'];

    // Создаём корзину
    $basket = Basket::create($siteID);
    $item = $basket->createItem('catalog', $productID);
    $item->setFields([
        'NAME' => $productName,
        'BASE_PRICE' => $productPrice,
        'CURRENCY' => $currencyCode,
        'QUANTITY' => $quantity,
        'LID' => $siteID,
        'PRODUCT_PROVIDER_CLASS' => "\\Bitrix\\Sale\\ProviderAccountPay",
    ]);
    $paySum = $productPrice * $quantity; // сумма для создание оплаты

    // оформление заказа
    $order = Order::create($siteID, $userID);
    $order->setPersonTypeId(1);
    $order->setField('CURRENCY', $currencyCode);
    $order->setBasket($basket);
// Создаём одну отгрузку и устанавливаем способ доставки - "Без доставки" (он служебный)
    $shipmentCollection = $order->getShipmentCollection();
    $shipment = $shipmentCollection->createItem();
    $service = Delivery\Services\Manager::getById(Delivery\Services\EmptyDeliveryService::getEmptyDeliveryServiceId());
    $deliveryID = $service['ID'];
    // привязываем доставку
    $shipment->setFields(['DELIVERY_ID' => $deliveryID]);
    // $shipmentItemCollection = $shipment->getShipmentItemCollection();
    // $shipmentItem = $shipmentItemCollection->createItem($item);
    // $shipmentItem->setQuantity($item->getQuantity());

    // Создаём оплату
    $orderPaySystem = 2;
    $paymentCollection = $order->getPaymentCollection();
    $payment = $paymentCollection->createItem();
    $paySystemService = PaySystem\Manager::getObjectById($orderPaySystem);
    $payment->setFields(array(
        'PAY_SYSTEM_ID' => $paySystemService->getField("PAY_SYSTEM_ID"),
        'PAY_SYSTEM_NAME' => $paySystemService->getField("NAME"),
        'SUM' => $paySum,
        'CURRENCY' => $currencyCode,
    ));

    // Устанавливаем свойства
    $propertyCollection = $order->getPropertyCollection();
    $fioProp = $propertyCollection->getPayerName();
    $fioProp->setValue($buyOneName);
    $phoneProp = $propertyCollection->getPhone();
    $phoneProp->setValue($buyOnePhone);

    $order->doFinalAction(true);
    $result = $order->save();
    if (!$result->isSuccess()) {
        echo 'Ошибка создания заказа: '.$result->getErrors();
    }else {
        echo 'Заказ ' . $order->GetId() . ' создан успешно order!';
    }
    $siteId = \Bitrix\Main\Context::getCurrent()->getSite();
    $storeId = ""; // Задайте значение по умолчанию

    if (\Bitrix\Main\Loader::includeModule("catalog")) {
        $storeList = CCatalogStore::GetList([], ['ACTIVE' => 'Y', 'SITE_ID' => $siteId], false, false, ['ID']);
        while ($store = $storeList->Fetch()) {
            $storeId = $store['ID'];
            break;
        }
    }

    if (\Bitrix\Main\Loader::includeModule("catalog")) {
        $product = CCatalogProduct::GetByID($productID);
        if ($product) {
            $orderData = [
                'id' => $order->GetId(),
                'date' => $order->getField('DATE_INSERT')->toString(),
                'Gender' => '0',
                'idstore' => '0',
                'ClientFIO' => $buyOneName,
                'Mail' => '0',
                'ClientPhoneNumber' => $buyOnePhone,
                'sum' => $product[PURCHASING_PRICE] * $product[MEASURE],
                'idStore' => $storeId,
                'products' => [
                    [
                        'idproduct' => $productID,
                        'price' => $product[PURCHASING_PRICE],
                        'count' => $product[MEASURE],
                        'sum' => $product[PURCHASING_PRICE] * $product[MEASURE]
                    ],
                ]

            ];
        } else {
            // Товар не найден
            echo "Товар с ID $productID не найден.";
        }
    }

    $jsonString = json_encode($orderData);
    $directory = '/home/back1c/ftp/orders/';
    $filename = $directory . $order->GetId() . '.json';

}
elseif ($action == 'orderCancel') // отмена заказа
{
    $order = \Bitrix\Sale\Order::load($_REQUEST['orderID']);
    $order->setField("CANCELED","Y");
    $order->setField('STATUS_ID',"V"); //статус
    $order->save();
    $orderId = $order->GetId();
    $directory = '/home/back1c/ftp/cancelledByClient/';
    $filename = $directory . $orderId . '.json';
    $testData = [
        'id' => $orderId,
        'status' => 'canceled_by_client',
        'from' => 'order'
    ];
    $jsonString = json_encode($testData, JSON_UNESCAPED_UNICODE);
    file_put_contents($filename, $jsonString);
}
