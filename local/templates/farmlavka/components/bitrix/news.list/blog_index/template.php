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
?>
<section class="health">
	<div class="_container">
		<div class="health__body">
			<div class="health__body__title">
				<h2 class="main-title">Блог о здоровье</h2>
				<a href="/blog/" class="reviews__href">
					<div class="svg reviews__href__svg"></div>
					<p class="reviews__href__text">Последние записи</p>
				</a>
			</div>
			<div class="health__items">
				<?foreach($arResult["ITEMS"] as $arItem):?>
					<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="health__item">
						<div class="health__item__img-block">
							<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" />
						</div>
						<div class="health__item__info">
							<p class="health__item__title">
								<?=$arItem['NAME']?>
							</p>
							<p class="health__item__text">
								<?=$arItem['PREVIEW_TEXT']?>
							</p>
						</div>
					</a>
				<?endforeach;?>
			</div>
		</div>
	</div>
</section>
