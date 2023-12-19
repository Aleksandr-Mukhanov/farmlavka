<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

\Bitrix\Main\UI\Extension::load("ui.fonts.ruble");

/**
 * @var array $arParams
 * @var array $arResult
 * @var string $templateFolder
 * @var string $templateName
 * @var CMain $APPLICATION
 * @var CBitrixBasketComponent $component
 * @var CBitrixComponentTemplate $this
 * @var array $giftParameters
 */

$documentRoot = Main\Application::getDocumentRoot();

if (empty($arParams['TEMPLATE_THEME']))
{
	$arParams['TEMPLATE_THEME'] = Main\ModuleManager::isModuleInstalled('bitrix.eshop') ? 'site' : 'blue';
}

if ($arParams['TEMPLATE_THEME'] === 'site')
{
	$templateId = Main\Config\Option::get('main', 'wizard_template_id', 'eshop_bootstrap', $component->getSiteId());
	$templateId = preg_match('/^eshop_adapt/', $templateId) ? 'eshop_adapt' : $templateId;
	$arParams['TEMPLATE_THEME'] = Main\Config\Option::get('main', 'wizard_'.$templateId.'_theme_id', 'blue', $component->getSiteId());
}

if (!empty($arParams['TEMPLATE_THEME']))
{
	if (!is_file($documentRoot.'/bitrix/css/main/themes/'.$arParams['TEMPLATE_THEME'].'/style.css'))
	{
		$arParams['TEMPLATE_THEME'] = 'blue';
	}
}

if (!isset($arParams['DISPLAY_MODE']) || !in_array($arParams['DISPLAY_MODE'], array('extended', 'compact')))
{
	$arParams['DISPLAY_MODE'] = 'extended';
}

