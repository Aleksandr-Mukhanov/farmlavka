<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$frame=$this->createFrame()->begin();
global $APPLICATION;
	global $USER;
	if(!is_object($USER)) $USER=new CUser;
?>
	<p class="a-content_top__grade">Оценок <?=$arResult['SUM_CNT_REVIEWS']?></p>
	<div class="stars second-block__item__stars product-card__start">
	<?
	$midReviewCount = round($arResult['MID_REVIEW']);

	for ($i=0; $i < $midReviewCount; $i++) { ?>
		<div class="svg star-small star"></div>
	<?}?>
	

		<div class="svg star-small star-minus"></div>
	</div>
<style>
#reviews-statistics h3{color:<?=$arParams['PRIMARY_COLOR']?>}
#reviews-statistics .reviews-scale-full{background:<?=$arParams['PRIMARY_COLOR']?>;}
</style>
<?$frame->end();?>