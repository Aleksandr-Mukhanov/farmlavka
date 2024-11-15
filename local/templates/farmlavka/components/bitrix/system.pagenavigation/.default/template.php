<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);


// ссылка на первую страницу
$firstPageUrl = $arResult['sUrlPath'];
if (!empty($arResult['NavQueryString'])) {
	$firstPageUrl = $firstPageUrl . '?' . $arResult['NavQueryString'];
}
// ссылка на последнюю страницу
$lastPageUrl = $arResult['sUrlPath'];

if (!empty($arResult['NavQueryString'])) {
	$lastPageUrl = $lastPageUrl . '?' . $arResult['NavQueryString'] . '&PAGEN_' . $arResult['NavNum'] . '=' . $arResult['NavPageCount'];
} else {
	$lastPageUrl = $lastPageUrl . '?PAGEN_' . $arResult['NavNum'] . '=' . $arResult['NavPageCount'];
}
?>
<div class="sort__right">
	<?php for ($i = $arResult['nStartPage']; $i <= $arResult['nEndPage']; $i++) : ?>
		<?php

		// ссылка на очередную страницу
		$pageUrl = $arResult['sUrlPath'];
		if (!empty($arResult['NavQueryString'])) {
			$pageUrl = $pageUrl . '?' . $arResult['NavQueryString'] . '&PAGEN_' . $arResult['NavNum'] . '=' . $i;
		} else {
			$pageUrl = $pageUrl . '?PAGEN_' . $arResult['NavNum'] . '=' . $i;
		}

		if ($i == 4) {?>
			<?break;
		}?>

		<?php if ($arResult['NavPageNomer'] == $i) : /* если это текущая страница */ ?>
			<span class="sort__page"><?= $i; ?></span>
		<?php else : ?>
			<a href="<?= $pageUrl; ?>" class="sort__page"><?= $i; ?></a>
		<?php endif; ?>

	<?php endfor; ?>
	<?php if ($arResult['NavPageNomer'] < $arResult['NavPageCount'] && $arResult['NavPageCount'] > 4) : /* ссылка на последнюю страницу */ ?>
		<span class="sort__page">...</span>
		<a href="<?= $lastPageUrl; ?>" class="sort__page" title="Последняя"><?=$arResult['NavPageCount']?></a>
	<?php endif; ?>
	</div>
