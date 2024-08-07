<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

/**
 * @global CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 * @var array $arCurSection
 */

if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] == 'Y')
{
	$basketAction = isset($arParams['COMMON_ADD_TO_BASKET_ACTION']) ? $arParams['COMMON_ADD_TO_BASKET_ACTION'] : '';
}
else
{
	$basketAction = isset($arParams['SECTION_ADD_TO_BASKET_ACTION']) ? $arParams['SECTION_ADD_TO_BASKET_ACTION'] : '';
}?>
<section class="categories">
	<div class="_container">
		<div class="categories__main-grid">
<?if ($isFilter || $isSidebar): //dump($arResult["VARIABLES"]);?>
	<div class="categories__left">
		<a data-modal="myModal11" class="myBtn cb-button categories__left__b-button-top" >
			<div class="header__contacts__block__text__active cb-button-top">
				<div class="svg header__contacts__block__svg "></div>
				<p>показать Все категории</p>
			</div>
		</a>
		<a data-modal="myModal10" class="myBtn cb-button categories__left__b-button-bottom" >
			<div class="header__contacts__block__text__active cb-button-bottom">
				<div class="svg header__contacts__block__svg"></div>
				<p>показать фильтр</p>
			</div>
		</a>
		<?$sectionListParams = array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
			"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
			"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
			"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
			"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
			"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
			"ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
		);
		if ($sectionListParams["COUNT_ELEMENTS"] === "Y")
		{
			$sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_ACTIVE";
			if ($arParams["HIDE_NOT_AVAILABLE"] == "Y")
			{
				$sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_AVAILABLE";
			}
		}
		$APPLICATION->IncludeComponent(
			"bitrix:catalog.section.list",
			"",
			$sectionListParams,
			$component,
			array("HIDE_ICONS" => "Y")
		);
		unset($sectionListParams);?>
		<?if($isFilter):?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:catalog.smart.filter",
				"",
				array(
					"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"SECTION_ID" => $arCurSection['ID'],
					"FILTER_NAME" => $arParams["FILTER_NAME"],
					"PRICE_CODE" => $arParams["~PRICE_CODE"],
					"CACHE_TYPE" => $arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
					"SAVE_IN_SESSION" => "N",
					"FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
					"XML_EXPORT" => "N",
					"SECTION_TITLE" => "NAME",
					"SECTION_DESCRIPTION" => "DESCRIPTION",
					'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
					"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
					'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
					'CURRENCY_ID' => $arParams['CURRENCY_ID'],
					"SEF_MODE" => $arParams["SEF_MODE"],
					"SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
					"SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
					"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
					"INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
				),
				$component,
				array('HIDE_ICONS' => 'Y')
			);?>
		<?endif?>
		<div class="categories__bestseller none-960">
			<h2 class="section__title">хиты продаж</h2>
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
					"AREA_FILE_SHOW" => "file",
					"AREA_FILE_SUFFIX" => "inc",
					"EDIT_TEMPLATE" => "",
					"PATH" => "/local/include/hit.php"
				)
			);?>
		</div>
		<?if($isSidebar):?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => $arParams["SIDEBAR_PATH"],
					"AREA_FILE_RECURSIVE" => "N",
					"EDIT_MODE" => "html",
				),
				false,
				array('HIDE_ICONS' => 'Y')
			);?>
		<?endif?>
	</div>
