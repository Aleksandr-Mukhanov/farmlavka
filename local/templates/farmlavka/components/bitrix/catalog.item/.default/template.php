<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogProductsViewedComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);

// dump($arParams);

if (isset($arResult['ITEM']))
{
	$item = $arResult['ITEM']; // dump($item);
	$classSlide = ($arParams['SWIPER_SLIDE']) ? 'swiper-slide' : '';
	?>
	<div class="product-card <?=$classSlide?>">
	  <div class="product-card__block__img">
	    <div class="product-card__img">
				<?if($item['PROPERTIES']['DAY_PRODUCT']['VALUE']):?>
					<div class="label__day_product">Товар дня</div>
				<?endif;?>
				<a href="<?=$item['DETAIL_PAGE_URL']?>">
	      	<img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="<?=$item['DETAIL_PICTURE']['ALT']?>" title="<?=$item['DETAIL_PICTURE']['TITLE']?>"/>
				</a>
	    </div>
	    <div class="product-card__favourite <?=$arParams['FAVORITES_ACTIVE']?> addFavorites" data-id="<?=$item['ID']?>" data-cookie="favorites"></div>
	  </div>
	  <div class="product-card__body">
	    <div class="product-card__top">
	      <p class="product-card__available fz-12px">
	        <?=($item['ITEM_PRICES_CAN_BUY'])?'Есть в наличии':'Нет в наличии'?>
	      </p>
	      <div class="stars second-block__item__stars product-card__start">
					<?for ($i=0; $i < 5; $i++) {
						$showStar = ($item['PROPERTIES']['RATING']['VALUE'] && $i < round($item['PROPERTIES']['RATING']['VALUE'])) ? 'star' : 'star-minus'; ?>
						<div class="svg star-small <?=$showStar?>"></div>
					<?}?>
	      </div>
	    </div>
      <a href="<?=$item['DETAIL_PAGE_URL']?>" class="product-card__title fz-16px">
				<?=mb_strimwidth($item['NAME'], 0, 70, '...');?>
			</a>
	    <ul class="product-card__ul">
				<?foreach ($item['DISPLAY_PROPERTIES'] as $prop) {?>
					<li class="product-card__li">
		        <p class="product-card__text fz-12px">
		          <?=$prop['NAME']?>:
		          <span class="product-card__span"><?=$prop['DISPLAY_VALUE']?></span>
		        </p>
		      </li>
				<?}?>
	    </ul>
	    <div class="product-card__price-block">
	      <div class="product-card__price">
	        <p class="product-card__price__1 fz-24px">
	          <?=$item['ITEM_PRICES'][0]['PRINT_PRICE']?>
	        </p>
					<?if($item['ITEM_PRICES'][0]['DISCOUNT'] > 0):?>
		        <p class="product-card__price__2 fz-14px">
		          <?=$item['ITEM_PRICES'][0]['PRINT_BASE_PRICE']?>
		        </p>
					<?endif;?>
	      </div>
				<?if($item['ITEM_PRICES_CAN_BUY']):?>
	      	<div class="svg product-card__busket cartAdd" data-id="<?=$item['ID']?>"></div>
				<?endif;?>
	    </div>
	  </div>
	  <div class="product-card__bottom">
			<?if($item['ITEM_PRICES_CAN_BUY']):?>
		    <button class="product-card__b-button myBtn buyOneClick" data-modal="myModal4" data-id="<?=$item['ID']?>" data-price="<?=$item['ITEM_PRICES'][0]['PRICE']?>">
		      Купить в 1 клик
		    </button>
			<?else:?>
				<button class="product-card__b-button b-button__not-available myBtn" data-modal="myModal8">
					Сообщить о наличии
				</button>
			<?endif;?>
	  </div>
	</div>
	<?
	unset($item);
}
