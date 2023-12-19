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
  else $arResult['MENU'][] = $arSection;
}
// dump($arResult);
?>
<div class="categories__categories-block none-960 MBShow">
	<div class="section__block-title">
		<h2 class="section__title">Категории</h2>
	</div>
	<ul class="categories-block__items BShow">
		<?foreach ($arResult['SECTIONS'] as $section) {?>
			<li class="categories-block__item" >
				<a href="<?=$section['SECTION_PAGE_URL']?>" class="categories-block__item-body" >
					<p>
						<?=$section['NAME']?>
					</p>
					<div class="svg categories-block__item-svg"></div>
					<?if($arResult['SUBMENU'][$section['ID']]):?>
						<div class="position-items__position-block">
							<ul class="position-items">
								<?foreach ($arResult['SUBMENU'][$section['ID']] as $subSection) {?>
									<li class="position-item__block" >
										<p class="categories-block__item-body position-item__link" >
											<?=$subSection['NAME']?>
										</p>
									</li>
								<?}?>
							</ul>
						</div>
					<?endif;?>
				</a>
			</li>
		<?}?>
	</ul>
	<div class="categories-block__button" >
		<a class="categories-block__items__button SBtn" >
			<p>
				показать Все категории
			</p>
			<div class="svg categories-block__item-svg categories-block__item-svg-2"></div>
		</a>
	</div>
</div>
