<?
// тест вывод
function dump($el)
{
    global $USER;
    if ($USER->IsAdmin()) {
        echo "<pre>";
        print_r($el);
        echo "</pre>";
    }
}

// формат цены
function formatPrice($price)
{
    $newPrice = number_format($price, 0, ',', ' ');
    return $newPrice;
}

// очистка телефона
function formatPhone($phone)
{
    $newPhone = str_replace(['(', ')', '-', ' '], '', $phone);
    return $newPhone;
}

// получение списка свойства
function getListProperty($arSort, $arFilter)
{ // USER_FIELD_ID
    $rsField = CUserFieldEnum::GetList($arSort, $arFilter);
    while ($arField = $rsField->GetNext())
        $arElements[$arField["ID"]] = $arField["VALUE"];

    return $arElements;
}

// получение элементов HL-блока
function getElHL($idHL, $order, $filter, $select)
{

    $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById($idHL)->fetch();
    $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();
    $entity_table_name = $hlblock['TABLE_NAME'];
    $sTableID = 'tbl_' . $entity_table_name;

    $rsData = $entity_data_class::getList([
        'order' => $order,
        'filter' => $filter,
        'select' => $select
    ]);
    $rsData = new CDBResult($rsData, $sTableID);

    while ($arRes = $rsData->Fetch()) {
        $arElements[$arRes['ID']] = $arRes;
    }
    return $arElements;
}


// слушатель для отправки заказа на SFTP-сервер после создания заказа
use Bitrix\Main;

Main\EventManager::getInstance()->addEventHandler(
    'sale',
    'OnSaleOrderSaved',
    'sendingAnOrderToSFTP'
);


function sendingAnOrderToSFTP(Main\Event $event)
{
    /** @var Order $order */
    $order = $event->getParameter("ENTITY");
    $isNew = $event->getParameter("IS_NEW");
    $directory = '/home/back1c/ftp/orders/';
//    $directory = '/srv/sftp/sftp-user/orders/';
    $uid = $order->getUserId();
    $User = CUser::GetByID($uid);

    if ($isNew) {
        $orderId = $order->getId();
        $propertyCollection = $order->getPropertyCollection()->getArray()['properties'];
        $userProp = $User->Fetch();
        $email = '';
        $phone = '';
        $fio = '';

        $saleOrder = Bitrix\Sale\Order::load($orderId);
        $shipmentCollection = $saleOrder->getShipmentCollection();
        $idstore = '';
        foreach ($shipmentCollection as $shipment) {
            if (!$shipment->isSystem()) {
//                $arResult['originalDeliveryId'] = $shipment->getDeliveryId();
//                $arResult['customPriceDelivery'] = $shipment->getField('CUSTOM_PRICE_DELIVERY');
//                $arResult['basePrice'] = $shipment->getField('BASE_PRICE_DELIVERY');
                $idstore = $shipment->getStoreId();
                break;
            }
        }

        foreach ($propertyCollection as $item) {
            if ($item['CODE'] === 'EMAIL') {
                $email = $item['VALUE'][0];
            } else if ($item['CODE'] === 'FIO') {
                $fio = $item['VALUE'][0];
            } else if ($item['CODE'] === 'PHONE') {
                $phone = $item['VALUE'][0];
            }
        }

        $orderData = [
            'id' => $orderId,
            'date' => $order->getDateInsert()->toString(),
            'sum' => $order->getPrice(),
            'ClientFIO' => $fio,
            'Mail' => $email,
            'ClientPhoneNumber' => $phone,
            'idstore' => $idstore . '',
            'Gender' => $userProp['PERSONAL_GENDER'],
            'moving' => '0'
        ];

        // Получение списка товаров заказа
        $orderItems = $order->getBasket()->getBasketItems();
        foreach ($orderItems as $item) {
            $productName = $item->getField("NAME");
            $productPrice = $item->getField("PRICE");
            $productQuantity = intval($item->getField("QUANTITY"));
            $productId = $item->getField("PRODUCT_ID");
            $productSum = $productPrice * $productQuantity;
            $orderData['products'][] = [
                'idproduct' => $productId,
                'sum' => $productSum,
                // 'bonus_points' => $bonusPoints,
                'name' => $productName,
                'price' => $productPrice,
                'count' => $productQuantity,
            ];
        }

        $filename = $directory . $order->getId() . '.json';
        $jsonString = json_encode($orderData, JSON_UNESCAPED_UNICODE);
        file_put_contents($filename, $jsonString);
    }

}


// слушатель для отправки заказа на SFTP-сервер после создания заказа
//use Bitrix\Sale\Order;
//
//\Bitrix\Main\EventManager::getInstance()->addEventHandler(
//    'sale',
//    'OnSaleOrderEntitySaved',
//    'OnStatusChange'
//);
//function OnStatusChange(Bitrix\Main\Event $event)
//{
//    $order = $event->getParameter("ENTITY");
//    $oldValues = $event->getParameter("VALUES");
//    $arOrderVals = $order->getFields()->getValues();
//    $directory = '/home/back1c/ftp/statuses/';
////    $directory = '/srv/sftp/sftp-user/orders/';
//    if (isset($oldValues['STATUS_ID']) && $arOrderVals['STATUS_ID'] !== $oldValues['STATUS_ID']) {
//        $filename = $directory . $order->getId() . '.json';
//        $testData = [
//            'status' => $arOrderVals['STATUS_ID'],
//        ];
//        $jsonString = json_encode($testData, JSON_UNESCAPED_UNICODE);
//        file_put_contents($filename, $jsonString);
//    }
//    $testData = [
//        'order' => $order,
//    ];
//    $jsonString = json_encode($testData, JSON_UNESCAPED_UNICODE);
//    file_put_contents($directory . '.json', $jsonString);
//}

// запись заказа на FTP, когда пользователь отменяет заказ
AddEventHandler('sale', 'OnSaleCancelOrder', 'OnSaleCancelOrderHandler');

function OnSaleCancelOrderHandler($order_id, $status, $info)
{
//        $directory = '/srv/sftp/sftp-user/orders/';
    $directory = '/home/back1c/ftp/cancelledByClient/';
    $filename = $directory . $order_id . '.json';
    $testData = [
        'id' => $order_id,
        'status' => 'canceled_by_client',
    ];
    $jsonString = json_encode($testData, JSON_UNESCAPED_UNICODE);
    file_put_contents($filename, $jsonString);
}


