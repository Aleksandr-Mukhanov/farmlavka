<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

$this->setFrameMode(true);
// $this->addExternalCss('/bitrix/css/main/bootstrap.css');

if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] == 'Y')
{
	$basketAction = (isset($arParams['COMMON_ADD_TO_BASKET_ACTION']) ? array($arParams['COMMON_ADD_TO_BASKET_ACTION']) : array());
}
else
{
	$basketAction = (isset($arParams['DETAIL_ADD_TO_BASKET_ACTION']) ? $arParams['DETAIL_ADD_TO_BASKET_ACTION'] : array());
}

$isSidebar = ($arParams['SIDEBAR_DETAIL_SHOW'] == 'Y' && !empty($arParams['SIDEBAR_PATH']));
?>
<div class='row'>
	<div class='<?=($isSidebar ? 'col-md-9 col-sm-8' : 'col-xs-12')?>'>
		<?
		if ($arParams["USE_COMPARE"] === "Y")
		{
			$APPLICATION->IncludeComponent(
				"bitrix:catalog.compare.list",
				"",
				array(
					"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"NAME" => $arParams["COMPARE_NAME"],
					"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
					"COMPARE_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
					"ACTION_VARIABLE" => (!empty($arParams["ACTION_VARIABLE"]) ? $arParams["ACTION_VARIABLE"] : "action"),
					"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
					'POSITION_FIXED' => isset($arParams['COMPARE_POSITION_FIXED']) ? $arParams['COMPARE_POSITION_FIXED'] : '',
					'POSITION' => isset($arParams['COMPARE_POSITION']) ? $arParams['COMPARE_POSITION'] : ''
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
		}

		$componentElementParams = array(
			'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
			'IBLOCK_ID' => $arParams['IBLOCK_ID'],
			'PROPERTY_CODE' => (isset($arParams['DETAIL_PROPERTY_CODE']) ? $arParams['DETAIL_PROPERTY_CODE'] : []),
			'META_KEYWORDS' => $arParams['DETAIL_META_KEYWORDS'],
			'META_DESCRIPTION' => $arParams['DETAIL_META_DESCRIPTION'],
			'BROWSER_TITLE' => $arParams['DETAIL_BROWSER_TITLE'],
			'SET_CANONICAL_URL' => $arParams['DETAIL_SET_CANONICAL_URL'],
			'BASKET_URL' => $arParams['BASKET_URL'],
			'SHOW_SKU_DESCRIPTION' => $arParams['SHOW_SKU_DESCRIPTION'],
			'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
			'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
			'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],
			'CHECK_SECTION_ID_VARIABLE' => (isset($arParams['DETAIL_CHECK_SECTION_ID_VARIABLE']) ? $arParams['DETAIL_CHECK_SECTION_ID_VARIABLE'] : ''),
			'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
			'CACHE_TYPE' => $arParams['CACHE_TYPE'],
			'CACHE_TIME' => $arParams['CACHE_TIME'],
			'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
			'SET_TITLE' => $arParams['SET_TITLE'],
			'SET_LAST_MODIFIED' => $arParams['SET_LAST_MODIFIED'],
			'MESSAGE_404' => $arParams['~MESSAGE_404'],
			'SET_STATUS_404' => $arParams['SET_STATUS_404'],
			'SHOW_404' => $arParams['SHOW_404'],
			'FILE_404' => $arParams['FILE_404'],
			'PRICE_CODE' => $arParams['~PRICE_CODE'],
			'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
			'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
			'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
			'PRICE_VAT_SHOW_VALUE' => $arParams['PRICE_VAT_SHOW_VALUE'],
			'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'PRODUCT_PROPERTIES' => (isset($arParams['PRODUCT_PROPERTIES']) ? $arParams['PRODUCT_PROPERTIES'] : []),
			'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
			'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
			'LINK_IBLOCK_TYPE' => $arParams['LINK_IBLOCK_TYPE'],
			'LINK_IBLOCK_ID' => $arParams['LINK_IBLOCK_ID'],
			'LINK_PROPERTY_SID' => $arParams['LINK_PROPERTY_SID'],
			'LINK_ELEMENTS_URL' => $arParams['LINK_ELEMENTS_URL'],

			'OFFERS_CART_PROPERTIES' => (isset($arParams['OFFERS_CART_PROPERTIES']) ? $arParams['OFFERS_CART_PROPERTIES'] : []),
			'OFFERS_FIELD_CODE' => $arParams['DETAIL_OFFERS_FIELD_CODE'],
			'OFFERS_PROPERTY_CODE' => (isset($arParams['DETAIL_OFFERS_PROPERTY_CODE']) ? $arParams['DETAIL_OFFERS_PROPERTY_CODE'] : []),
			'OFFERS_SORT_FIELD' => $arParams['OFFERS_SORT_FIELD'],
			'OFFERS_SORT_ORDER' => $arParams['OFFERS_SORT_ORDER'],
			'OFFERS_SORT_FIELD2' => $arParams['OFFERS_SORT_FIELD2'],
			'OFFERS_SORT_ORDER2' => $arParams['OFFERS_SORT_ORDER2'],

			'ELEMENT_ID' => $arResult['VARIABLES']['ELEMENT_ID'],
			'ELEMENT_CODE' => $arResult['VARIABLES']['ELEMENT_CODE'],
			'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
			'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],
			'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
			'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
			'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
			'CURRENCY_ID' => $arParams['CURRENCY_ID'],
			'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
			'HIDE_NOT_AVAILABLE_OFFERS' => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],
			'USE_ELEMENT_COUNTER' => $arParams['USE_ELEMENT_COUNTER'],
			'SHOW_DEACTIVATED' => $arParams['SHOW_DEACTIVATED'],
			'USE_MAIN_ELEMENT_SECTION' => $arParams['USE_MAIN_ELEMENT_SECTION'],
			'STRICT_SECTION_CHECK' => (isset($arParams['DETAIL_STRICT_SECTION_CHECK']) ? $arParams['DETAIL_STRICT_SECTION_CHECK'] : ''),
			'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
			'LABEL_PROP' => $arParams['LABEL_PROP'],
			'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
			'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
			'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
			'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
			'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
			'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
			'DISCOUNT_PERCENT_POSITION' => (isset($arParams['DISCOUNT_PERCENT_POSITION']) ? $arParams['DISCOUNT_PERCENT_POSITION'] : ''),
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
			'MESS_PRICE_RANGES_TITLE' => (isset($arParams['~MESS_PRICE_RANGES_TITLE']) ? $arParams['~MESS_PRICE_RANGES_TITLE'] : ''),
			'MESS_DESCRIPTION_TAB' => (isset($arParams['~MESS_DESCRIPTION_TAB']) ? $arParams['~MESS_DESCRIPTION_TAB'] : ''),
			'MESS_PROPERTIES_TAB' => (isset($arParams['~MESS_PROPERTIES_TAB']) ? $arParams['~MESS_PROPERTIES_TAB'] : ''),
			'MESS_COMMENTS_TAB' => (isset($arParams['~MESS_COMMENTS_TAB']) ? $arParams['~MESS_COMMENTS_TAB'] : ''),
			'MAIN_BLOCK_PROPERTY_CODE' => (isset($arParams['DETAIL_MAIN_BLOCK_PROPERTY_CODE']) ? $arParams['DETAIL_MAIN_BLOCK_PROPERTY_CODE'] : ''),
			'MAIN_BLOCK_OFFERS_PROPERTY_CODE' => (isset($arParams['DETAIL_MAIN_BLOCK_OFFERS_PROPERTY_CODE']) ? $arParams['DETAIL_MAIN_BLOCK_OFFERS_PROPERTY_CODE'] : ''),
			'USE_VOTE_RATING' => $arParams['DETAIL_USE_VOTE_RATING'],
			'VOTE_DISPLAY_AS_RATING' => (isset($arParams['DETAIL_VOTE_DISPLAY_AS_RATING']) ? $arParams['DETAIL_VOTE_DISPLAY_AS_RATING'] : ''),
			'USE_COMMENTS' => $arParams['DETAIL_USE_COMMENTS'],
			'BLOG_USE' => (isset($arParams['DETAIL_BLOG_USE']) ? $arParams['DETAIL_BLOG_USE'] : ''),
			'BLOG_URL' => (isset($arParams['DETAIL_BLOG_URL']) ? $arParams['DETAIL_BLOG_URL'] : ''),
			'BLOG_EMAIL_NOTIFY' => (isset($arParams['DETAIL_BLOG_EMAIL_NOTIFY']) ? $arParams['DETAIL_BLOG_EMAIL_NOTIFY'] : ''),
			'VK_USE' => (isset($arParams['DETAIL_VK_USE']) ? $arParams['DETAIL_VK_USE'] : ''),
			'VK_API_ID' => (isset($arParams['DETAIL_VK_API_ID']) ? $arParams['DETAIL_VK_API_ID'] : 'API_ID'),
			'FB_USE' => (isset($arParams['DETAIL_FB_USE']) ? $arParams['DETAIL_FB_USE'] : ''),
			'FB_APP_ID' => (isset($arParams['DETAIL_FB_APP_ID']) ? $arParams['DETAIL_FB_APP_ID'] : ''),
			'BRAND_USE' => (isset($arParams['DETAIL_BRAND_USE']) ? $arParams['DETAIL_BRAND_USE'] : 'N'),
			'BRAND_PROP_CODE' => (isset($arParams['DETAIL_BRAND_PROP_CODE']) ? $arParams['DETAIL_BRAND_PROP_CODE'] : ''),
			'DISPLAY_NAME' => (isset($arParams['DETAIL_DISPLAY_NAME']) ? $arParams['DETAIL_DISPLAY_NAME'] : ''),
			'IMAGE_RESOLUTION' => (isset($arParams['DETAIL_IMAGE_RESOLUTION']) ? $arParams['DETAIL_IMAGE_RESOLUTION'] : ''),
			'PRODUCT_INFO_BLOCK_ORDER' => (isset($arParams['DETAIL_PRODUCT_INFO_BLOCK_ORDER']) ? $arParams['DETAIL_PRODUCT_INFO_BLOCK_ORDER'] : ''),
			'PRODUCT_PAY_BLOCK_ORDER' => (isset($arParams['DETAIL_PRODUCT_PAY_BLOCK_ORDER']) ? $arParams['DETAIL_PRODUCT_PAY_BLOCK_ORDER'] : ''),
			'ADD_DETAIL_TO_SLIDER' => (isset($arParams['DETAIL_ADD_DETAIL_TO_SLIDER']) ? $arParams['DETAIL_ADD_DETAIL_TO_SLIDER'] : ''),
			'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
			'ADD_SECTIONS_CHAIN' => (isset($arParams['ADD_SECTIONS_CHAIN']) ? $arParams['ADD_SECTIONS_CHAIN'] : ''),
			'ADD_ELEMENT_CHAIN' => (isset($arParams['ADD_ELEMENT_CHAIN']) ? $arParams['ADD_ELEMENT_CHAIN'] : ''),
			'DISPLAY_PREVIEW_TEXT_MODE' => (isset($arParams['DETAIL_DISPLAY_PREVIEW_TEXT_MODE']) ? $arParams['DETAIL_DISPLAY_PREVIEW_TEXT_MODE'] : ''),
			'DETAIL_PICTURE_MODE' => (isset($arParams['DETAIL_DETAIL_PICTURE_MODE']) ? $arParams['DETAIL_DETAIL_PICTURE_MODE'] : array()),
			'ADD_TO_BASKET_ACTION' => $basketAction,
			'ADD_TO_BASKET_ACTION_PRIMARY' => (isset($arParams['DETAIL_ADD_TO_BASKET_ACTION_PRIMARY']) ? $arParams['DETAIL_ADD_TO_BASKET_ACTION_PRIMARY'] : null),
			'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
			'DISPLAY_COMPARE' => (isset($arParams['USE_COMPARE']) ? $arParams['USE_COMPARE'] : ''),
			'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
			'USE_COMPARE_LIST' => 'Y',
			'BACKGROUND_IMAGE' => (isset($arParams['DETAIL_BACKGROUND_IMAGE']) ? $arParams['DETAIL_BACKGROUND_IMAGE'] : ''),
			'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
			'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : ''),
			'SET_VIEWED_IN_COMPONENT' => (isset($arParams['DETAIL_SET_VIEWED_IN_COMPONENT']) ? $arParams['DETAIL_SET_VIEWED_IN_COMPONENT'] : ''),
			'SHOW_SLIDER' => (isset($arParams['DETAIL_SHOW_SLIDER']) ? $arParams['DETAIL_SHOW_SLIDER'] : ''),
			'SLIDER_INTERVAL' => (isset($arParams['DETAIL_SLIDER_INTERVAL']) ? $arParams['DETAIL_SLIDER_INTERVAL'] : ''),
			'SLIDER_PROGRESS' => (isset($arParams['DETAIL_SLIDER_PROGRESS']) ? $arParams['DETAIL_SLIDER_PROGRESS'] : ''),
			'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
			'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
			'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

			'USE_GIFTS_DETAIL' => $arParams['USE_GIFTS_DETAIL']?: 'Y',
			'USE_GIFTS_MAIN_PR_SECTION_LIST' => $arParams['USE_GIFTS_MAIN_PR_SECTION_LIST']?: 'Y',
			'GIFTS_SHOW_DISCOUNT_PERCENT' => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
			'GIFTS_SHOW_OLD_PRICE' => $arParams['GIFTS_SHOW_OLD_PRICE'],
			'GIFTS_DETAIL_PAGE_ELEMENT_COUNT' => $arParams['GIFTS_DETAIL_PAGE_ELEMENT_COUNT'],
			'GIFTS_DETAIL_HIDE_BLOCK_TITLE' => $arParams['GIFTS_DETAIL_HIDE_BLOCK_TITLE'],
			'GIFTS_DETAIL_TEXT_LABEL_GIFT' => $arParams['GIFTS_DETAIL_TEXT_LABEL_GIFT'],
			'GIFTS_DETAIL_BLOCK_TITLE' => $arParams['GIFTS_DETAIL_BLOCK_TITLE'],
			'GIFTS_SHOW_NAME' => $arParams['GIFTS_SHOW_NAME'],
			'GIFTS_SHOW_IMAGE' => $arParams['GIFTS_SHOW_IMAGE'],
			'GIFTS_MESS_BTN_BUY' => $arParams['~GIFTS_MESS_BTN_BUY'],
			'GIFTS_PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
			'GIFTS_SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
			'GIFTS_SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
			'GIFTS_SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

			'GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT' => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT'],
			'GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE' => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE'],
			'GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE' => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE'],
		);

		if (isset($arParams['USER_CONSENT']))
		{
			$componentElementParams['USER_CONSENT'] = $arParams['USER_CONSENT'];
		}

		if (isset($arParams['USER_CONSENT_ID']))
		{
			$componentElementParams['USER_CONSENT_ID'] = $arParams['USER_CONSENT_ID'];
		}

		if (isset($arParams['USER_CONSENT_IS_CHECKED']))
		{
			$componentElementParams['USER_CONSENT_IS_CHECKED'] = $arParams['USER_CONSENT_IS_CHECKED'];
		}

		if (isset($arParams['USER_CONSENT_IS_LOADED']))
		{
			$componentElementParams['USER_CONSENT_IS_LOADED'] = $arParams['USER_CONSENT_IS_LOADED'];
		}

		$elementId = $APPLICATION->IncludeComponent(
			'bitrix:catalog.element',
			'',
			$componentElementParams,
			$component
		);
		$GLOBALS['CATALOG_CURRENT_ELEMENT_ID'] = $elementId;

		// получим привязки
		$arOrder = ['SORT'=>'ASC'];
		$arFilter = ['IBLOCK_ID'=>1,'ID'=>$elementId];
		$arSelect = ['ID','DETAIL_TEXT','PROPERTY_ANALOGS','PROPERTY_RELEASE_FORMS'];
		$rsElements = CIBlockElement::GetList($arOrder,$arFilter,false,false,$arSelect);
		if ($arElement = $rsElements->Fetch()) {
			global $arrFilterAnalogs;
			$arrFilterAnalogs['ID'] = $arElement['PROPERTY_ANALOGS_VALUE'];
			global $arrFilterRelease;
			$arrFilterRelease['ID'] = $arElement['PROPERTY_RELEASE_FORMS_VALUE'];
			$detailText = $arElement['DETAIL_TEXT'];
		}
	?>
	<?if($arrFilterAnalogs['ID']): // Аналоги?>
	<section class="product product_pp ">
		<div class="_container product_container">
			<div class="product__body">
				<h2 class="main-title">Аналоги</h2>
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
						"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
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
						"FILTER_NAME" => "arrFilterAnalogs",
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
	<?endif;?>

	<?
	// $arDiscounts = CCatalogDiscount::GetDiscountByProduct(
  //   1,
  //   $USER->GetUserGroupArray(),
  //   "N",
  //   1,
  //   SITE_ID
  // );
	// dump($arDiscounts);
	?>

	<?if($arrFilterRelease['ID']): // Формы выпуска?>
	<section class="product product_pp ">
		<div class="_container product_container">
			<div class="product__body">
				<h2 class="main-title" id="block_variants">Формы выпуска <span class="pp-suptitle"><?=$arrFilterRelease['ID']?></span></h2>
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
						"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
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
						"FILTER_NAME" => "arrFilterRelease",
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
	<?endif;?>

	<section class="instruction">
		<div class='_container'>
			<div class="instruction__body" >
				<div class="instruction-left" >
					<div class="instruction-left__body">
						<h2 class="main-title" id="block_instruction">Инструкция по применению</h2>
						<?$APPLICATION->ShowViewContent('instruction');?>
						<div class="instruction-left__button" ></div>
					</div>
					<div class="instruction-left__button" >

						<a href="#" class="button__link product-filter__button">
							<div class="svg button__link__svg "> </div>
							Показать всю инструкцию
						</a>
					</div>
				</div>
				<div class="instruction-right" >
					<div class="instruction-right__body">
						<h2 class="main-title" id="block_reviews">Отзывы</h2>
						<?$APPLICATION->IncludeComponent(
							"sotbit:reviews.reviews.add",
							"product",
							Array(
								"ADD_REVIEW_PLACE" => "1",
								"AJAX" => "N",
								"BUTTON_BACKGROUND" => "#dbbfb9",
								"CACHE_TIME" => "36000000",
								"CACHE_TYPE" => "A",
								"DEFAULT_RATING_ACTIVE" => "3",
								"ID_ELEMENT" => $elementId,
								"MAX_RATING" => "5",
								"NOTICE_EMAIL" => "",
								"PRIMARY_COLOR" => "#a76e6e",
								"TEXTBOX_MAXLENGTH" => "200"
							)
						);?>
					</div>

					<?$APPLICATION->IncludeComponent(
						"sotbit:reviews.reviews.list",
						"product",
						Array(
							"AJAX" => "N",
							"CACHE_TIME" => "36000000",
							"CACHE_TYPE" => "A",
							"DATE_FORMAT" => "d.m.Y",
							"ID_ELEMENT" => $elementId,
							"MAX_RATING" => "5",
							"PRIMARY_COLOR" => "#a76e6e"
						)
					);?>

					<div class="instruction-bottom__button" >
						<a href="#" class="button__link product-filter__button">
							<div class="svg button__link__svg "> </div>
							Показать ещё отзывы
						</a>
					</div>

				</div>
			</div>
		</div>
	</section>

	<?
	$locationCode = $_SESSION["SOTBIT_REGIONS"]['LOCATION']['CODE'];

	$rsDelivery = \Bitrix\Sale\Delivery\Services\Table::getList([
		'filter' => ['ACTIVE'=>'Y'],
		'select' => ['ID','NAME','CONFIG']
	]);

	while($arDelivery=$rsDelivery->fetch())
		if (\Bitrix\Sale\Delivery\Restrictions\ByLocation::check($locationCode, [], $arDelivery['ID']))
			$arDeliveryAviable[] = $arDelivery;

	$arCard = getListProperty([],['USER_FIELD_ID'=>48]);

	$rsStore = \Bitrix\Catalog\StoreTable::getList([
		'filter' => ['ID'=>$_SESSION["SOTBIT_REGIONS"]['STORE']],
		'select' => ['ID','TITLE','ADDRESS','GPS_N','GPS_S','PHONE','SCHEDULE','UF_CARD','UF_AVAILABLE']
	]);

	while($arStore = $rsStore->fetch())
	{
	  $arStore['COORDINATES'] = $arStore['GPS_N'].','.$arStore['GPS_S'];

	  foreach ($arStore['UF_CARD'] as $value)
	    $arStore['UF_CARD_NAME'][] = $arCard[$value];

	  $arStores[] = $arStore;
	}
	?>

	<section class="delivery" >
		<div class="_container delivery_container" >
			<h2 class="main-title" id="block_delivery">Доставка в Москве и области</h2>
			<div class="delivery__d-table block_delivery__card">
	      <table class="d-table__table">
	        <tr class="d-table__head" >
	          <th class="d-table__th d-table__th-1" >
	            <p class="d-table__th-p" >Способ доставки</p>
	          </th>
	          <th class="d-table__th" >
	            <p class="d-table__th-p" >Время исполнения</p>
	          </th>
	          <th class="d-table__th" >
	            <p class="d-table__th-p" >Стоимость</p>
	          </th>
	        </tr>
	        <?foreach ($arDeliveryAviable as $key => $value) {?>
	          <tr class="d-table__body" >
	            <td class="d-table__td">
	              <p class="d-table__td-p d-table__td-p-1"><?=$value['NAME']?></p>
	            </td>
	            <td class="d-table__td">
	              <p class="d-table__td-p">Дней: <?=$value['CONFIG']['MAIN']['PERIOD']['FROM']?>-<?=$value['CONFIG']['MAIN']['PERIOD']['TO']?></p>
	            </td>
	            <td class="d-table__td">
	              <p class="d-table__td-p"><span class="d-table__td-span"><?=$value['CONFIG']['MAIN']['PRICE']?></span> руб.</p>
	            </td>
	          </tr>
	        <?}?>
	      </table>
	    </div>
		</div>
	</section>

	<section class="pickup">
		<div class="_container" >
			<h2 class="main-title" id="block_pickup">Самовывоз в Москве и области</h2>
			<div class="pickup__body">
				<div class="delivery__block" >
					<p>Доставка заказов в пределах МКАД</p>
					<div class="delivery__block-body" >
						<div class="delivery__item">
							<div class="pickup__item__body" >
								<p class="delivery__item__text">Список аптек</p>
								<p class="delivery__item__text">Выдача товаров</p>
								<p class="delivery__item__text">Стоимость</p>
							</div>
						</div>
						<?foreach ($arStores as $store) { // dump($store);?>
							<div class="pickup__item" >
								<div class="pickup__item__body" >
									<p class="delivery__item__text delivery__item__text-2"><?=$store['TITLE']?> <?=$store['ADDRESS']?></p>
									<p class="delivery__item__text">в течение часа</p>
									<p class="delivery__item__text">Бесплатно</p>
								</div>
							</div>
						<?}?>
						<div class="pickup__item__bottom" >
							<div class="instruction-left__button">
								<a href="/delivery/" class="product-filter__link product-filter__link__last">
									<div class="svg product-filter__link__last__svg"> </div>
									Все условия доставки
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="company ">
		<div class="_container">
			<h2 class="main-title">Сео текст</h2>
			<div class="company__body">
				<?=$detailText?>
				<!-- <div class="company__block company__block-7">
					<a href="#" class="reviews__href">
						<div class="svg reviews__href__svg"></div>
						<p class="reviews__href__text">Показать весь текст</p>
					</a>
				</div> -->
			</div>
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

	<?
		if ($elementId > 0)
		{
			if ($arParams['USE_STORE'] == 'Y' && ModuleManager::isModuleInstalled('catalog'))
			{
				$APPLICATION->IncludeComponent(
					'bitrix:catalog.store.amount',
					'.default',
					array(
						'ELEMENT_ID' => $elementId,
						'STORE_PATH' => $arParams['STORE_PATH'],
						'CACHE_TYPE' => 'A',
						'CACHE_TIME' => '36000',
						'MAIN_TITLE' => $arParams['MAIN_TITLE'],
						'USE_MIN_AMOUNT' =>  $arParams['USE_MIN_AMOUNT'],
						'MIN_AMOUNT' => $arParams['MIN_AMOUNT'],
						'STORES' => $arParams['STORES'],
						'SHOW_EMPTY_STORE' => $arParams['SHOW_EMPTY_STORE'],
						'SHOW_GENERAL_STORE_INFORMATION' => $arParams['SHOW_GENERAL_STORE_INFORMATION'],
						'USER_FIELDS' => $arParams['USER_FIELDS'],
						'FIELDS' => $arParams['FIELDS']
					),
					$component,
					array('HIDE_ICONS' => 'Y')
				);
			}

			$recommendedData = array();
			$recommendedCacheId = array('IBLOCK_ID' => $arParams['IBLOCK_ID']);

			$obCache = new CPHPCache();
			if ($obCache->InitCache(36000, serialize($recommendedCacheId), '/catalog/recommended'))
			{
				$recommendedData = $obCache->GetVars();
			}
			elseif ($obCache->StartDataCache())
			{
				if (Loader::includeModule('catalog'))
				{
					$arSku = CCatalogSku::GetInfoByProductIBlock($arParams['IBLOCK_ID']);
					$recommendedData['OFFER_IBLOCK_ID'] = (!empty($arSku) ? $arSku['IBLOCK_ID'] : 0);
					$recommendedData['IBLOCK_LINK'] = '';
					$recommendedData['ALL_LINK'] = '';
					$rsProps = CIBlockProperty::GetList(
						array('SORT' => 'ASC', 'ID' => 'ASC'),
						array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'PROPERTY_TYPE' => 'E', 'ACTIVE' => 'Y')
					);
					$found = false;
					while ($arProp = $rsProps->Fetch())
					{
						if ($found)
						{
							break;
						}

						if ($arProp['CODE'] == '')
						{
							$arProp['CODE'] = $arProp['ID'];
						}

						$arProp['LINK_IBLOCK_ID'] = intval($arProp['LINK_IBLOCK_ID']);
						if ($arProp['LINK_IBLOCK_ID'] != 0 && $arProp['LINK_IBLOCK_ID'] != $arParams['IBLOCK_ID'])
						{
							continue;
						}

						if ($arProp['LINK_IBLOCK_ID'] > 0)
						{
							if ($recommendedData['IBLOCK_LINK'] == '')
							{
								$recommendedData['IBLOCK_LINK'] = $arProp['CODE'];
								$found = true;
							}
						}
						else
						{
							if ($recommendedData['ALL_LINK'] == '')
							{
								$recommendedData['ALL_LINK'] = $arProp['CODE'];
							}
						}
					}

					if ($found)
					{
						if (defined('BX_COMP_MANAGED_CACHE'))
						{
							global $CACHE_MANAGER;
							$CACHE_MANAGER->StartTagCache('/catalog/recommended');
							$CACHE_MANAGER->RegisterTag('iblock_id_'.$arParams['IBLOCK_ID']);
							$CACHE_MANAGER->EndTagCache();
						}
					}
				}

				$obCache->EndDataCache($recommendedData);
			}

			if (!empty($recommendedData))
			{
				if (!empty($recommendedData['IBLOCK_LINK']) || !empty($recommendedData['ALL_LINK']))
				{
					?>
					<section class="product product_pp ">
						<div class="_container product_container">
							<div class="product__body">
								<h2 class="main-title"><?=GetMessage('CATALOG_RECOMMENDED_BY_LINK')?></h2>
								<?$APPLICATION->IncludeComponent(
									'bitrix:catalog.recommended.products',
									'',
									array(
										'ID' => $elementId,
										'IBLOCK_ID' => $arParams['IBLOCK_ID'],
										'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
										'PROPERTY_LINK' => (!empty($recommendedData['IBLOCK_LINK']) ? $recommendedData['IBLOCK_LINK'] : $recommendedData['ALL_LINK']),
										'CACHE_TYPE' => $arParams['CACHE_TYPE'],
										'CACHE_TIME' => $arParams['CACHE_TIME'],
										'CACHE_FILTER' => $arParams['CACHE_FILTER'],
										'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
										'BASKET_URL' => $arParams['BASKET_URL'],
										'ACTION_VARIABLE' => (!empty($arParams['ACTION_VARIABLE']) ? $arParams['ACTION_VARIABLE'] : 'action').'_crp',
										'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
										'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
										'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
										'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
										'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
										'PAGE_ELEMENT_COUNT' => $arParams['ALSO_BUY_ELEMENT_COUNT'],
										'LINE_ELEMENT_COUNT' => $arParams['ALSO_BUY_ELEMENT_COUNT'],
										'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
										'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
										'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
										'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
										'PRICE_CODE' => $arParams['~PRICE_CODE'],
										'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
										'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
										'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
										'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
										'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
										'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
										'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
										'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
										'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
										'ADD_TO_BASKET_ACTION' => $basketAction,
										'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',

										'ELEMENT_SORT_FIELD' => $arParams['ELEMENT_SORT_FIELD'],
										'ELEMENT_SORT_ORDER' => $arParams['ELEMENT_SORT_ORDER'],
										'ELEMENT_SORT_FIELD2' => $arParams['ELEMENT_SORT_FIELD2'],
										'ELEMENT_SORT_ORDER2' => $arParams['ELEMENT_SORT_ORDER2'],

										'SET_TITLE' => 'N',
										'SET_BROWSER_TITLE' => 'N',
										'SET_META_KEYWORDS' => 'N',
										'SET_META_DESCRIPTION' => 'N',
										'SET_LAST_MODIFIED' => 'N',
										'ADD_SECTIONS_CHAIN' => 'N',

										'HIDE_BLOCK_TITLE' => 'Y',
										'SHOW_NAME' => 'Y',
										'SHOW_IMAGE' => 'Y',

										'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
										'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
										'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
										'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
										'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
										'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

										'LABEL_PROP_MULTIPLE' => $arParams['LABEL_PROP'],
										'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
										'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],

										'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
										'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
										'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

										'SHOW_PRODUCTS_'.$arParams['IBLOCK_ID'] => 'Y',
										'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
										'HIDE_NOT_AVAILABLE_OFFERS' => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],
										'OFFERS_FIELD_CODE' => $arParams['LIST_OFFERS_FIELD_CODE'],
										'PROPERTY_CODE_'.$arParams['IBLOCK_ID'] => (isset($arParams['LIST_PROPERTY_CODE']) ? $arParams['LIST_PROPERTY_CODE'] : []),
										'PROPERTY_CODE_MOBILE' => $arParams['LIST_PROPERTY_CODE_MOBILE'],
										'PROPERTY_CODE_'.$recommendedData['OFFER_IBLOCK_ID'] => (isset($arParams['LIST_OFFERS_PROPERTY_CODE']) ?  $arParams['LIST_OFFERS_PROPERTY_CODE'] : []),
										'CART_PROPERTIES_'.$arParams['IBLOCK_ID'] => (isset($arParams['PRODUCT_PROPERTIES']) ? $arParams['PRODUCT_PROPERTIES'] : []),
										'CART_PROPERTIES_'.$recommendedData['OFFER_IBLOCK_ID'] => (isset($arParams['OFFERS_CART_PROPERTIES']) ? $arParams['OFFERS_CART_PROPERTIES'] : []),
										'OFFER_TREE_PROPS_'.$recommendedData['OFFER_IBLOCK_ID'] => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
										'ADDITIONAL_PICT_PROP_'.$arParams['IBLOCK_ID'] => $arParams['ADD_PICT_PROP'],
										'ADDITIONAL_PICT_PROP_'.$recommendedData['OFFER_IBLOCK_ID'] => $arParams['OFFER_ADD_PICT_PROP'],
										'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
										'CURRENCY_ID' => $arParams['CURRENCY_ID'],

										'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
										'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
										'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),
									),
									$component
								);?>
							</div>
						</div>
					</section>
					<?
				}

				if (!isset($arParams['DETAIL_SHOW_POPULAR']) || $arParams['DETAIL_SHOW_POPULAR'] != 'N')
				{
					?>
					<section class="product product_pp ">
						<div class="_container product_container">
							<div class="product__body">
								<h2 class="main-title"><?=GetMessage('CATALOG_POPULAR_IN_SECTION')?></h2>
								<?$APPLICATION->IncludeComponent(
									'bitrix:catalog.section',
									'',
									array(
										'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
										'IBLOCK_ID' => $arParams['IBLOCK_ID'],
										'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
										'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],
										'ELEMENT_SORT_FIELD' => 'shows',
										'ELEMENT_SORT_ORDER' => 'desc',
										'ELEMENT_SORT_FIELD2' => 'sort',
										'ELEMENT_SORT_ORDER2' => 'asc',
										'PROPERTY_CODE' => (isset($arParams['LIST_PROPERTY_CODE']) ? $arParams['LIST_PROPERTY_CODE'] : []),
										'PROPERTY_CODE_MOBILE' => $arParams['LIST_PROPERTY_CODE_MOBILE'],
										'INCLUDE_SUBSECTIONS' => $arParams['INCLUDE_SUBSECTIONS'],
										'BASKET_URL' => $arParams['BASKET_URL'],
										'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
										'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
										'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],
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
										'FILTER_IDS' => array($elementId),

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
										'PRODUCT_PROPERTIES' => (isset($arParams['PRODUCT_PROPERTIES']) ? $arParams['PRODUCT_PROPERTIES'] : []),

										'OFFERS_CART_PROPERTIES' => (isset($arParams['OFFERS_CART_PROPERTIES']) ? $arParams['OFFERS_CART_PROPERTIES'] : []),
										'OFFERS_FIELD_CODE' => $arParams['LIST_OFFERS_FIELD_CODE'],
										'OFFERS_PROPERTY_CODE' => (isset($arParams['LIST_OFFERS_PROPERTY_CODE']) ? $arParams['LIST_OFFERS_PROPERTY_CODE'] : []),
										'OFFERS_SORT_FIELD' => $arParams['OFFERS_SORT_FIELD'],
										'OFFERS_SORT_ORDER' => $arParams['OFFERS_SORT_ORDER'],
										'OFFERS_SORT_FIELD2' => $arParams['OFFERS_SORT_FIELD2'],
										'OFFERS_SORT_ORDER2' => $arParams['OFFERS_SORT_ORDER2'],
										'OFFERS_LIMIT' => (isset($arParams['LIST_OFFERS_LIMIT']) ? $arParams['LIST_OFFERS_LIMIT'] : 0),

										'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
										'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
										'USE_MAIN_ELEMENT_SECTION' => $arParams['USE_MAIN_ELEMENT_SECTION'],
										'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
										'CURRENCY_ID' => $arParams['CURRENCY_ID'],
										'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
										'HIDE_NOT_AVAILABLE_OFFERS' => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],

										'LABEL_PROP' => $arParams['LABEL_PROP'],
										'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
										'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
										'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
										'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
										'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
										'PRODUCT_ROW_VARIANTS' => "[{'VARIANT':'3','BIG_DATA':false}]",
										'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
										'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
										'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
										'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
										'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

										'DISPLAY_TOP_PAGER' => 'N',
										'DISPLAY_BOTTOM_PAGER' => 'N',
										'HIDE_SECTION_DESCRIPTION' => 'Y',

										'RCM_TYPE' => isset($arParams['BIG_DATA_RCM_TYPE']) ? $arParams['BIG_DATA_RCM_TYPE'] : '',
										'RCM_PROD_ID' => $elementId,
										'SHOW_FROM_SECTION' => 'Y',

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
								);
								?>
							</div>
						</div>
					</section>
					<?
				}

				if (
					Loader::includeModule('catalog')
					&& (!isset($arParams['DETAIL_SHOW_VIEWED']) || $arParams['DETAIL_SHOW_VIEWED'] != 'N')
				)
				{
					?>
					<section class="product product_pp ">
						<div class="_container product_container">
							<div class="product__body">
								<h2 class="main-title"><?=GetMessage('CATALOG_VIEWED')?></h2>
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
				}
			}
		}
		?>
	</div>
	<? if ($isSidebar): ?>
		<div class='col-md-3 col-sm-4'>
			<?
			$APPLICATION->IncludeComponent(
				'bitrix:main.include',
				'',
				array(
					'AREA_FILE_SHOW' => 'file',
					'PATH' => $arParams['SIDEBAR_PATH'],
					'AREA_FILE_RECURSIVE' => 'N',
					'EDIT_MODE' => 'html',
				),
				false,
				array('HIDE_ICONS' => 'Y')
			);
			?>
		</div>
	<? endif ?>
</div>
