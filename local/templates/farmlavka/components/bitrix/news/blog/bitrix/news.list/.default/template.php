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
<div class="useful-info__section">
	<div class="health__items useful-info__items">
		<? if ($arParams["DISPLAY_TOP_PAGER"]) : ?>
			<?= $arResult["NAV_STRING"] ?><br />
		<? endif; ?>
		<?
		$counter = 0;
		foreach ($arResult["ITEMS"] as $key => $arItem) : ?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<? if ($counter == 0) { ?>
				<a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="health__item health__item_1" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
					<div class="health__item__img-block health__item__img">
						<img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>">
					</div>
					<div class="health__item__info">
						<p class="health__item__title health__item-1__title">
							<?= $arItem["NAME"] ?>
						</p>
						<div class="health__item__text health__item-1__text">
							<? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]) { ?>
								<? echo $arItem["PREVIEW_TEXT"]; ?>
							<? } else { ?>
								<p>
									<?= TruncateText($arItem["DETAIL_TEXT"], 300); ?>
								</p>
							<? } ?>
						</div>
					</div>
				</a>
			<? } else { ?>
				<a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="health__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
					<div class="health__item__img-block">
						<img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>">
					</div>
					<div class="health__item__info">
						<p class="health__item__title">
							<?= $arItem["NAME"] ?>
						</p>
						<p class="health__item__text">
							<? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]) { ?>
								<?= TruncateText($arItem["PREVIEW_TEXT"], 100); ?>
							<? } else { ?>
						<p>
							<?= TruncateText($arItem["DETAIL_TEXT"], 100); ?>
						</p>
					<? } ?>
					</p>
					</div>
				</a>
			<? } ?>

		<?
			$counter++;
		endforeach; ?>
	</div>
	<div class="product-filter__bottom">
	<? if ($arParams["DISPLAY_BOTTOM_PAGER"]) : ?>
		<?= $arResult["NAV_STRING"] ?>
	<? endif; ?>
	</div>
</div>
