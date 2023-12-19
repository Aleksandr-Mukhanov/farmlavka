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
// dump($arResult);
?>
<div class="categories__right__catalog" >
  <h2 class="section__title">Каталог</h2>
  <ul data-catalog class="section__margin catalog__items" >
    <?foreach ($arResult['SECTIONS'] as $section) {?>
      <li class="catalog__item" >
        <a href="<?=$section['SECTION_PAGE_URL']?>" class="catalog__item__body" >
          <div class="catalog__img-block" >
            <img class="catalog__img" src="<?=$section['PICTURE']['SRC']?>" >
          </div>
          <p class="catalog__item__text" ><?=$section['NAME']?></p>
        </a>
      </li>
    <?}?>
  </ul>
  <a class="categories__left__b-button-top rc-button" >
    <div class="header__contacts__block__text__active cb-button-top">
      <div class="svg header__contacts__block__svg  "></div>
      <p>показать Все</p>
    </div>
  </a>
</div>
