<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");?>
<section class="basket" >
	<?$APPLICATION->IncludeComponent(
		"bitrix:sale.basket.basket",
		"farmlavka",
		array(
			"ACTION_VARIABLE" => "basketAction",
			"ADDITIONAL_PICT_PROP_1" => "-",
			"AUTO_CALCULATION" => "Y",
			"BASKET_IMAGES_SCALING" => "adaptive",
			"COLUMNS_LIST_EXT" => array(
				0 => "PREVIEW_PICTURE",
				1 => "DISCOUNT",
				2 => "DELETE",
				3 => "SUM",
				4 => "PROPERTY_BRAND",
				5 => "PROPERTY_QNT_PACKAGE",
				6 => "PROPERTY_ARTICLE",
				7 => "PROPERTY_RATING",
			),
			"COLUMNS_LIST_MOBILE" => array(
				0 => "PREVIEW_PICTURE",
				1 => "DISCOUNT",
				2 => "DELETE",
				3 => "SUM",
			),
			"COMPATIBLE_MODE" => "N",
			"CORRECT_RATIO" => "Y",
			"DEFERRED_REFRESH" => "N",
			"DISCOUNT_PERCENT_POSITION" => "bottom-right",
			"DISPLAY_MODE" => "extended",
			"EMPTY_BASKET_HINT_PATH" => "/",
			"GIFTS_BLOCK_TITLE" => "Выберите один из подарков",
			"GIFTS_CONVERT_CURRENCY" => "N",
			"GIFTS_HIDE_BLOCK_TITLE" => "N",
			"GIFTS_HIDE_NOT_AVAILABLE" => "N",
			"GIFTS_MESS_BTN_BUY" => "Выбрать",
			"GIFTS_MESS_BTN_DETAIL" => "Подробнее",
			"GIFTS_PAGE_ELEMENT_COUNT" => "4",
			"GIFTS_PLACE" => "BOTTOM",
			"GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
			"GIFTS_PRODUCT_QUANTITY_VARIABLE" => "quantity",
			"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
			"GIFTS_SHOW_OLD_PRICE" => "N",
			"GIFTS_TEXT_LABEL_GIFT" => "Подарок",
			"HIDE_COUPON" => "N",
			"LABEL_PROP" => array(
				0 => "DAY_PRODUCT",
			),
			"LABEL_PROP_MOBILE" => array(
			),
			"LABEL_PROP_POSITION" => "top-left",
			"PATH_TO_ORDER" => "/personal/order/make/",
			"PRICE_DISPLAY_MODE" => "Y",
			"PRICE_VAT_SHOW_VALUE" => "N",
			"PRODUCT_BLOCKS_ORDER" => "props,sku,columns",
			"QUANTITY_FLOAT" => "Y",
			"SET_TITLE" => "Y",
			"SHOW_DISCOUNT_PERCENT" => "Y",
			"SHOW_FILTER" => "Y",
			"SHOW_RESTORE" => "Y",
			"TEMPLATE_THEME" => "green",
			"TOTAL_BLOCK_DISPLAY" => array(
				0 => "top",
			),
			"USE_DYNAMIC_SCROLL" => "Y",
			"USE_ENHANCED_ECOMMERCE" => "N",
			"USE_GIFTS" => "N",
			"USE_PREPAYMENT" => "N",
			"USE_PRICE_ANIMATION" => "Y",
			"COMPONENT_TEMPLATE" => "farmlavka"
		),
		false
	);?>
	<section class="product section-margin">
		<div class="_container product_container">
			<div class="product__body">
				<h2 class="main-title">Всегда пригодится</h2>
				<?$APPLICATION->IncludeComponent(
					"bitrix:catalog.section",
					".default",
					array(
						"ACTION_VARIABLE" => "always",
						"ADD_PICT_PROP" => "PHOTO",
						"ADD_PROPERTIES_TO_BASKET" => "Y",
						"ADD_SECTIONS_CHAIN" => "N",
						"ADD_TO_BASKET_ACTION" => "ADD",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_ADDITIONAL" => "",
						"AJAX_OPTION_HISTORY" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"BACKGROUND_IMAGE" => "",
						"BASKET_URL" => "/personal/basket.php",
						"BROWSER_TITLE" => "-",
						"CACHE_FILTER" => "Y",
						"CACHE_GROUPS" => "N",
						"CACHE_TIME" => "36000000",
						"CACHE_TYPE" => "A",
						"COMPATIBLE_MODE" => "N",
						"CONVERT_CURRENCY" => "N",
						"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":{\"1\":{\"CLASS_ID\":\"CondIBProp:1:35\",\"DATA\":{\"logic\":\"Equal\",\"value\":24}}}}",
						"DETAIL_URL" => "",
						"DISABLE_INIT_JS_IN_COMPONENT" => "N",
						"DISPLAY_BOTTOM_PAGER" => "Y",
						"DISPLAY_COMPARE" => "N",
						"DISPLAY_TOP_PAGER" => "N",
						"ELEMENT_SORT_FIELD" => "sort",
						"ELEMENT_SORT_FIELD2" => "id",
						"ELEMENT_SORT_ORDER" => "asc",
						"ELEMENT_SORT_ORDER2" => "desc",
						"ENLARGE_PRODUCT" => "STRICT",
						"FILTER_NAME" => "arrFilterAction",
						"HIDE_NOT_AVAILABLE" => "L",
						"HIDE_NOT_AVAILABLE_OFFERS" => "N",
						"IBLOCK_ID" => "1",
						"IBLOCK_TYPE" => "catalog",
						"INCLUDE_SUBSECTIONS" => "Y",
						"LABEL_PROP" => array(
							0 => "DAY_PRODUCT",
							1 => "HIT",
							2 => "PICKUP_ONLY",
							3 => "ACTION",
						),
						"LAZY_LOAD" => "N",
						"LINE_ELEMENT_COUNT" => "3",
						"LOAD_ON_SCROLL" => "N",
						"MESSAGE_404" => "",
						"MESS_BTN_ADD_TO_BASKET" => "В корзину",
						"MESS_BTN_BUY" => "Купить",
						"MESS_BTN_DETAIL" => "Подробнее",
						"MESS_BTN_LAZY_LOAD" => "Показать ещё",
						"MESS_BTN_SUBSCRIBE" => "Подписаться",
						"MESS_NOT_AVAILABLE" => "Нет в наличии",
						"META_DESCRIPTION" => "-",
						"META_KEYWORDS" => "-",
						"OFFERS_LIMIT" => "5",
						"PAGER_BASE_LINK_ENABLE" => "N",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_TEMPLATE" => ".default",
						"PAGER_TITLE" => "Товары",
						"PAGE_ELEMENT_COUNT" => "24",
						"PARTIAL_PRODUCT_PROPERTIES" => "Y",
						"PRICE_CODE" => array(
							0 => "BASE",
						),
						"PRICE_VAT_INCLUDE" => "Y",
						"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
						"PRODUCT_ID_VARIABLE" => "id",
						"PRODUCT_PROPS_VARIABLE" => "prop",
						"PRODUCT_QUANTITY_VARIABLE" => "quantity",
						"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false}]",
						"PRODUCT_SUBSCRIPTION" => "Y",
						"PROPERTY_CODE_MOBILE" => array(
						),
						"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
						"RCM_TYPE" => "any",
						"SECTION_CODE" => "",
						"SECTION_CODE_PATH" => "",
						"SECTION_ID" => $_REQUEST["SECTION_ID"],
						"SECTION_ID_VARIABLE" => "SECTION_ID",
						"SECTION_URL" => "",
						"SECTION_USER_FIELDS" => array(
							0 => "",
							1 => "",
						),
						"SEF_MODE" => "Y",
						"SEF_RULE" => "",
						"SET_BROWSER_TITLE" => "N",
						"SET_LAST_MODIFIED" => "N",
						"SET_META_DESCRIPTION" => "N",
						"SET_META_KEYWORDS" => "N",
						"SET_STATUS_404" => "N",
						"SET_TITLE" => "N",
						"SHOW_404" => "N",
						"SHOW_ALL_WO_SECTION" => "Y",
						"SHOW_CLOSE_POPUP" => "Y",
						"SHOW_DISCOUNT_PERCENT" => "N",
						"SHOW_FROM_SECTION" => "Y",
						"SHOW_MAX_QUANTITY" => "N",
						"SHOW_OLD_PRICE" => "Y",
						"SHOW_PRICE_COUNT" => "1",
						"SHOW_SLIDER" => "N",
						"SLIDER_INTERVAL" => "3000",
						"SLIDER_PROGRESS" => "N",
						"TEMPLATE_THEME" => "",
						"USE_ENHANCED_ECOMMERCE" => "N",
						"USE_MAIN_ELEMENT_SECTION" => "N",
						"USE_PRICE_COUNT" => "N",
						"USE_PRODUCT_QUANTITY" => "N",
						"COMPONENT_TEMPLATE" => ".default",
						"LABEL_PROP_MOBILE" => array(
						),
						"LABEL_PROP_POSITION" => "top-left",
						"SWIPER_SLIDE" => "Y"
					),
					false
				);?>
				<!-- <div class="swiper-container product-swiper-1 product__products-1__items swiper-container-initialized swiper-container-horizontal">
					<div class="swiper-wrapper product__product-cards" id="swiper-wrapper-21c913a8d1ef87b3" aria-live="polite" style="transform: translate3d(0px, 0px, 0px);">
						<a class="swiper-slide product-card swiper-slide-active" role="group" aria-label="1 / 5" style="width: 264.2px; margin-right: 15px;">
							<div class="product-card__block__img">
								<div class="product-card__img">
									<img src="./img/main-content/product-1.jpg" alt="таблетка">
								</div>
							</div>
							<div class="product-card__body">
								<div class="product-card__top">
									<p class="product-card__available fz-12px">
										Есть в наличии
									</p>
									<div class="stars second-block__item__stars product-card__start">
										<div class="svg star-small star"></div>
										<div class="svg star-small star"></div>
										<div class="svg star-small star"></div>
										<div class="svg star-small star"></div>
										<div class="svg star-small star-minus"></div>
									</div>
								</div>
								<p class="product-card__title fz-16px">
									Велсон таблетки покрыт. плен. об. 3 мг, 30 шт.
								</p>
								<ul class="product-card__ul">
									<li class="product-card__li">
										<p class="product-card__text fz-12px">
											Бренд:
											<span class="product-card__span">Lirina</span>
										</p>
									</li>
									<li class="product-card__li">
										<p class="product-card__text fz-12px">
											Количество в упаковке:
											<span class="product-card__span">10 шт</span>
										</p>
									</li>
									<li class="product-card__li">
										<p class="product-card__text fz-12px">
											Код товара:
											<span class="product-card__span">153249</span>
										</p>
									</li>
								</ul>
								<div class="product-card__price-block">
									<div class="product-card__price">
										<p class="product-card__price__1 fz-24px">
											41 108 руб.
										</p>
										<p class="product-card__price__2 fz-14px">
											49 999 руб.
										</p>
									</div>
									<div class="svg product-card__busket"></div>
								</div>
							</div>
							<div class="product-card__bottom ">
								<button class="product-card__b-button  myBtn" data-modal="myModal4">
									Купить в 1 клик
								</button>
							</div>
						</a>
						<a class="swiper-slide product-card swiper-slide-next" role="group" aria-label="2 / 5" style="width: 264.2px; margin-right: 15px;">
							<div class="product-card__block__img">
								<div class="product-card__img">
									<img src="./img/main-content/product-2.jpg" alt="таблетка">
								</div>
							</div>
							<div class="product-card__body">
								<div class="product-card__top">
									<p class="product-card__available fz-12px">
										Есть в наличии
									</p>
									<div class="stars second-block__item__stars product-card__start">
										<div class="svg star-small star"></div>
										<div class="svg star-small star"></div>
										<div class="svg star-small star"></div>
										<div class="svg star-small star"></div>
										<div class="svg star-small star-minus"></div>
									</div>
								</div>
								<p class="product-card__title fz-16px">
									Велсон таблетки покрыт. плен. об. 3 мг, 30 шт.
								</p>
								<ul class="product-card__ul">
									<li class="product-card__li">
										<p class="product-card__text fz-12px">
											Бренд:
											<span class="product-card__span">Lirina</span>
										</p>
									</li>
									<li class="product-card__li">
										<p class="product-card__text fz-12px">
											Количество в упаковке:
											<span class="product-card__span">10 шт</span>
										</p>
									</li>
									<li class="product-card__li">
										<p class="product-card__text fz-12px">
											Код товара:
											<span class="product-card__span">153249</span>
										</p>
									</li>
								</ul>
								<div class="product-card__price-block">
									<div class="product-card__price">
										<p class="product-card__price__1 fz-24px">
											41 108 руб.
										</p>
										<p class="product-card__price__2 fz-14px">
											49 999 руб.
										</p>
									</div>
									<div class="svg product-card__busket"></div>
								</div>
							</div>
							<div class="product-card__bottom ">
								<button class="product-card__b-button b-button__not-available myBtn" data-modal="myModal8">
									Сообщить о наличии
								</button>
							</div>
						</a>
						<a class="swiper-slide product-card" role="group" aria-label="3 / 5" style="width: 264.2px; margin-right: 15px;">
							<div class="product-card__block__img">
								<div class="product-card__img">
									<img src="./img/main-content/product-3.jpg" alt="таблетка">
								</div>
							</div>
							<div class="product-card__body">
								<div class="product-card__top">
									<p class="product-card__available fz-12px">
										Есть в наличии
									</p>
									<div class="stars second-block__item__stars product-card__start">
										<div class="svg star-small star"></div>
										<div class="svg star-small star"></div>
										<div class="svg star-small star"></div>
										<div class="svg star-small star"></div>
										<div class="svg star-small star-minus"></div>
									</div>
								</div>
								<p class="product-card__title fz-16px">
									Велсон таблетки покрыт. плен. об. 3 мг, 30 шт.
								</p>
								<ul class="product-card__ul">
									<li class="product-card__li">
										<p class="product-card__text fz-12px">
											Бренд:
											<span class="product-card__span">Lirina</span>
										</p>
									</li>
									<li class="product-card__li">
										<p class="product-card__text fz-12px">
											Количество в упаковке:
											<span class="product-card__span">10 шт</span>
										</p>
									</li>
									<li class="product-card__li">
										<p class="product-card__text fz-12px">
											Код товара:
											<span class="product-card__span">153249</span>
										</p>
									</li>
								</ul>
								<div class="product-card__price-block">
									<div class="product-card__price">
										<p class="product-card__price__1 fz-24px">
											41 108 руб.
										</p>
										<p class="product-card__price__2 fz-14px">
											49 999 руб.
										</p>
									</div>
									<div class="svg product-card__busket"></div>
								</div>
							</div>
							<div class="product-card__bottom ">
								<button class="product-card__b-button  myBtn" data-modal="myModal4">
									Купить в 1 клик
								</button>
							</div>
						</a>
						<a class="swiper-slide product-card" role="group" aria-label="4 / 5" style="width: 264.2px; margin-right: 15px;">
							<div class="product-card__block__img">
								<div class="product-card__img">
									<img src="./img/main-content/product-4.jpg" alt="таблетка">
								</div>
							</div>
							<div class="product-card__body">
								<div class="product-card__top">
									<p class="product-card__available fz-12px">
										Есть в наличии
									</p>
									<div class="stars second-block__item__stars product-card__start">
										<div class="svg star-small star"></div>
										<div class="svg star-small star"></div>
										<div class="svg star-small star"></div>
										<div class="svg star-small star"></div>
										<div class="svg star-small star-minus"></div>
									</div>
								</div>
								<p class="product-card__title fz-16px">
									Велсон таблетки покрыт. плен. об. 3 мг, 30 шт.
								</p>
								<ul class="product-card__ul">
									<li class="product-card__li">
										<p class="product-card__text fz-12px">
											Бренд:
											<span class="product-card__span">Lirina</span>
										</p>
									</li>
									<li class="product-card__li">
										<p class="product-card__text fz-12px">
											Количество в упаковке:
											<span class="product-card__span">10 шт</span>
										</p>
									</li>
									<li class="product-card__li">
										<p class="product-card__text fz-12px">
											Код товара:
											<span class="product-card__span">153249</span>
										</p>
									</li>
								</ul>
								<div class="product-card__price-block">
									<div class="product-card__price">
										<p class="product-card__price__1 fz-24px">
											41 108 руб.
										</p>
										<p class="product-card__price__2 fz-14px">
											49 999 руб.
										</p>
									</div>
									<div class="svg product-card__busket"></div>
								</div>
							</div>
							<div class="product-card__bottom ">
								<button class="product-card__b-button  myBtn" data-modal="myModal4">
									Купить в 1 клик
								</button>
							</div>
						</a>
						<a class="swiper-slide product-card" role="group" aria-label="5 / 5" style="width: 264.2px; margin-right: 15px;">
							<div class="product-card__block__img">
								<div class="product-card__img">
									<img src="./img/main-content/product-5.jpg" alt="таблетка">
								</div>
							</div>
							<div class="product-card__body">
								<div class="product-card__top">
									<p class="product-card__available fz-12px">
										Есть в наличии
									</p>
									<div class="stars second-block__item__stars product-card__start">
										<div class="svg star-small star"></div>
										<div class="svg star-small star"></div>
										<div class="svg star-small star"></div>
										<div class="svg star-small star"></div>
										<div class="svg star-small star-minus"></div>
									</div>
								</div>
								<p class="product-card__title fz-16px">
									Велсон таблетки покрыт. плен. об. 3 мг, 30 шт.
								</p>
								<ul class="product-card__ul">
									<li class="product-card__li">
										<p class="product-card__text fz-12px">
											Бренд:
											<span class="product-card__span">Lirina</span>
										</p>
									</li>
									<li class="product-card__li">
										<p class="product-card__text fz-12px">
											Количество в упаковке:
											<span class="product-card__span">10 шт</span>
										</p>
									</li>
									<li class="product-card__li">
										<p class="product-card__text fz-12px">
											Код товара:
											<span class="product-card__span">153249</span>
										</p>
									</li>
								</ul>
								<div class="product-card__price-block">
									<div class="product-card__price">
										<p class="product-card__price__1 fz-24px">
											41 108 руб.
										</p>
										<p class="product-card__price__2 fz-14px">
											49 999 руб.
										</p>
									</div>
									<div class="svg product-card__busket"></div>
								</div>
							</div>
							<div class="product-card__bottom ">
								<button class="product-card__b-button  myBtn" data-modal="myModal4">
									Купить в 1 клик
								</button>
							</div>
						</a>
					</div>
					<span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
				</div> -->
				<div class="swiper-wrapper__buttons">
					<div class="product-cards__prev swiper-button-prev swiper-button-disabled" tabindex="-1" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-7ec6a23a7ccdb2b1" aria-disabled="true">
						<div class="svg"></div>
					</div>
					<div class="product-cards__next swiper-button-next swiper-button-disabled" tabindex="-1" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-7ec6a23a7ccdb2b1" aria-disabled="true">
						<div class="svg"></div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="_container basket__bottom">
		<div class="sli">
			<div class="swiper-capabilities swiper-container-initialized swiper-container-horizontal">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/local/include/capabilities_4.php"
					)
				);?>
			</div>
		</div>
	</div>
</section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
