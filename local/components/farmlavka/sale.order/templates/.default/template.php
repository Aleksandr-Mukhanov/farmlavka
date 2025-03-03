<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $USER;
// dump($arResult['BASKET']);
?>
<div class="_container checkout">
	<div class="checkout__body">
    <input type="hidden" value="<?=$_SESSION["SOTBIT_REGIONS"]["NAME"]?>" id="cityName">
		<?if($arResult['PRICE'] && !$_REQUEST['SEND_ORDER']):?>
			<form class="checkout__left" method="post">
				<div class="ch-main ">
					<div class="ch-main__body">
						<h2 class="footer__question__title" >Контактные данные</h2>
						<div class="ch-main__inputs" >
							<div class="a-content__input-block">
								<input class="a-content__input" name="orderFIO" type="text" value="<?=$USER->GetFullName()?>" placeholder="Фамилия Имя Отчество" required>
							</div>
							<div class="a-content__input-block">
								<input class="a-content__input" name="orderMail" type="email" value="<?=$USER->GetEmail()?>" placeholder="Электронная почта" required>
							</div>
							<div class="a-content__input-block">
								<input class="a-content__input phoneMask" name="orderPhone" type="tel" value="<?=$USER->GetLogin()?>" placeholder="Ваш телефон" required>
							</div>
							<div class="ch-main__send" >
								<input class="rp-left__input" type="checkbox" id="orderSMS" name="orderSMS" value="newsletter" checked>
								<label for="orderSMS">
									<p class="ch-main__text" >
										Отправить SMS-уведомление
									</p>
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="checkout__ch-order">
					<h3 class="footer__question__title">Ваш заказ</h3>
					<table class="ch-order__table">
						<?foreach ($arResult['BASKET'] as $itemID => $arItem) {?>
							<tr class="ch-order__tr" >
								<td class="ch-order__td" >
									<div class="b-order__right">
									<div class="product-card__block__img b-order__block-img">
										<div class="product-card__img ch-order__p-img ">
											<a href="<?=$arItem['URL']?>">
												<img class="b-order__img ch-order__img" src="<?=$arItem['IMG']?>" alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>">
											</a>
										</div>
									</div>
									<div class="order__right ch-order__right">
										<p class="product-card__title fz-16px">
											<a href="<?=$arItem['URL']?>">
												<?=$arItem['NAME']?>
												<span class="store-avail" id="store-avail-<?=$itemID?>">***</span>
											</a>
											<span>(<?=round($arItem['QUANTITY'])?> шт)</span>
										</p>
									</div>
									</div>
								</td>
								<td class="ch-order__td" >
									<div class="product-card__price ch-order__price">
										<p class="product-card__price__1 ch-order__card_1 fz-24px">
											<?=formatPrice($arItem['QUANTITY'] * $arItem['PRICE'])?> ₽
										</p>
										<?if($arItem['DISCOUNT_PRICE'] > 0):?>
											<div class="ch-order__card_2" >
												<p class="product-card__price__2 ch-order__card_2__text fz-14px">
													<?=formatPrice($arItem['QUANTITY'] * $arItem['BASE_PRICE'])?> ₽
												</p>
											</div>
										<?endif;?>
									</div>
								</td>
							</tr>
						<?}?>
					</table>
				</div>
				<div class="checkout__ch-order ">
					<h3 class="footer__question__title">Доставка</h3>
					<div class="checkout__ch-delivery">
						<div class="ch-delivery__buttons" >
							<!-- <div class="ch-delivery__button-block">
								<button class="button ch-delivery__button" data-id="<?=$arResult['DELIVERY'][0]['ID']?>" data-type="delivery">доставка</button>
							</div> -->
							<div class="ch-delivery__button-block">
								<button class="button ch-delivery__button active" data-id="<?=$arResult['DELIVERY'][1]['ID']?>" data-type="pickup">самовывоз</button>
							</div>
						</div>
						<input type="hidden" name="DELIVERY_ID" id="deliveryID">
					</div>
					<div class="checkout__ch-delivery blockDelivery hide">
						<p class="ch-delivery__text" >Выберите адрес из списка или добавьте новый:</p>
						<li class="availability__item">
							<input class="availability__item__input" type="radio" id="addressNew" name="ADDRESS_NEW" value="Y">
							<label class="availability__item__label" for="addressNew">Добавить новый адрес</label>
						</li>
						<div class="ch-delivery__inputs" >
							<div class="city__input-block">
								<input type="search" class="city__input" name="ADDRESS" placeholder="Адрес доставки">
								<div class="svg city__input__svg checkout__svg-1"></div>
							</div>
							<div class="city__input-block">
								<input type="search" class="city__input ch-delivery__input" name="ENTRANCE" placeholder="Подъезд">
							</div>
							<div class="city__input-block">
								<input type="search" class="city__input ch-delivery__input" name="FLOOR" placeholder="Этаж">
							</div>
							<div class="city__input-block">
								<input type="search" class="city__input ch-delivery__input" name="SQ_OFFICE" placeholder="Кв./офис">
							</div>
							<div class="city__input-block">
								<input type="search" class="city__input ch-delivery__input" name="INTERCOM_CODE" placeholder="Код домофона">
							</div>
						</div>
						<a class="ch-delivery__text-bottom showAddInfo">Дополнительная инфомация по адресу</a>
						<div class="delivery__add_info hide">
							<div class="ch-delivery__inputs_add">
								<div class="city__input-block">
									<input type="search" class="city__input ch-delivery__input" name="ADDRESS_NAME" placeholder="Название адреса">
								</div>
								<div class="city__input-block">
									<input type="search" class="city__input ch-delivery__input" name="ADDRESS_TEXT" placeholder="Комментарий к адресу">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="checkout__ch-way blockDelivery">
					<div class="checkout__ch-order ch-confirm__body">
						<h3 class="footer__question__title padding-none">Самовывоз</h3>
	          <?$APPLICATION->IncludeComponent(
	            "sotbit:regions.choose",
	            "delivery",
	            Array(
	               "FROM_LOCATION" => "Y",	// Данные берутся из местоположений
	            ),
	            false
	          );?>
						<div class="delivery__d-map ">
							<script type="text/javascript">
					      // Функция ymaps.ready() будет вызвана, когда
					      // загрузятся все компоненты API, а также когда будет готово DOM-дерево.
					      ymaps.ready(init);
					      function init(){
					        // Создание карты.
					        var myMap = new ymaps.Map("mapPickUp", {
					          center: [55.76, 37.64],
					          zoom: 8
					        });
					        // создание меток
					        <?foreach ($arResult['STORES'] as $store) {?>
					          var myPlacemark = new ymaps.Placemark(
					            [<?=$store['COORDINATES']?>], {
					    				hintContent: '<?=$store['TITLE']?>',
					    			}, {
					    				preset: 'islands#darkGreenDotIcon'
					    			});

					    			myMap.geoObjects.add(myPlacemark);
					        <?}?>

					        $('.showInMap').click(function(){
					          coordinates = $(this).attr('data-coordinates').split(',');
					          myMap.setCenter(coordinates, 8);
					        });
					      }
					    </script>
					    <div id="mapPickUp" style="width: 100%; height: 500px"></div>
						</div>
						<div class="tags instruction-left__tags">
							<a href="#" class="tag store_avail active" data-avail="all">
								<p class="tag__text">Все аптеки</p>
							</a>
							<!-- <a href="#" class="tag store_avail" data-avail="14">
								<p class="tag__text">Забрать за час</p>
							</a>
							<a href="#" class="tag store_avail" data-avail="15">
								<p class="tag__text">Сегодня</p>
							</a> -->
						</div>
						<div class="l-address">
							<table class="address__table">
								<tr class="address__tr__head">
									<th class="address__th">СПИСОК</th>
									<th class="address__th">АДРЕС</th>
									<th class="address__th">КАРТЫ</th>
									<th class="address__th">ЧАСЫ РАБОТЫ</th>
									<th class="address__th">ТЕЛЕФОН</th>
								</tr>
	              <?foreach ($arResult['STORES'] as $store) {
										// соберем наличие
										if ($arResult['STORES_AVAIL'][$store['ID']]) // если есть в наличии на складе
										{
											foreach ($arResult['STORES_AVAIL'][$store['ID']] as $productID => $productQNT)
											{
												// прибавим наличие на складах поставщиков
												foreach ($arResult['STORES_ALWAYS'] as $storeID)
													$productQNT += $arResult['STORES_AVAIL'][$storeID][$productID];

												if ((int)$productQNT >= (int)$arResult['BASKET'][$productID]['QUANTITY'])
													$arProductAvail[] = $productID;
											}
										}
										else // когда нет на складах
										{
											foreach ($arResult['BASKET'] as $productID => $arProduct)
											{
												$productQNT = 0;
												// прибавим наличие на складах поставщиков
												foreach ($arResult['STORES_ALWAYS'] as $storeID)
													$productQNT += $arResult['STORES_AVAIL'][$storeID][$productID];

												if ((int)$productQNT >= (int)$arResult['BASKET'][$productID]['QUANTITY'])
													$arProductAvail[] = $productID;
											}
										}

										$disabled = ($arProductAvail && (count($arProductAvail) == count($arResult['BASKET']))) ? '' : 'disabled';
								?>
	                <tr class="address__tr__body available_<?=$store['UF_AVAILABLE']?>">
	                  <td class="address__td-body">
	                    <div class="address__td__block" >
                        <div class="address__td__choose">
                          <input type="radio" name="STORE" id="store_<?=$store['ID']?>" value="<?=$store['ID']?>" class="<?=($disabled)?'store-disabled':''?>" data-name="<?=$store['TITLE']?>" data-product=<?=($arProductAvail)?implode(',',$arProductAvail):''?>>
                          <label for="store_<?=$store['ID']?>" class="address__td-text"><?=$store['TITLE']?></label>
                          <span class="<?=$disabled?>" title="В этой аптеке можно забрать все товары">✔</span>
                          <span class="<?=$disabled?> not" title="В этой аптеке доступны не все товары">𐄂</span>
                        </div>
	                    </div>
	                  </td>
	                  <td class="address__td-body">
	                    <div class="address__td__block" >
	                      <p class="address__td-text address__td-address"><?=$store['ADDRESS']?></p>
	                    </div>
	                  </td>
	                  <td class="address__td-body">
	                    <div class="address__td__block" >
	                      <div class="address__td-bank">
	                        <!-- <img src="./img/svg/bank-2.svg" class="address__td-img" width="90px" height="16px" > -->
	                        <?=($store['UF_CARD_NAME'])?implode(', ', $store['UF_CARD_NAME']):''?>
	                      </div>
	                    </div>
	                  </td>
	                  <td class="address__td-body">
	                    <div class="address__td__block" >
	                        <p class="address__td-text "><?=$store['SCHEDULE']?></p>
	                      </div>
	                  </td>
	                  <td class="address__td-body">
	                    <div class="address__td__last" >
	                      <div class="address__td__block" >
	                        <div>
	                          <div class="address__td__block__tell" >
	                          <p class="address__td-text address__td-tell"><?=$store['PHONE']?></p>
	                        </div>
	                        </div>
	                      </div>
	                      <a class="address__td-show">Показать номер</a>
	                      <div class="address__td-button-block">
	                        <a class="button footer__button showInMap" href="#mapPickUp" data-coordinates="<?=$store['COORDINATES']?>">Посмотреть</a>
	                      </div>
	                    </div>
	                  </td>
	                </tr>
		              <?unset($arProductAvail);
								}?>
							</table>
							<!-- <div class="block__button address__bottom-btn">
								<a href="#" class="button__link">
									<div class="svg button__link__svg"> </div>
									Показать все адреса
								</a>
							</div> -->
						</div>
					</div>
				</div>
				<div class="checkout__ch-way " >
					<div class="checkout__ch-order">
						<h3 class="footer__question__title">Способ оплаты</h3>
						<ul class="availability__items">
							<?foreach ($arResult['PAY_SYSTEM'] as $paySystemID => $paySystemName) {?>
								<li class="availability__item">
									<input class="availability__item__input" type="radio" id="paySystem_<?=$paySystemID?>" name="PAY_SYSTEM" value="<?=$paySystemID?>" required checked>
									<label class="availability__item__label ch-way__label " for="paySystem_<?=$paySystemID?>">
										<?=$paySystemName?>
									</label>
								</li>
							<?}?>
						</ul>
					</div>
				</div>
				<div class="checkout__ch-way " >
					<div class="checkout__ch-order ch-confirm__body">
						<h3 class="footer__question__title padding-none">Подтвердите ваш заказ</h3>
						<ul сlass="ch-confirm">
							<li class="ch-confirm__list" >
								<p class="ch-confirm__text-left">Стоимость товаров:</p>
								<p class="ch-confirm__text-right"><?=$arResult['FULL_PRICE']?> ₽</p>
							</li>
							<li class="ch-confirm__list" >
								<p class="ch-confirm__text-left">Скидка</p>
								<p class="ch-confirm__text-right"><?=$arResult['DISCOUNT']?></p>
							</li>
							<li class="ch-confirm__list" >
								<p class="ch-confirm__text-left">Доставка</p>
								<p class="ch-confirm__text-right">0 ₽</p>
							</li>
							<li class="ch-confirm__list ch-confirm__list__last">
								<p class="ch-confirm__text-right">Итого:</p>
								<p class="ch-confirm__text-right"><?=$arResult['PRICE']?> ₽</p>
							</li>
						</ul>
						<div class="checkout__ch-way__footer-b" >
							<input type="submit" name="SEND_ORDER" value="Оформить заказ" class="button footer__button ">
						</div>
					</div>
				</div>
			</form>
			<div class="b-main__right">
				<div class="b-main__right__body">
					<h3 class="footer__question__title">Ваш заказ</h3>
					<div class="order__text-1 order__color-green">
						<p class="company-page__text">Скидка</p>
						<p class="company-page__text"><?=$arResult['DISCOUNT']?></p>
					</div>
					<div class="order__text-1">
						<p class="company-page__text">Итого без доставки</p>
						<p class="company-page__text"><?=$arResult['PRICE']?> ₽</p>
					</div>
					<div class="promo-code order__color-green checkout__promo-code">
						<h3 class="footer__question__title promo-code__title">Промокод</h3>
						<form class="promo-code__search" method="post">
							<input class="footer__question__input promo-code__input" placeholder="Введите промо-код" name="promo">
						</form>
					</div>
				</div>
			</div>
		<?else:?>
			<div class="bx-sbb-empty-cart-container" style="text-align: center;">
				<?if($arResult['RESULT']):?>
					<br><hr>
					<h2 class="article-suptitle"><?=$arResult['RESULT']?></h2>
					<hr><br>
					<div><?=$arResult['PAYMENT_TEMPLATE']?></div>
				<?endif;?>
				<div class="bx-sbb-empty-cart-image">
					<img src="/local/templates/farmlavka/components/bitrix/sale.basket.basket/farmlavka/images/empty_cart.svg" alt="">
				</div>
				<div class="bx-sbb-empty-cart-text">Ваша корзина пуста</div>
				<div class="bx-sbb-empty-cart-desc">
					<a href="/">Нажмите здесь</a>, чтобы продолжить покупки
				</div>
			</div>
		<?endif;?>
	</div>
	<div class="sli">
		<div class="swiper-capabilities swiper-container-initialized swiper-container-horizontal">
			<div class="capabilities__blocks favorites__items">
				<div class=" header__bottom-item capabilitiis__items favorites__item">
					<a href="#" class="header__bottom-item__text header__bottom-item__first capabilitiis__item__body company-page__slider">
						<div class="capabilities__img-block">
							<div class="svg capabilities__img capabilities__img-1"></div>
						</div>
						<div class="capabilities__info favorites__info">
							<p class="header__bottom-item__svg capabilities__title fz-15px">
								Ассортимент
							</p>
							<p class="capabilities__text fz-14px company-page__slider-text">
								Оборудование, мебель, посуда и инвентарь
							</p>
						</div>
					</a>
				</div>
				<div class=" header__bottom-item  capabilitiis__items favorites__item ">
					<a href="#" class="header__bottom-item__text  capabilitiis__item__body company-page__slider">
						<div class="capabilities__img-block">
							<div class="svg capabilities__img capabilities__img-2"></div>
						</div>
						<div class="capabilities__info favorites__info">
							<p class="header__bottom-item__svg capabilities__title fz-15px">
								Быстрая доставка
							</p>
							<p class="capabilities__text fz-14px company-page__slider-text">
								В любую точку России быстро
							</p>
						</div>
					</a>
				</div>
				<div class="header__bottom-item  capabilitiis__items favorites__item">
					<a href="#" class="header__bottom-item__text  capabilitiis__item__body company-page__slider">
						<div class="capabilities__img-block">
							<div class="svg capabilities__img capabilities__img-3"></div>
						</div>
						<div class="capabilities__info favorites__info">
							<p class="header__bottom-item__svg capabilities__title fz-15px">
								Гарантия
							</p>
							<p class="capabilities__text fz-14px company-page__slider-text">
								Вся продукция cертифицирована
							</p>
						</div>
					</a>
				</div>
				<div class="header__bottom-item  capabilitiis__items favorites__item">
					<a href="#" class="header__bottom-item__text  capabilitiis__item__body company-page__slider">
						<div class="capabilities__img-block">
							<div class="svg capabilities__img capabilities__img-4"></div>
						</div>
						<div class="capabilities__info favorites__info">
							<p class="header__bottom-item__svg capabilities__title fz-15px">
								Низкие цены
							</p>
							<p class="capabilities__text fz-14px company-page__slider-text">
								Мы стараемся держать самые низкие цены
							</p>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