<?endif?>
<div class="categories__right">
	<?global $arrFilterLink;
	$arrFilterLink['UF_LINK_BLOCK'] = true;
	if (ModuleManager::isModuleInstalled("sale"))
	{
		$arRecomData = array();
		$recomCacheID = array('IBLOCK_ID' => $arParams['IBLOCK_ID']);
		$obCache = new CPHPCache();
		if ($obCache->InitCache(36000, serialize($recomCacheID), "/sale/bestsellers"))
		{
			$arRecomData = $obCache->GetVars();
		}
		elseif ($obCache->StartDataCache())
		{
			if (Loader::includeModule("catalog"))
			{
				$arSKU = CCatalogSku::GetInfoByProductIBlock($arParams['IBLOCK_ID']);
				$arRecomData['OFFER_IBLOCK_ID'] = (!empty($arSKU) ? $arSKU['IBLOCK_ID'] : 0);
			}
			$obCache->EndDataCache($arRecomData);
		}
	}?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.section.list",
		"sections_link",
		Array(
			"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
			"CACHE_FILTER" => "Y",	// Кешировать при установленном фильтре
			"CACHE_GROUPS" => "N",	// Учитывать права доступа
			"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
			"CACHE_TYPE" => "A",	// Тип кеширования
			"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
			"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",	// Показывать количество
			"FILTER_NAME" => "arrFilterLink",	// Имя массива со значениями фильтра разделов
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
			"SHOW_PARENT_NAME" => "N",	// Показывать название раздела
			"TOP_DEPTH" => "3",	// Максимальная отображаемая глубина разделов
			"VIEW_MODE" => "LIST",	// Вид списка подразделов
		),
		false
	);?>
	<div class="categories__right__brands">
		<h2 class="section__title">
			Популярные бренды
		</h2>
		<ul class="section__margin brands__items">
			<?// получим бренды
				$arBrand = getElHL(5,[],[],['*']);
				foreach ($arBrand as $brand) {?>
				<li class="brand__item">
					<a href="?brand=<?=$brand['UF_XML_ID']?>" class="brand__item__body <?=($brand['UF_XML_ID'] == $_REQUEST['brand'])?'active':''?>">
						<?=mb_strimwidth($brand['UF_NAME'], 0, 15, '...');?>
					</a>
				</li>
			<?}
			if(isset($_REQUEST['sort'])){ // если есть сортировка
					switch($_REQUEST['sort']){
						case 'price':
							$sortBy = 'CATALOG_PRICE_1';
							$sortOrder = 'asc';
							break;
						case 'popular':
							$sortBy = 'SHOW_COUNTER';
							$sortOrder = 'desc';
							break;
						default:
							$sortBy = $arParams["ELEMENT_SORT_FIELD"];
			        $sortOrder = $arParams["ELEMENT_SORT_ORDER"];
							break;
					}
				}else{
					$sortBy = $arParams["ELEMENT_SORT_FIELD"];
					$sortOrder = $arParams["ELEMENT_SORT_ORDER"];
				}
			?>
		</ul>
	</div>
	<div class="categories__sort" >
		<div class="sort__left" >
			<div class="sort__left__body" >
				<p class="section__title" >
					Сортировать:
				</p>
			</div>

			<?if($_REQUEST['sort'] == 'price'):?>
				<a href="?sort=price" class="sort__price sort__hover" >
					<div class="sort__price__svg-block" >
						<span></span>
					</div>
					<p class="sort__price__text" >По цене</p>
				</a>
			<?else:?>
				<a href="?sort=price" class="sort__text sort__hover" >
					По цене
				</a>
			<?endif;?>

			<?if($_REQUEST['sort'] == 'popular'):?>
				<a href="?sort=popular" class="sort__price sort__hover" >
					<div class="sort__price__svg-block" >
						<span></span>
					</div>
					<p class="sort__price__text" >По популярности</p>
				</a>
			<?else:?>
				<a href="?sort=popular" class="sort__text sort__hover" >
					По популярности
				</a>
			<?endif;?>
		</div>

		<?$APPLICATION->ShowViewContent('top_pagination');?>
	</div>
	<!-- product-filter -->
	<?$intSectionID = $APPLICATION->IncludeComponent(
		"bitrix:catalog.section",
		"",
		array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"ELEMENT_SORT_FIELD" => $sortBy,
			"ELEMENT_SORT_ORDER" => $sortOrder,
			"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
			"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
			"PROPERTY_CODE" => (isset($arParams["LIST_PROPERTY_CODE"]) ? $arParams["LIST_PROPERTY_CODE"] : []),
			"PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
			"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
			"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
			"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
			"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
			"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
			"BASKET_URL" => $arParams["BASKET_URL"],
			"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
			"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
			"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
			"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
			"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
			"FILTER_NAME" => $arParams["FILTER_NAME"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_FILTER" => $arParams["CACHE_FILTER"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"SET_TITLE" => $arParams["SET_TITLE"],
			"MESSAGE_404" => $arParams["~MESSAGE_404"],
			"SET_STATUS_404" => $arParams["SET_STATUS_404"],
			"SHOW_404" => $arParams["SHOW_404"],
			"FILE_404" => $arParams["FILE_404"],
			"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
			"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
			"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
			"PRICE_CODE" => $arParams["~PRICE_CODE"],
			"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
			"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

			"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
			"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
			"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
			"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
			"PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"]) ? $arParams["PRODUCT_PROPERTIES"] : []),

			"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
			"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
			"PAGER_TITLE" => $arParams["PAGER_TITLE"],
			"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
			"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
			"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
			"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
			"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
			"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
			"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
			"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
			"LAZY_LOAD" => $arParams["LAZY_LOAD"],
			"MESS_BTN_LAZY_LOAD" => $arParams["~MESS_BTN_LAZY_LOAD"],
			"LOAD_ON_SCROLL" => $arParams["LOAD_ON_SCROLL"],

			"OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"]) ? $arParams["OFFERS_CART_PROPERTIES"] : []),
			"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
			"OFFERS_PROPERTY_CODE" => (isset($arParams["LIST_OFFERS_PROPERTY_CODE"]) ? $arParams["LIST_OFFERS_PROPERTY_CODE"] : []),
			"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
			"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
			"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
			"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
			"OFFERS_LIMIT" => (isset($arParams["LIST_OFFERS_LIMIT"]) ? $arParams["LIST_OFFERS_LIMIT"] : 0),

			"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
			"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
			"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
			"USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
			'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
			'CURRENCY_ID' => $arParams['CURRENCY_ID'],
			'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
			'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

			'LABEL_PROP' => $arParams['LABEL_PROP'],
			'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
			'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
			'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
			'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
			'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
			'PRODUCT_ROW_VARIANTS' => $arParams['LIST_PRODUCT_ROW_VARIANTS'],
			'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
			'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
			'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
			'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
			'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

			'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
			'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
			'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
			'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
			'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
			'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
			'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
			'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
			'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
			'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
			'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
			'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
			'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
			'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
			'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
			'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
			'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

			'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
			'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
			'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

			'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
			"ADD_SECTIONS_CHAIN" => "N",
			'ADD_TO_BASKET_ACTION' => $basketAction,
			'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
			'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
			'COMPARE_NAME' => $arParams['COMPARE_NAME'],
			'USE_COMPARE_LIST' => 'Y',
			'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
			'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
			'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
		),
		$component
	);?>
	<!-- end product-filter -->
