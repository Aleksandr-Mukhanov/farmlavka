<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

foreach ($arResult['SECTIONS'] as $arSection) {
	if ($arSection['IBLOCK_SECTION_ID']) $arResult['SUBMENU'][$arSection['IBLOCK_SECTION_ID']][] = $arSection;
  else $arResult['MAIN'][] = $arSection;
}
$i=0;
?>
<div class="product-filter__blocks">
	<?foreach ($arResult['MAIN'] as $section) { $i++;?>
		<div class="product-filter__block product-filter__block-<?=$i?>">
			<div class="product-filter__block__body">
				<div class="product-filter__block__top">
					<div class="svg product-filter__svg product-filter__svg-<?=$i?>">
					</div>
					<p class="product-filter__block__body__title"><?=$section['NAME']?></p>
				</div>
				<ul class="product-filter__ul">
					<?foreach ($arResult['SUBMENU'][$section['ID']] as $subSection) {?>
						<li class="product-filter__li">
							<a href="<?=$subSection['SECTION_PAGE_URL']?>" class="product-filter__link"><?=$subSection['NAME']?></a>
						</li>
					<?}?>
					<li class="product-filter__li">
						<a href="<?=$section['SECTION_PAGE_URL']?>" class="product-filter__link product-filter__link__last">
							<div class="svg product-filter__link__last__svg"> </div>
							Все категории
						</a>
					</li>
				</ul>
			</div>
		</div>
	<?}?>
</div>
