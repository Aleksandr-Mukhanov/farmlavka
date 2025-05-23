<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
$this->setFrameMode(true);
?>

<? if ($arParams["USE_RSS"] == "Y") : ?>
	<?
	if (method_exists($APPLICATION, 'addheadstring'))
		$APPLICATION->AddHeadString('<link rel="alternate" type="application/rss+xml" title="' . $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["rss"] . '" href="' . $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["rss"] . '" />');
	?>
	<a href="<?= $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["rss"] ?>" title="rss" target="_self"><img alt="RSS" src="<?= $templateFolder ?>/images/gif-light/feed-icon-16x16.gif" border="0" align="right" /></a>
<? endif ?>

<? if ($arParams["USE_SEARCH"] == "Y") : ?>
	<?= GetMessage("SEARCH_LABEL") ?><? $APPLICATION->IncludeComponent(
										"bitrix:search.form",
										"flat",
										array(
											"PAGE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["search"]
										),
										$component
									); ?>
	<br />
<? endif ?>

<? if ($arParams["USE_FILTER"] == "Y") : ?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:catalog.filter",
			"",
			array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"FILTER_NAME" => $arParams["FILTER_NAME"],
				"FIELD_CODE" => $arParams["FILTER_FIELD_CODE"],
				"PROPERTY_CODE" => $arParams["FILTER_PROPERTY_CODE"],
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
			),
			$component
		); ?>

		<br />
	<? endif ?>
	<?
// if ($USER->IsAdmin()) {

$arFilter = array("IBLOCK_ID"=>2,"ACTIVE"=>"Y");
$arSelect = array('ID', 'NAME','SECTION_PAGE_URL');
$rsSect = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, $arSelect);
while ($arSect = $rsSect->GetNext()) {
	$arSections[] = $arSect;
}
	// echo "<pre>";
	// print_r($arSections);
	// echo "</pre>";


$arTags = [];
$arSelect = Array("ID","PROPERTY_TAGS");
$arFilter = Array("IBLOCK_ID"=>2,"ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($ar_fields = $res->GetNext())
{
	$arTags += $ar_fields['PROPERTY_TAGS_VALUE'];
}?>

<div class="health-blog">
	<div class="_container">
		<div class="health-blog-items">
			<div class="slider">
				<div class="slider-list grab header-bottom__desktop">
					<div class="slider-track health-blog__categories">

					<?foreach ($arSections as $section) {?>
						<div class="slide header__bottom-item health-blog__item" data-section="<?=$section['ID']?>">
							<a href="<?=$section['SECTION_PAGE_URL']?>" class="health-blog__categorie__body" >
							<p class="health-blog__categorie__text" ><?=$section['NAME']?>
								<div class="health-blog__categorie__svg health-blog__categorie__svg-1" ></div>
							</p>
							<p class="health-blog__categorie__number" ><?=$section['ELEMENT_CNT']?></p>
							</a>
						</div>
					<?}?>

					</div>
				</div>
				<div class="slider-arrows header__bottom__slider-arrows blog-arrows">
					<button type="button" class="svg prev prev-blog"></button>
					<button type="button" class="svg next next-blog"></button>
				</div>
			</div>
		</div>
		<div class="search">
			<?$APPLICATION->IncludeComponent(
	"bitrix:search.title",
	"blog",
	array(
		"COMPONENT_TEMPLATE" => "blog",
		"NUM_CATEGORIES" => "1",
		"TOP_COUNT" => "5",
		"ORDER" => "date",
		"USE_LANGUAGE_GUESS" => "Y",
		"CHECK_DATES" => "N",
		"SHOW_OTHERS" => "N",
		"PAGE" => "#SITE_DIR#blog/",
		"SHOW_INPUT" => "Y",
		"INPUT_ID" => "title-search-input",
		"CONTAINER_ID" => "title-search",
		"CATEGORY_0_TITLE" => "",
		"CATEGORY_0" => array(
			0 => "iblock_catalog",
		),
		"CATEGORY_0_iblock_catalog" => array(
			0 => "2",
		)
	),
	false
);?>
		</div>
		<div class="tags__section">
			<?/*?>
			<h2 class="tags__title">ТЕГИ</h2>
			<div class="tags instruction-left__tags">
				<?foreach ($arTags as $key => $tag) {?>
					<a href="#" class="tag" data-tag="<?=$tag?>">
						<p class="tag__text"><?=$tag?></p>
					</a>
				<?}?>
			</div>
			<?*/?>
	<? //} ?>
	<!--  -->
	<div class="js-data" data-section="" data-tag="">
	<?
	if (!empty($_GET['tag'])) {
		$GLOBALS['arrFilter'] = array('PROPERTY_TAGS_VALUE' => $_GET['tag']);
	}

	$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"",
		array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"NEWS_COUNT" => $arParams["NEWS_COUNT"],
			"SORT_BY1" => $arParams["SORT_BY1"],
			"SORT_ORDER1" => $arParams["SORT_ORDER1"],
			"SORT_BY2" => $arParams["SORT_BY2"],
			"SORT_ORDER2" => $arParams["SORT_ORDER2"],
			"FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
			"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
			"DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
			"SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
			"IBLOCK_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
			"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
			"SET_TITLE" => $arParams["SET_TITLE"],
			"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
			"MESSAGE_404" => $arParams["MESSAGE_404"],
			"SET_STATUS_404" => $arParams["SET_STATUS_404"],
			"SHOW_404" => $arParams["SHOW_404"],
			"FILE_404" => $arParams["FILE_404"],
			"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_FILTER" => $arParams["CACHE_FILTER"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
			"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
			"PAGER_TITLE" => $arParams["PAGER_TITLE"],
			"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
			"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
			"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
			"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
			"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
			"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
			"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
			"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
			"PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
			"PARENT_SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
			"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
			"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
			"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
			"ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
			"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
			"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
			"FILTER_NAME" => (!empty($_GET['tag'])) ? 'arrFilter': $arParams["FILTER_NAME"],
			"HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
			"CHECK_DATES" => $arParams["CHECK_DATES"],
		),
		$component
	); ?></div>
	<!--  -->
		</div>
	</div>
</div>
