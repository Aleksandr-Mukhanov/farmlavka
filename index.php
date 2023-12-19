<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("1С-Битрикс: Управление сайтом");

$arCapabilities = getElHL(6,[],[],['*']); // Возможности
$arHowWorking= getElHL(10,[],[],['*']); // Как мы работаем
?>

<section class="main-content ">
	<div class="_container main_container">
		<section class="main__main-content swiper-container main-top-swiper">
			<div class="main__main-content__body swiper-wrapper">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/local/include/slider_index.php"
					)
				);?>
			</div>
			<div class="swiper-button-prev swiper-button main-content__swiper-button-prev main-top-prev">
				<div></div>
			</div>
			<div class="swiper-button-next swiper-button main-content__swiper-button-next main-top-next">
				<div class="svg"></div>
			</div>
		</section>
	</div>
</section>

<section class="capabilities ">
	<div class="_container capabilities_container">
		<div class="sli">
			<div class="swiper-container swiper-capabilities">
				<div class="swiper-wrapper capabilities__blocks">
					<?foreach ($arCapabilities as $value) {?>
						<div class="swiper-slide header__bottom-item header__bottom-item__first capabilitiis__items">
							<div class="header__bottom-item__text header__bottom-item__first capabilitiis__item__body">
								<div class="capabilities__img-block">
									<div class="svg capabilities__img" style="background-image: url(<?=CFile::GetPath($value['UF_IMG'])?>)"></div>
								</div>
								<div class="capabilities__info capabilities__info__main ">
									<p class="header__bottom-item__svg capabilities__title fz-15px">
										<?=$value['UF_NAME']?>
									</p>
									<p class="capabilities__text fz-14px">
										<?=$value['UF_TEXT']?>
									</p>
								</div>
							</div>
						</div>
					<?}?>
				</div>
				<div class="swiper-pagination"></div>
			</div>
		</div>
	</div>
</section>