</div> <!-- end categories__right -->
		</div>
	</div>
</section>
<section class="product section-margin">
	<div class="_container product_container">
		<div class="product__body">
			<h2 class="main-title">Акция месяца</h2>
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

<section class="product section-margin">
	<div class="_container product_container">
		<div class="product__body">
			<h2 class="main-title">Вы смотрели</h2>
			<br><br>
			<?$APPLICATION->IncludeComponent(
				'bitrix:catalog.products.viewed',
				'',
				array(
					'IBLOCK_MODE' => 'single',
					'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
					'IBLOCK_ID' => $arParams['IBLOCK_ID'],
					'ELEMENT_SORT_FIELD' => $arParams['ELEMENT_SORT_FIELD'],
					'ELEMENT_SORT_ORDER' => $arParams['ELEMENT_SORT_ORDER'],
					'ELEMENT_SORT_FIELD2' => $arParams['ELEMENT_SORT_FIELD2'],
					'ELEMENT_SORT_ORDER2' => $arParams['ELEMENT_SORT_ORDER2'],
					'PROPERTY_CODE_'.$arParams['IBLOCK_ID'] => (isset($arParams['LIST_PROPERTY_CODE']) ? $arParams['LIST_PROPERTY_CODE'] : []),
					'PROPERTY_CODE_'.$recommendedData['OFFER_IBLOCK_ID'] => (isset($arParams['LIST_OFFERS_PROPERTY_CODE']) ? $arParams['LIST_OFFERS_PROPERTY_CODE'] : []),
					'PROPERTY_CODE_MOBILE'.$arParams['IBLOCK_ID'] => $arParams['LIST_PROPERTY_CODE_MOBILE'],
					'BASKET_URL' => $arParams['BASKET_URL'],
					'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
					'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
					'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
					'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
					'CACHE_TYPE' => $arParams['CACHE_TYPE'],
					'CACHE_TIME' => $arParams['CACHE_TIME'],
					'CACHE_FILTER' => $arParams['CACHE_FILTER'],
					'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
					'DISPLAY_COMPARE' => $arParams['USE_COMPARE'],
					'PRICE_CODE' => $arParams['~PRICE_CODE'],
					'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
					'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
					'PAGE_ELEMENT_COUNT' => 4,
					'SECTION_ELEMENT_ID' => $elementId,

					"SET_TITLE" => "N",
					"SET_BROWSER_TITLE" => "N",
					"SET_META_KEYWORDS" => "N",
					"SET_META_DESCRIPTION" => "N",
					"SET_LAST_MODIFIED" => "N",
					"ADD_SECTIONS_CHAIN" => "N",

					'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
					'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
					'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
					'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
					'CART_PROPERTIES_'.$arParams['IBLOCK_ID'] => (isset($arParams['PRODUCT_PROPERTIES']) ? $arParams['PRODUCT_PROPERTIES'] : []),
					'CART_PROPERTIES_'.$recommendedData['OFFER_IBLOCK_ID'] => (isset($arParams['OFFERS_CART_PROPERTIES']) ? $arParams['OFFERS_CART_PROPERTIES'] : []),
					'ADDITIONAL_PICT_PROP_'.$arParams['IBLOCK_ID'] => $arParams['ADD_PICT_PROP'],
					'ADDITIONAL_PICT_PROP_'.$recommendedData['OFFER_IBLOCK_ID'] => $arParams['OFFER_ADD_PICT_PROP'],

					'SHOW_FROM_SECTION' => 'N',
					'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
					'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
					'CURRENCY_ID' => $arParams['CURRENCY_ID'],
					'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
					'HIDE_NOT_AVAILABLE_OFFERS' => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],

					'LABEL_PROP_'.$arParams['IBLOCK_ID'] => $arParams['LABEL_PROP'],
					'LABEL_PROP_MOBILE_'.$arParams['IBLOCK_ID'] => $arParams['LABEL_PROP_MOBILE'],
					'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
					'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
					'PRODUCT_ROW_VARIANTS' => "[{'VARIANT':'3','BIG_DATA':false}]",
					'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
					'ENLARGE_PROP_'.$arParams['IBLOCK_ID'] => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
					'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
					'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
					'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

					'OFFER_TREE_PROPS_'.$recommendedData['OFFER_IBLOCK_ID'] => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
					'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
					'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
					'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
					'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
					'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
					'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
					'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
					'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
					'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
					'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
					'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
					'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
					'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
					'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
					'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

					'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
					'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
					'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

					'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
					'ADD_TO_BASKET_ACTION' => $basketAction,
					'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
					'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
					'COMPARE_NAME' => $arParams['COMPARE_NAME'],
					'USE_COMPARE_LIST' => 'Y'
				),
				$component
			);?>
		</div>
	</div>
