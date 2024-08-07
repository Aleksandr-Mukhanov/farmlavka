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
<form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>" method="get">
	<? foreach ($arResult["ITEMS"] as $arItem) :
		if (array_key_exists("HIDDEN", $arItem)) :
			echo $arItem["INPUT"];
		endif;
	endforeach; ?>
	<div class="tags instruction-left__tags">

		<? foreach ($arResult["ITEMS"] as $arItem) : ?>

			<?
			// echo "<pre>";
			// print_r($arItem);
			// echo "<pre>";
			?>
			<? if (!array_key_exists("HIDDEN", $arItem)) : ?>
				<a href="#" class="tag">
					<p class="tag__text"><?= $arItem["INPUT"] ?></p>
				</a>
				<td valign="top"><?= $arItem["INPUT"] ?></td>
			<? endif ?>
		<? endforeach; ?>
		
		<tr>
			<input type="submit" name="set_filter" value="Фильтр" />
			<input type="hidden" name="set_filter" value="Y" />&nbsp;&nbsp;<input type="submit" name="del_filter" value="Сбросить" />
		</tr>
	</div>
</form>
<div class="tags instruction-left__tags">
	<a href="#" class="tag">
		<p class="tag__text">Производитель</p>
	</a>
</div>