$arParams['USE_DYNAMIC_SCROLL'] = isset($arParams['USE_DYNAMIC_SCROLL']) && $arParams['USE_DYNAMIC_SCROLL'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_FILTER'] = isset($arParams['SHOW_FILTER']) && $arParams['SHOW_FILTER'] === 'N' ? 'N' : 'Y';

$arParams['PRICE_DISPLAY_MODE'] = isset($arParams['PRICE_DISPLAY_MODE']) && $arParams['PRICE_DISPLAY_MODE'] === 'N' ? 'N' : 'Y';

if (!isset($arParams['TOTAL_BLOCK_DISPLAY']) || !is_array($arParams['TOTAL_BLOCK_DISPLAY']))
{
	$arParams['TOTAL_BLOCK_DISPLAY'] = array('top');
}

if (empty($arParams['PRODUCT_BLOCKS_ORDER']))
{
	$arParams['PRODUCT_BLOCKS_ORDER'] = 'props,sku,columns';
}

if (is_string($arParams['PRODUCT_BLOCKS_ORDER']))
{
	$arParams['PRODUCT_BLOCKS_ORDER'] = explode(',', $arParams['PRODUCT_BLOCKS_ORDER']);
}

$arParams['USE_PRICE_ANIMATION'] = isset($arParams['USE_PRICE_ANIMATION']) && $arParams['USE_PRICE_ANIMATION'] === 'N' ? 'N' : 'Y';
$arParams['EMPTY_BASKET_HINT_PATH'] = isset($arParams['EMPTY_BASKET_HINT_PATH']) ? (string)$arParams['EMPTY_BASKET_HINT_PATH'] : '/';
$arParams['USE_ENHANCED_ECOMMERCE'] = isset($arParams['USE_ENHANCED_ECOMMERCE']) && $arParams['USE_ENHANCED_ECOMMERCE'] === 'Y' ? 'Y' : 'N';
$arParams['DATA_LAYER_NAME'] = isset($arParams['DATA_LAYER_NAME']) ? trim($arParams['DATA_LAYER_NAME']) : 'dataLayer';
$arParams['BRAND_PROPERTY'] = isset($arParams['BRAND_PROPERTY']) ? trim($arParams['BRAND_PROPERTY']) : '';


\CJSCore::Init(array('fx', 'popup', 'ajax'));
Main\UI\Extension::load(['ui.mustache']);

$mobileColumns = isset($arParams['COLUMNS_LIST_MOBILE'])
	? $arParams['COLUMNS_LIST_MOBILE']
	: $arParams['COLUMNS_LIST'];
$mobileColumns = array_fill_keys($mobileColumns, true);

$jsTemplates = new Main\IO\Directory($documentRoot.$templateFolder.'/js-templates');
/** @var Main\IO\File $jsTemplate */
foreach ($jsTemplates->getChildren() as $jsTemplate)
{
	include($jsTemplate->getPath());
}

$displayModeClass = $arParams['DISPLAY_MODE'] === 'compact' ? ' basket-items-list-wrapper-compact' : '';
// dump($arResult);
if (empty($arResult['ERROR_MESSAGE']))
{?>
	<div class="_container basket__b-main">
		<div class="b-main__left">
			<div class="b-order__top">
				<a class="b-order__clear cartEdit" data-action="cart_clear">Очистить корзину</a>
			</div>
			<div class="b-main__left-body" >
				<ul class="b-main__left__items" >
					<?foreach ($arResult['BASKET_ITEM_RENDER_DATA'] as $item) {
							foreach ($item['COLUMN_LIST'] as $prop) {
								if ($prop['CODE'] == 'PROPERTY_RATING_VALUE') $rating = $prop['VALUE'];
								else $arProp[$prop['NAME']] = $prop['VALUE'];
						}?>
						<li class="b-main__left__item">
							<div class="order b-order" data-id="<?=$item['PRODUCT_ID']?>">
								<div class="b-order__delete cartEdit" data-action='cart_del_el'></div>
								<div class="b-order__right" >
									<div class="product-card__block__img b-order__block-img">
										<div class="product-card__img order__left__img b-order__img-item ">
											<img class="b-order__img" src="<?=$item['IMAGE_URL']?>" alt="<?=$item['NAME']?>">
										</div>
									</div>
									<div class="order__right">
										<div class="product-card__top order__right__top">
											<p class="product-card__available fz-12px">
												Есть в наличии
											</p>
											<div class="stars second-block__item__stars product-card__start">
												<?for ($i=0; $i < 5; $i++) {
													$showStar = ($i < round($rating)) ? 'star' : 'star-minus'; ?>
													<div class="svg star-small <?=$showStar?>"></div>
												<?}?>
											</div>
										</div>
										<p class="product-card__title fz-16px">
											<?=$item['NAME']?>
										</p>
										<ul class="product-card__ul">
											<?foreach ($arProp as $name => $value) {?>
												<li class="product-card__li">
													<p class="product-card__text fz-12px">
														<?=$name?>:
														<span class="product-card__span"><?=$value?></span>
													</p>
												</li>
											<?}?>
										</ul>
									</div>
								</div>
								<div class="product-card__price-block b-order__price">
									<div class="product-card__price order__price">
										<p class="product-card__price__1 fz-24px">
											<?=$item['SUM_PRICE_FORMATED']?>
										</p>
										<?if($item['DISCOUNT_PRICE'] > 0):?>
											<p class="product-card__price__2 fz-14px">
												<?=$item['SUM_FULL_PRICE_FORMATED']?>
											</p>
										<?endif;?>
									</div>
									<div class="counter order__counter">
										<div class="counter__minus cartEdit" data-action='cart_change'>-</div>
										<div class="counter__numer"><?=$item['QUANTITY']?></div>
										<div class="counter__plus cartEdit" data-action='cart_change'>+</div>
									</div>
								</div>
							</div>
						</li>
					<?}?>
				</ul>
			</div>
		</div>
		<div class="b-main__right">
			<div class="b-main__right__body">
				<h3 class="footer__question__title">Ваш заказ</h3>
				<?if($arResult['TOTAL_RENDER_DATA']['DISCOUNT_PRICE_FORMATED']):?>
					<div class="order__text-1 order__color-green" >
						<p class="company-page__text" >Скидка</p>
						<p class="company-page__text">-<?=$arResult['TOTAL_RENDER_DATA']['DISCOUNT_PRICE_FORMATED']?></p>
					</div>
				<?endif;?>
				<div class="order__text-1">
					<p class="company-page__text">Итого без доставки</p>
					<p class="company-page__text"><?=$arResult['TOTAL_RENDER_DATA']['PRICE_FORMATED']?></p>
				</div>
				<a href="/order/" class="button footer__button">Оформить заказ</a>
				<div class="promo-code order__color-green">
					<h3 class="footer__question__title promo-code__title">Промокод</h3>
					<form class="promo-code__search" method="post">
						<input class="footer__question__input promo-code__input" placeholder="Введите промо-код" name="promo">
					</form>
				</div>
			</div>
		</div>
	</div>
<?}
elseif ($arResult['EMPTY_BASKET'])
{
	include(Main\Application::getDocumentRoot().$templateFolder.'/empty.php');
}
else
{
	ShowError($arResult['ERROR_MESSAGE']);
}