</section>
<?
$GLOBALS['CATALOG_CURRENT_SECTION_ID'] = $intSectionID;
// dump($arRecomData);
if (ModuleManager::isModuleInstalled("sale"))
{
	if (!empty($arRecomData))
	{
		if (!isset($arParams['USE_BIG_DATA']) || $arParams['USE_BIG_DATA'] != 'N')
		{
			?>
			<section class="product section-margin">
        <div class="_container product_container">
          <div class="product__body">
						<h2 class="main-title"><?=GetMessage('CATALOG_PERSONAL_RECOM')?></h2>
						<?$APPLICATION->IncludeComponent(
							"bitrix:catalog.section",
							"",
							array(
								"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
								"IBLOCK_ID" => $arParams["IBLOCK_ID"],
								"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
								"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
								"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
								"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
								"PROPERTY_CODE" => (isset($arParams["LIST_PROPERTY_CODE"]) ? $arParams["LIST_PROPERTY_CODE"] : []),
								"PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
								"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
								"BASKET_URL" => $arParams["BASKET_URL"],
								"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
								"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
								"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
								"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
								"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
								"CACHE_TYPE" => $arParams["CACHE_TYPE"],
								"CACHE_TIME" => $arParams["CACHE_TIME"],
								"CACHE_FILTER" => $arParams["CACHE_FILTER"],
								"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
								"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
								"PAGE_ELEMENT_COUNT" => 0,
								"PRICE_CODE" => $arParams["~PRICE_CODE"],
								"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
								"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

								"SET_BROWSER_TITLE" => "N",
								"SET_META_KEYWORDS" => "N",
								"SET_META_DESCRIPTION" => "N",
								"SET_LAST_MODIFIED" => "N",
								"ADD_SECTIONS_CHAIN" => "N",

								"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
								"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
								"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
								"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
								"PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"]) ? $arParams["PRODUCT_PROPERTIES"] : []),

								"OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"]) ? $arParams["OFFERS_CART_PROPERTIES"] : []),
								"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
								"OFFERS_PROPERTY_CODE" => (isset($arParams["LIST_OFFERS_PROPERTY_CODE"]) ? $arParams["LIST_OFFERS_PROPERTY_CODE"] : []),
								"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
								"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
								"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
								"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
								"OFFERS_LIMIT" => (isset($arParams["LIST_OFFERS_LIMIT"]) ? $arParams["LIST_OFFERS_LIMIT"] : 0),

								"SECTION_ID" => $intSectionID,
								"SECTION_CODE" => "",
								"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
								"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
								"USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
								'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
								'CURRENCY_ID' => $arParams['CURRENCY_ID'],
								'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
								'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

								'LABEL_PROP' => $arParams['LABEL_PROP'],
								'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
								'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
								'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
								'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
								'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
								'PRODUCT_ROW_VARIANTS' => "[{'VARIANT':'3','BIG_DATA':true}]",
								'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
								'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
								'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
								'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
								'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

								"DISPLAY_TOP_PAGER" => 'N',
								"DISPLAY_BOTTOM_PAGER" => 'N',
								"HIDE_SECTION_DESCRIPTION" => "Y",

								"RCM_TYPE" => isset($arParams['BIG_DATA_RCM_TYPE']) ? $arParams['BIG_DATA_RCM_TYPE'] : '',
								"SHOW_FROM_SECTION" => 'Y',

								'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
								'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
								'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
								'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
								'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
								'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
								'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
								'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
								'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
								'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
								'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
								'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
								'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
								'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
								'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
								'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
								'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

								'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
								'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
								'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

								'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
								'ADD_TO_BASKET_ACTION' => $basketAction,
								'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
								'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
								'COMPARE_NAME' => $arParams['COMPARE_NAME'],
								'USE_COMPARE_LIST' => 'Y',
								'BACKGROUND_IMAGE' => '',
								'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
							),
							$component
						);?>
						<div class="swiper-wrapper__buttons">
							<div class="product-cards__prev swiper-button-prev">
								<div class="svg"></div>
							</div>
							<div class="product-cards__next swiper-button-next">
								<div class="svg"></div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?
		}
	}
}
?>

