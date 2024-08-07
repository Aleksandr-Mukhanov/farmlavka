<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);
// dump($arResult);
if (isset($_COOKIE['favorites']))
	$arFavorites = explode('-',$_COOKIE['favorites']);

$favoritesActive = ($arFavorites && in_array($arResult['ID'],$arFavorites)) ? 'active' : '';
?>
<section class="product-page">
	<div class="_container">
		<div class="product-page__pp-content">

			<div class="pp-content__top" >
				<a class="pp-content__item pp-content__item_1">
					Основное
					<!-- <div class="pp-content__button-svg" > -->
				</a>
				<a href="#block_instruction" class="pp-content__item">
					Инструкция
				</a>
				<a href="#block_variants" class="pp-content__item">
					Варианты
				</a>
				<a href="#block_reviews" class="pp-content__item">
					Отзывы
				</a>
				<a href="#block_delivery" class="pp-content__item">
					Доставка
				</a>
				<a href="#block_pickup" class="pp-content__item">
					Самовывоз
				</a>
			</div>
			<div class="pp-content__main" >
				<div class="pp-content__img-bl" >
					<div class="swiper-container img-bl__container">
						<div class="swiper-wrapper img-bl__items">
							<?foreach ($arResult['MORE_PHOTO'] as $photo) {?>
								<div class="swiper-slide img-bl__item">
									<img src="<?=$photo['SRC']?>">
								</div>
							<?}?>
						</div>
					</div>
					<div class="img-bl__big-img" >
						<?if($arResult['PROPERTIES']['DAY_PRODUCT']['VALUE']):?>
							<div class="label__day_product">Товар дня</div>
						<?endif;?>
						<?if($arResult['PROPERTIES']['PICKUP_ONLY']['VALUE']):?>
							<div class="label__pickup_only">Только самовывоз</div>
						<?endif;?>
						<div class="img-bl__big-img__block " id="slide-image" >
							<img class="" src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['DETAIL_PICTURE']['ALT']?>" title="<?=$arResult['DETAIL_PICTURE']['TITLE']?>">
						</div>
					</div>
				</div>
				<div class="pp-content__pp-info" >
					<div class="pp-content__pp-info__content" >
						<div class="pp-info__characteristic">
							<div class="characteristic__top" >
								<div class="characteristic__left" >
									<div class="product-card__top">
										<div class="stars second-block__item__stars product-card__start">
											<?for ($i=0; $i < 5; $i++) {
												$showStar = ($arResult['PROPERTIES']['RATING']['VALUE'] && $i < round($arResult['PROPERTIES']['RATING']['VALUE'])) ? 'star' : 'star-minus'; ?>
												<div class="svg star-small <?=$showStar?>"></div>
											<?}?>
										</div>
										<p class="characteristic__reviews" >6 отзывов</p>
									</div>
								</div>
								<div class="characteristic__right" >
									<div class="product-card__top">
										<p class="product-card__available">
											<?=($arResult['ITEM_PRICES_CAN_BUY']) ? 'Есть в наличии' : 'Нет в наличии'?>
										</p>
										<p class="characteristic__reviews">
											Артикул
											<span class="characteristic__reviews__vendor-code"><?=$arResult['PROPERTIES']['ARTICLE']['VALUE']?></span>
										</p>
									</div>
								</div>
							</div>
							<div class="characteristic__content" >
								<p class="section__title" >Характеристики</p>
								<ul class="characteristic__ul" >
									<?foreach ($arResult['DISPLAY_PROPERTIES'] as $key => $property) {?>
										<li class="characteristic__li" >
											<p><?=$property['NAME']?>: <span class="characteristic__reviews__vendor-code"><?=$property['DISPLAY_VALUE']?></span></p>
										</li>
									<?}?>
								</ul>
							</div>
						</div>
						<div class="pp-content__pp-right-card" >
							<div class="pp-right-card__body" >
								<div class="pp-right-card__body__item-top">
									<p>Актуальная цена</p>
									<div class="product-card__price-block">
										<div class="product-card__price">
											<?if($arResult['ITEM_PRICES'][0]['DISCOUNT'] > 0):?>
												<p class="product-card__price__2 fz-14px">
													<?=$arResult['ITEM_PRICES'][0]['PRINT_BASE_PRICE']?>
												</p>
											<?endif;?>
											<p class="product-card__price__1 fz-24px">
												<?=$arResult['ITEM_PRICES'][0]['PRINT_PRICE']?>
											</p>
										</div>
										<div class="svg product-card__busket favorite_border <?=$favoritesActive?> addFavorites" data-id="<?=$arResult['ID']?>" data-cookie="favorites"></div>
									</div>
								</div>
								<?if($arResult['ITEM_PRICES_CAN_BUY']):?>
									<div class="counter-busket">
										<div class="counter" >
											<div class="counter__minus">-</div>
											<div class="counter__numer">1</div>
											<div class="counter__plus">+</div>
										</div>
										<div class="button counter__butten cartAdd" data-id="<?=$arResult['ID']?>"><p>В корзину</p></div>
									</div>
									<a class="buscet__button myBtn buyOneClick" data-modal="myModal4" data-id="<?=$arResult['ID']?>" data-price="<?=$arResult['ITEM_PRICES'][0]['PRICE']?>" data-type="productCard">Купить в 1 клик</a>
								<?else:?>
									<button class="product-card__b-button b-button__not-available myBtn" data-modal="myModal8">
										Сообщить о наличии
									</button>
								<?endif;?>
							</div>
						</div>
					</div>
					<div class="pp-content__pp-info__pp-bottom" >
						<div class="pp-bottom__pp-button-block" >
							<div class="section__title pp-button-block__link pp-button-block__link_1 active" ><p>Доставка и самовывоз</p></div>
							<div class="section__title pp-button-block__link pp-button-block__link_2" ><p>Условия хранения</p></div>
						</div>
						<div class="pp-button-block__pp-block-1" >
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "inc",
									"EDIT_TEMPLATE" => "",
									"PATH" => "/local/include/card_delivery.php"
								)
							);?>
						</div>
						<div class="pp-button-block__pp-block-2" >
							<div class="pp-block-1__body pp-block-2__body" >
								<p class="pp-block-2__body__text-bottom" ><?=$arResult['PROPERTIES']['STORAGE']['VALUE']?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<? // Инструкция