<section class="product">
	<div class="_container product_container">
		<div class="product__body">
			<h2 class="main-title">Акция месяца</h2>
			<div class="swiper-wrapper__buttons">
				<div class="product-cards__prev swiper-button-prev product-prev">
					<div class="svg"></div>
				</div>
				<div class="product-cards__next swiper-button-next product-next">
					<div class="svg"></div>
				</div>
			</div>
			<?$APPLICATION->IncludeComponent(
				"bitrix:catalog.section",
				".default",
				array(
					"ACTION_VARIABLE" => "action",
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
					"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":{\"1\":{\"CLASS_ID\":\"CondIBProp:1:13\",\"DATA\":{\"logic\":\"Equal\",\"value\":11}}}}",
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
		</div>
	</div>
</section>

<section class="working ">
	<div class="_container capabilities_container">
		<h2 class="main-title">Как мы работаем?</h2>

		<div class="swiper-container swiper-working">
			<div class="swiper-wrapper capabilities__blocks how-working__blocks">
				<?foreach ($arHowWorking as $value) {?>
					<div class="swiper-slide header__bottom-item header__bottom-item__first capabilitiis__items">
						<div class="header__bottom-item__text header__bottom-item__first capabilitiis__item__body">
							<div class="capabilities__img-block">
								<div class="svg how-working__img" style="background-image: url(<?=CFile::GetPath($value['UF_IMG'])?>)"></div>
							</div>
							<div class="capabilities__info capabilities__info__main">
								<p class="header__bottom-item__svg capabilities__title fz-15px">
									<?=$value['UF_NAME']?>
								</p>
								<p class="capabilities__text fz-14px">
									<?=$value['UF_TEXT']?>
								</p>
							</div>
						</div>
					</div>
				<?}?>
			</div>
			<div class="swiper-pagination"></div>
		</div>
	</div>
</section>

<?
// получим отзывы
$arOrder = ['ID'=>'DESC'];
$arFilter = ['UF_ACTIVE'=>true];
$arElHL = getElHL(9,$arOrder,$arFilter,['*']);
foreach ($arElHL as $key => $value) {
	$scoreSum += $value['UF_SCORE'];
	$arReview[] = $value;
}
$rating = round($scoreSum / count($arReview),2);
?>
<section class="reviews ">
	<div class="_container reviews_container">
		<div class="reviews__body">
			<div class="reviews__reviews-left">
				<div class="reviews-left__body">
					<div class="reviews-left__body__top">
						<p class="reviews-left__title">Cредняя оценка аптеки</p>
						<div class="reviews-left__top">
							<p class="reviews-left__grade__text"><?=$rating?></p>
							<div class="stars second-block__item__stars product-card__start">
								<?for ($i=0; $i < 5; $i++) {
									$star = ($i < $rating) ? 'star' : 'star-minus';?>
									<div class="svg star-small <?=$star?>"></div>
								<?}?>
							</div>
						</div>
					</div>
					<div class="reviews-left__grade-block">
						<p class="reviews-left__text fz-16px">
							Общий рейтинг на основе <?=count($arReview)?> отзывов наших покупателей
						</p>
						<div class="reviews-left__button-block">
							<a href="/reviews/#feedbackAdd" class="button reviews__button">
								Оставить отзыв</a>
						</div>
					</div>
				</div>
			</div>
			<div class="reviews__reviews-right">
				<ul class="reviews-right__body">
					<?foreach ($arReview as $key => $review) {?>
						<li class="review__li">
							<div class="review__top">
								<p class="review__title">
									<?=$review['UF_NAME']?>, <?=$review['UF_CITY']?>,
									<span class="review__span"><?=$review['UF_DATE']?></span>
								</p>
								<div class="stars second-block__item__stars product-card__start review__stars">
									<?for ($i=0; $i < 5; $i++) {
										$star = ($i < $review['UF_SCORE']) ? 'star' : 'star-minus';?>
										<div class="svg star-small <?=$star?>"></div>
									<?}?>
								</div>
							</div>
							<p class="review__text">
								<?=$review['UF_TEXT']?>
							</p>
						</li>
					<?}?>
				</ul>
				<a href="/reviews/" class="reviews__href">
					<div class="svg reviews__href__svg"></div>
					<p class="reviews__href__text">Все <?=count($arReview)?> отзывов</p>
				</a>
			</div>
		</div>
	</div>
</section>

<?$arPartner = getElHL(7,[],[],['*']);?>
<section class="partners ">
	<div class="_container product_container">
		<div class="product__body partners__body">
			<h2 class="main-title">Наши партнеры</h2>
			<div class="swiper-container swiper-partners">
				<div class="swiper-wrapper product__product-cards partners__items">
					<div class="swiper-slide">
						<?$n = 0;
						foreach ($arPartner as $partner) { $n++;?>
							<div class="product-card partners__item">
								<div class="product-card__block__img">
									<div class="partners__item__img">
										<img src="<?=CFile::GetPath($partner['UF_IMG'])?>" alt="<?=$partner['UF_NAME']?>" />
									</div>
								</div>
							</div>
							<?if ($n % 2 == 0) echo '</div><div class="swiper-slide">'?>
						<?}?>
					</div>
				</div>
			</div>
			<div class="swiper-wrapper__buttons">
				<div class="product-cards__prev swiper-button-prev swiper-button-disabled partners-prev">
					<div class="svg"></div>
				</div>
				<div class="product-cards__next swiper-button-next swiper-button-disabled partners-next">
					<div class="svg"></div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="company ">
	<div class="_container">
		<h2 class="main-title">О компании</h2>
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "inc",
				"EDIT_TEMPLATE" => "",
				"PATH" => "/local/include/company_index.php"
			)
		);?>
	</div>
</section>

<section class="product-filter">
	<div class="_container product-filter_container">
		<div class="product-filter__body">
			<div class="product-filter__top">
				<p class="main-title">Поиск по алфавиту</p>
				<a href="/disease/" class="product-filter__suptitle">Выбор товара по заболеванию </a>
			</div>
			<div class="product-filter__alphabet">
				<div class="alphabet__content">
					<?
						$arAlphabetRU = ['а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я'];
						$arAlphabetEN = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
						$arAlphabetNUM = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
					?>
					<div class="alphabet__items alphabet__ru">
						<?foreach ($arAlphabetRU as $value) {?>
							<a href="/disease/?letter=<?=$value?>" class="alphabet__item">
								<p class="alphabet__item__body alphabet__ru__item">
									<?=$value?>
								</p>
							</a>
						<?}?>
					</div>
					<div class="alphabet__items alphabet__en">
						<?foreach ($arAlphabetEN as $value) {?>
							<a href="/disease/?letter=<?=$value?>" class="alphabet__item">
								<p class="alphabet__item__body alphabet__en__item">
									<?=$value?>
								</p>
							</a>
						<?}?>
					</div>
					<div class="alphabet__items alphabet__number">
						<?foreach ($arAlphabetNUM as $value) {?>
							<a href="/disease/?letter=<?=$value?>" class="alphabet__item">
								<p class="alphabet__item__body alphabet__en__item">
									<?=$value?>
								</p>
							</a>
						<?}?>
					</div>
				</div>
				<div class="alphabet__big-number">
					<p class="alphabet__big-number__text">
						а-я
					</p>
				</div>
			</div>
		</div>
		<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "sections_index", Array(
			"ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",	// Дополнительный фильтр для подсчета количества элементов в разделе
				"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
				"CACHE_FILTER" => "Y",	// Кешировать при установленном фильтре
				"CACHE_GROUPS" => "N",	// Учитывать права доступа
				"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
				"CACHE_TYPE" => "A",	// Тип кеширования
				"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
				"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",	// Показывать количество
				"FILTER_NAME" => "sectionsFilter",	// Имя массива со значениями фильтра разделов
				"HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",	// Скрывать разделы с нулевым количеством элементов
				"IBLOCK_ID" => "1",	// Инфоблок
				"IBLOCK_TYPE" => "catalog",	// Тип инфоблока
				"SECTION_CODE" => "",	// Код раздела
				"SECTION_FIELDS" => array(	// Поля разделов
					0 => "",
					1 => "",
				),
				"SECTION_ID" => "",	// ID раздела
				"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
				"SECTION_USER_FIELDS" => array(	// Свойства разделов
					0 => "",
					1 => "",
				),
				"SHOW_PARENT_NAME" => "Y",	// Показывать название раздела
				"TOP_DEPTH" => "3",	// Максимальная отображаемая глубина разделов
				"VIEW_MODE" => "LIST",	// Вид списка подразделов
			),
			false
		);?>
	</div>
</section>

<?$APPLICATION->IncludeComponent("bitrix:news.list", "blog_index", Array(
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"CACHE_FILTER" => "Y",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "N",	// Учитывать права доступа
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
		"DISPLAY_DATE" => "Y",	// Выводить дату элемента
		"DISPLAY_NAME" => "Y",	// Выводить название элемента
		"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"FIELD_CODE" => array(	// Поля
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",	// Фильтр
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"IBLOCK_ID" => "2",	// Код информационного блока
		"IBLOCK_TYPE" => "catalog",	// Тип информационного блока (используется только для проверки)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"NEWS_COUNT" => "4",	// Количество новостей на странице
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"PAGER_TITLE" => "Новости",	// Название категорий
		"PARENT_SECTION" => "",	// ID раздела
		"PARENT_SECTION_CODE" => "",	// Код раздела
		"PREVIEW_TRUNCATE_LEN" => "100",	// Максимальная длина анонса для вывода (только для типа текст)
		"PROPERTY_CODE" => array(	// Свойства
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
		"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
		"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
		"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