<?/*?>
<section class="company ">
	<div class="_container">
		<h2 class="main-title">Сео текст</h2>
		<div class="company__body">
			<div class="company__block company__block-1">
				<p class="company__text">
					Бизнес-центр Барклай Плаза класса Б+, построен в 2008 году,
					несмотря на возраст, является одним из самых востребованных
					Бизнес центров в Западном административном округе города
					Москвы.
				</p>
				<p class="company__text">
					Близость к Кутузовскому проспекту, ул. Минская и Москва-Сити,
					как и пешая доступность сразу трех станций метро добавляют ему
					актуальности. Так, станция метро Парк Победы всего в 800
					метрах.
				</p>
				<p class="company__text">
					Барклай Плаза выделяют стильный панорамный фасад, необычная
					входная группа и дизайнерская отделка мест общего пользования
					и лифтовых холлов. Высота потолков в офисах более 3 метров
				</p>
			</div>
			<div class="company__block company__block-2">
				<p class="company__text">
					Бизнес-центр Барклай Плаза класса Б+, построен в 2008 году,
					несмотря на возраст, является одним из самых востребованных
					Бизнес центров в Западном административном округе города.
				</p>
				<p class="company__text">
					Близость к Кутузовскому проспекту, ул. Минская и Москва-Сити,
					как и пешая доступность сразу трех станций метро добавляют ему
					актуальности. Так, станция метро Парк .
				</p>
				<p class="company__text">
					Барклай Плаза выделяют стильный панорамный фасад, необычная
					входная группа и дизайнерская отделка мест общего пользования
					и лифтовых холлов.
				</p>
			</div>
			<div class="company__block company__block-3">
				<p class="company__text">
					Бизнес-центр Барклай Плаза класса Б+, построен в 2008 году,
					несмотря на возраст, является одним из самых востребованных
					Бизнес центров в Западном административном округе города
					Москвы.
				</p>
				<p class="company__text">
					Близость к Кутузовскому проспекту, ул. Минская и Москва-Сити,
					как и пешая доступность сразу трех станций метро добавляют ему
					актуальности. Так, станция метро Парк Победы всего в 800
					метрах.
				</p>
				<p class="company__text">
					Барклай Плаза выделяют стильный панорамный фасад, необычная
					входная группа и дизайнерская отделка мест общего пользования
					и лифтовых холлов. Высота потолков в офисах более 3 метров
				</p>
			</div>
			<div class="company__block company__block-4">
				<p class="company__text">
					Деятельность нашей компании основана на обеспечении
					профессиональным кухонным оборудованием заведений
					общественного питания любого формата: гостиниц, отелей и
					хостелов, гипермаркетов, столовых, детских садов и школ. От
					качества оборудования зависит скорость приготовления блюд
					любой сложности и качество работы ваших поваров. Мы предлагаем
					вам качественное оборудование для вашего бизнеса: тепловое,
					холодильное, прачечное, кофейное, барное, для фаст-фуда,
					нейтральное. Деятельность нашей компании основана на
					обеспечении профессиональным кухонным оборудованием заведений
					общественного питания любого формата: гостиниц, отелей и
					хостелов, гипермаркетов, столовых, детских садов и школ
				</p>
			</div>
			<div class="company__block company__block-5">
				<div class="company__svg-block">
					<div class="svg company__svg"></div>
				</div>
				<p class="company__text">
					Деятельность нашей компании основана на обеспечении
					профессиональным кухонным оборудованием заведений
					общественного питания любого формата: гостиниц, отелей и
					хостелов, гипермаркетов, столовых, детских садов и школ. От
					качества оборудования зависит скорость приготовления блюд
					любой сложности и качество работы ваших поваров. Мы предлагаем
					вам качественное оборудование для вашего бизнеса: тепловое,
					холодильное, прачечное, кофейное, барное, для фаст-фуда,
					нейтральное.
				</p>
			</div>
			<div class="company__block company__block-6">
				<p class="company__text">
					Деятельность нашей компании основана на обеспечении
					профессиональным кухонным оборудованием заведений
					общественного питания любого формата: гостиниц, отелей и
					хостелов, гипермаркетов, столовых, детских садов и школ. От
					качества оборудования зависит скорость приготовления блюд
					любой сложности и качество работы ваших поваров. Мы предлагаем
					вам качественное оборудование для вашего бизнеса: тепловое,
					холодильное, прачечное, кофейное, барное, для фаст-фуда,
					нейтральное. Деятельность нашей компании основана на
					обеспечении профессиональным кухонным оборудованием заведений
					общественного питания любого формата: гостиниц, отелей и
					хостелов, гипермаркетов, столовых, детских садов и школ
				</p>
			</div>
			<!-- <div class="company__block company__block-7">
				<a href="#" class="reviews__href">
					<div class="svg reviews__href__svg"></div>
					<p class="reviews__href__text">Показать весь текст</p>
				</a>
			</div> -->
		</div>
	</div>
</section>
<?*/?>

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
