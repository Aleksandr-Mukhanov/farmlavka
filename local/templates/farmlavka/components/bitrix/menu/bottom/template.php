<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul class="footer__items">
	<?
	foreach ($arResult as $arItem):
		if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) continue;
		$selected = ($arItem["SELECTED"]) ? 'selected' : '';
	?>
		<li class="footer__items__li <?=$selected?>">
			<a href="<?=$arItem["LINK"]?>" class="footer__item">
				<span class="footer__item__text"><?=$arItem["TEXT"]?></span>
			</a>
		</li>
	<?endforeach?>
</ul>
<?endif?>
