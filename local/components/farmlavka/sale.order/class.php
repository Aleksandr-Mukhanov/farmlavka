<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset,
		Bitrix\Sale,
		Bitrix\Sale\Order,
		Bitrix\Currency\CurrencyManager,
		Bitrix\Sale\Delivery,
		Bitrix\Sale\PaySystem;

Asset::getInstance()->addJs('https://api-maps.yandex.ru/2.1/?apikey=f80d129d-d6ef-4dbd-a236-09618983f891&lang=ru_RU');

class farmlavka extends CBitrixComponent
{
	function order()
	{
		$userID = Sale\Fuser::getId();
		$siteID = Bitrix\Main\Context::getCurrent()->getSite();
		$currencyCode = CurrencyManager::getBaseCurrency();

		$basket = Sale\Basket::loadItemsForFUser($userID,$siteID);

		// стоимость в корзине
		$basketPrice = $basket->getPrice();
		$basketFullPrice = $basket->getBasePrice();
		$basketDiscountSum = $basketFullPrice - $basketPrice;
		$basketDiscount = ($basketDiscountSum) ? '- '.formatPrice($basketDiscountSum) : 0;
		$basketDiscount .= ' ₽';

		// товары в корзине
		$basketItems = $basket->getBasketItems();
		foreach ($basket as $basketItem) {
			// dump($basketItem);
			$productID = $basketItem->getField('PRODUCT_XML_ID');
			$arBasketItems[$productID] = [
				'NAME' => $basketItem->getField('NAME'),
				'URL' => $basketItem->getField('DETAIL_PAGE_URL'),
				'PRICE' => $basketItem->getField('PRICE'),
				'BASE_PRICE' => $basketItem->getField('BASE_PRICE'),
				'DISCOUNT_PRICE' => $basketItem->getField('DISCOUNT_PRICE'),
			];
			$arItemIds[] = $productID;
		}
		$arOrder = ['SORT'=>'ASC'];
		$arFilter = ['IBLOCK_ID'=>1,'ID'=>$arItemIds];
		$arSelect = ['ID','PREVIEW_PICTURE'];
		$rsElements = CIBlockElement::GetList($arOrder,$arFilter,false,false,$arSelect);
		while ($arElement = $rsElements->Fetch()) {
			$arBasketItems[$arElement['ID']]['IMG'] = CFile::GetPath($arElement['PREVIEW_PICTURE']);
		}

		// получим платежные системы
		$rsPaySystem = CSalePaySystem::GetList(
			["SORT"=>"ASC", "PSA_NAME"=>"ASC"],
			["ACTIVE"=>"Y"]
		);
		while ($arPaySystemDB = $rsPaySystem->Fetch()) {
			$arPaySystem[$arPaySystemDB['ID']] = $arPaySystemDB['NAME'];
		}

		// получим доставки
		$locationCode = $_SESSION["SOTBIT_REGIONS"]['LOCATION']['CODE'];

		$rsDelivery = \Bitrix\Sale\Delivery\Services\Table::getList([
			'filter' => ['ACTIVE'=>'Y'],
			'select' => ['ID','NAME','CONFIG']
		]);

		while($arDelivery=$rsDelivery->fetch())
			if (\Bitrix\Sale\Delivery\Restrictions\ByLocation::check($locationCode, [], $arDelivery['ID']))
				$arDeliveryAviable[] = $arDelivery;

		// получим склады
		$arCard = getListProperty([],['USER_FIELD_ID'=>48]);

		$rsStore = \Bitrix\Catalog\StoreTable::getList([
			'filter' => ['ID'=>$_SESSION["SOTBIT_REGIONS"]['STORE'],'ACTIVE'=>'Y'],
			'select' => ['ID','TITLE','ADDRESS','GPS_N','GPS_S','PHONE','SCHEDULE','UF_CARD','UF_AVAILABLE']
		]);

		while($arStore = $rsStore->fetch())
		{
		  $arStore['COORDINATES'] = $arStore['GPS_N'].','.$arStore['GPS_S'];

		  foreach ($arStore['UF_CARD'] as $value)
		    $arStore['UF_CARD_NAME'][] = $arCard[$value];

		  $arStores[$arStore['ID']] = $arStore;
		}

		// Выборка количества товара с идентификатором в $productId на всех активных складах:
		$rsStoreProduct = \Bitrix\Catalog\StoreProductTable::getList(array(
			'filter' => [
				'=PRODUCT_ID'=>$arItemIds,
				'STORE.ACTIVE'=>'Y',
				// 'ID'=>$_SESSION["SOTBIT_REGIONS"]['STORE']
			],
			'select' => ['*','UF_*'],
		));

		while($arStoreProduct = $rsStoreProduct->fetch()){
			// dump($arStoreProduct);
			// $arStoreAvail[$arStoreProduct['STORE_ID']][$arStoreProduct['PRODUCT_ID']] = $arStoreProduct['AMOUNT'];
			$arStoreAvail[$arStoreProduct['STORE_ID']][] = $arStoreProduct['PRODUCT_ID'];
		} // dump($arStoreAvail);

		// dump($_REQUEST);
		if($_REQUEST['SEND_ORDER'])
		{
			$orderFIO = $_REQUEST['orderFIO'];
			$orderMail = $_REQUEST['orderMail'];
			$orderPhone = $_REQUEST['orderPhone'];
			$orderAddress = $_REQUEST['ADDRESS'];
			$orderEntrance = $_REQUEST['ENTRANCE'];
			$orderFloor = $_REQUEST['FLOOR'];
			$orderSQOffice = $_REQUEST['SQ_OFFICE'];
			$orderIntercomCode = $_REQUEST['INTERCOM_CODE'];
			$orderPaySystem = $_REQUEST['PAY_SYSTEM'];

			// привяжем к пользователю
			global $USER;
			$rsUser = CUser::GetByLogin($orderPhone);
			if ($arUser = $rsUser->Fetch())
			{
				$userID = $arUser['ID'];
				$USER->Authorize($userID);
			}
			else
			{
				// добавим пользователя
				$user = new CUser;
				$arFIO = explode(' ',$orderFIO);
				$password = substr(str_shuffle('0123456789'),0,6);
				$arFields = [
					"NAME"              => $arFIO[1],
				  "LAST_NAME"         => $arFIO[0],
					"SECOND_NAME"       => $arFIO[2],
				  "EMAIL"             => $orderMail,
				  "LOGIN"             => $orderPhone,
				  "GROUP_ID"          => [3,4],
					"PASSWORD"          => $password,
					"CONFIRM_PASSWORD"  => $password,
				];
				$userID = $user->Add($arFields);
				if (intval($userID) > 0)
					$USER->Authorize($userID);
				else
					echo $user->LAST_ERROR;
			}

			// оформление заказа
			$order = Order::create($siteID, $userID);
			$order->setPersonTypeId(1);
			$order->setField('CURRENCY', $currencyCode);
			$order->setBasket($basket);

			if ($_REQUEST['STORE'])
				$order->setField('USER_DESCRIPTION', 'Склад: '.$_REQUEST['STORE']);

			// Создаём одну отгрузку и устанавливаем способ доставки - "Без доставки" (он служебный)
			$shipmentCollection = $order->getShipmentCollection();
			$shipment = $shipmentCollection->createItem();
			if ($_REQUEST['DELIVERY_ID'])
				$deliveryID = $_REQUEST['DELIVERY_ID'];
			else {
				$service = Delivery\Services\Manager::getById(Delivery\Services\EmptyDeliveryService::getEmptyDeliveryServiceId());
				$deliveryID = $service['ID'];
			}
			// привязываем доставку
			$shipment->setFields(['DELIVERY_ID' => $deliveryID]);
			// $shipmentItemCollection = $shipment->getShipmentItemCollection();
			// $shipmentItem = $shipmentItemCollection->createItem($item);
			// $shipmentItem->setQuantity($item->getQuantity());

			// Создаём оплату
			$paymentCollection = $order->getPaymentCollection();
			$payment = $paymentCollection->createItem();
			$paySystemService = PaySystem\Manager::getObjectById($orderPaySystem);
			$payment->setFields(array(
				'PAY_SYSTEM_ID' => $paySystemService->getField("PAY_SYSTEM_ID"),
				'PAY_SYSTEM_NAME' => $paySystemService->getField("NAME"),
				'SUM' => $basketPrice,
				'CURRENCY' => $currencyCode,
			));

			// Устанавливаем свойства
			$propertyCollection = $order->getPropertyCollection();
			$fioProp = $propertyCollection->getPayerName();
			$fioProp->setValue($orderFIO);
			$phoneProp = $propertyCollection->getPhone();
			$phoneProp->setValue($orderPhone);
			$emailProp = $propertyCollection->getUserEmail();
			$emailProp->setValue($orderMail);
			$addressProp = $propertyCollection->getAddress();
			$addressProp->setValue($orderAddress);
			$entranceProp = $propertyCollection->getItemByOrderPropertyId(6); // Подъезд
			$entranceProp->setValue($orderEntrance);
			$floorProp = $propertyCollection->getItemByOrderPropertyId(7); // Этаж
			$floorProp->setValue($orderFloor);
			$sqOfficeProp = $propertyCollection->getItemByOrderPropertyId(8); // Кв./офис
			$sqOfficeProp->setValue($orderSQOffice);
			$intercomProp = $propertyCollection->getItemByOrderPropertyId(9); // Код домофона
			$intercomProp->setValue($orderIntercomCode);
			$prop12 = $propertyCollection->getItemByOrderPropertyId(12); // Название адреса
			$prop12->setValue($_REQUEST['ADDRESS_NAME']);
			$prop13 = $propertyCollection->getItemByOrderPropertyId(13); // Комментарий к адресу
			$prop13->setValue($_REQUEST['ADDRESS_TEXT']);

			$order->doFinalAction(true);
			$result = $order->save();
			if (!$result->isSuccess()) {
				$arResult['RESULT'] = 'Ошибка создания заказа: '.$result->getErrors();
			}else{
				$arResult['RESULT'] = 'Заказ №'.$order->getId().' создан успешно!';
			}
		}

		$arResult['BASKET'] = $arBasketItems;
		$arResult['STORES'] = $arStores;
		$arResult['STORES_AVAIL'] = $arStoreAvail;
		$arResult['PAY_SYSTEM'] = $arPaySystem;
		$arResult['FULL_PRICE'] = formatPrice($basketFullPrice);
		$arResult['DISCOUNT'] = $basketDiscount;
		$arResult['PRICE'] = formatPrice($basketPrice);
		$arResult['DELIVERY'] = $arDeliveryAviable;

    return $arResult;
	}

	public function executeComponent()
	{
		$this->arResult = array_merge($this->arResult,$this->order());
		$this->includeComponentTemplate();
	}
}?>