$this->SetViewTarget('instruction');?>
	<div class="tags instruction-left__tags">
		<a href="#instruction_brand" class="tag" >
			<p class="tag__text" >Производитель</p>
		</a>
		<?foreach ($arResult['PROPERTIES']['INSTRUCTION']['DESCRIPTION'] as $key => $value) {?>
			<a href="#instruction_<?=$key?>" class="tag">
				<p class="tag__text"><?=$value?></p>
			</a>
		<?}?>
	</div>
	<div class="manufacturer">
		<h2 class="mini-section__title" id="instruction_brand">
			Производитель
		</h2>
		<p class="manufacturer__text"><a href="<?=$arResult['PROPERTIES']['BRAND']['VALUE']?>"><?=$arResult['PROPERTIES']['BRAND']['DISPLAY_VALUE']?></a>Эбботт, США</p>
	</div>
	<?foreach ($arResult['PROPERTIES']['INSTRUCTION']['VALUE'] as $key => $value) {?>
		<div class="about-product" id="instruction_<?=$key?>">
			<h2 class=mini-section__title ><?=$arResult['PROPERTIES']['INSTRUCTION']['DESCRIPTION'][$key]?></h2>
			<div class="about-product__body" >
				<p class="about-product__text" ><?=$value?></p>
			</div>
		</div>
	<?}?>
<?$this->EndViewTarget();?>

<script type="text/javascript">
	var viewedCounter = {
    path: '/bitrix/components/bitrix/catalog.element/ajax.php',
    params: {
      AJAX: 'Y',
      SITE_ID: "<?= SITE_ID ?>",
      PRODUCT_ID: "<?= $arResult['ID'] ?>",
      PARENT_ID: "<?= $arResult['ID'] ?>"
    }
	};
	BX.ready(
    BX.defer(function(){
      BX.ajax.post(
        viewedCounter.path,
        viewedCounter.params
      );
    })
	);
</script>
