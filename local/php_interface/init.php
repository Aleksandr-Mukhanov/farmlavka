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
use Bitrix\Catalog\StoreTable;
use Bitrix\Catalog\StoreProductTable;
use Bitrix\Iblock\ElementTable;

Main\EventManager::getInstance()->addEventHandler(
    'sale',
    'OnSaleOrderSaved',
    'sendingAnOrderToSFTP'
);


/**
 * @throws Exception
 */
function sendingAnOrderToSFTP(Main\Event $event)
{
    /** @var Order $order */
    $order = $event->getParameter("ENTITY");
    $isNew = $event->getParameter("IS_NEW");
    $directory = '/home/back1c/ftp/orders/';
//    $directory = '/home/back1c/ftp/nomenclature/';
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

        foreach ($propertyCollection as $item) {
            if ($item['CODE'] === 'EMAIL') {
                $email = $item['VALUE'][0];
            } else if ($item['CODE'] === 'FIO') {
                $fio = $item['VALUE'][0];
            } else if ($item['CODE'] === 'PHONE') {
                $phone = $item['VALUE'][0];
            }
        }

        $dateInsertString = $order->getDateInsert()->toString(); // String
        $dateInsert = new DateTime($dateInsertString);
        $formattedDate = $dateInsert->format('Y-m-d\TH:i:s');

        $gender = '0'; // По умолчанию - неопределено

        if (isset($userProp['PERSONAL_GENDER'])) {
            switch ($userProp['PERSONAL_GENDER']) {
                case 'M':
                    $gender = '1'; // Мужской
                    break;
                case 'F':
                    $gender = '2'; // Женский
                    break;
            }
        }
        $phoneWhithoutMask = (string) preg_replace('/\D/', '', $phone); // Убираем все символы, кроме цифр
        $orderData = [
            'id' => $orderId,
            'date' => $formattedDate,
            'sum' => $order->getPrice(),
            'ClientFIO' => $fio,
            'Mail' => $email,
            'ClientPhoneNumber' => $phoneWhithoutMask,
            'idstore' => $order->getField('USER_DESCRIPTION'),
            'Gender' => $gender
        ];

        // Получение списка товаров заказа
        $orderItems = $order->getBasket()->getBasketItems();
        foreach ($orderItems as $item) {
            // Получаем данные о товаре из заказа
            $productName = $item->getField("NAME");
            $productPrice = $item->getField("PRICE");
            $productQuantity = intval($item->getField("QUANTITY"));
            $productId = $item->getField("PRODUCT_ID");
            $productSum = $productPrice * $productQuantity;
            // Получаем идентификатор склада из заказа
            $storeId = $order->getField('USER_DESCRIPTION');
            // Получаем данные о складе
            $storeData = StoreTable::getList([
                'filter' => ['ID' => $storeId],
            ])->fetch();
            $moving = 0;

            // Получаем внешний код (XML_ID) товара
            $productData = ElementTable::getList([
                'filter' => ['ID' => $productId],
                'select' => ['XML_ID']
            ])->fetch();

            $externalId = isset($productData['XML_ID']) ? $productData['XML_ID'] : '';

            if ($storeData) {
                // Преобразуем строковый идентификатор склада в числовой формат, если необходимо
                $storeId = intval($storeId);

                // Получаем данные о продуктах на конкретном складе
                $rsStoreProduct = StoreProductTable::getList([
                    'filter' => [
                        '=PRODUCT_ID' => $productId,
                        '=STORE_ID' => $storeId,
                        'STORE.ACTIVE' => 'Y',
                    ],
                ]);
                // Переменная для хранения общего количества товара на складе
                $totalStockQuantity = 0;

                // Перебираем результаты запроса
                while ($storeProduct = $rsStoreProduct->fetch()) {
                    // Суммируем количество товара на складе
                    $totalStockQuantity += $storeProduct['AMOUNT'];
                }
                if($totalStockQuantity - $productQuantity >= 0){
                    $moving = 0;
                }else{
//                    $moving = $productQuantity - $totalStockQuantity;
                    $moving = 1;
                }
            }else{
                $moving = 1;
            }

            $orderData['products'][] = [
                'idproduct' => $externalId,
                'sum' => $productSum,
                'price' => $productPrice,
                'count' => $productQuantity,
                'moving' => $moving,
                'bonus_points' => 0
            ];

        }

        $filename = $directory . $order->getId() . '.json';
        $jsonString = json_encode($orderData, JSON_UNESCAPED_UNICODE);
        file_put_contents($filename, $jsonString);
    }
}

// запись заказа на FTP, когда пользователь отменяет заказ
AddEventHandler('sale', 'OnSaleCancelOrder', 'OnSaleCancelOrderHandler');

function OnSaleCancelOrderHandler($order_id, $status, $info)
{
    $order = \Bitrix\Sale\Order::load($order_id);
    $order->setField("CANCELED","Y");
    $order->setField('STATUS_ID',"V");
    $order->save();
    $directory = '/home/back1c/ftp/cancelledByClient/';
    $filename = $directory . $order_id . '.json';
    $testData = [
        'id' => $order_id,
        'status' => 'canceled_by_client',
    ];
    $jsonString = json_encode($testData, JSON_UNESCAPED_UNICODE);
    file_put_contents($filename, $jsonString);
}

AddEventHandler('sale', 'OnBeforeStatusUpdate', 'OnBeforeStatusUpdateHandler');

function OnBeforeStatusUpdateHandler($orderId, &$newStatus, &$oldStatus)
{
    if ($newStatus === 'CANCELED') {
        $order = \Bitrix\Sale\Order::load($orderId);
        $order->setField("CANCELED", "Y");
        $order->setField('STATUS_ID', "V");
        $order->save();

        $directory = '/home/back1c/ftp/cancelledByClient/';
        $filename = $directory . $orderId . '.json';

        $testData = [
            'id' => $orderId,
            'status' => 'canceled_by_client',
        ];

        $jsonString = json_encode($testData, JSON_UNESCAPED_UNICODE);
        file_put_contents($filename, $jsonString);
    }
}