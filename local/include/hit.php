<?
// получим хиты продаж
$arOrder = ['SORT'=>'ASC'];
$arFilter = ['IBLOCK_ID'=>1,'ACTIVE'=>'Y','PROPERTY_HIT'=>8];
$arSelect = ['ID','NAME','PREVIEW_PICTURE','DETAIL_PAGE_URL','PROPERTY_RATING','CATALOG_PRICE_1'];
$rsElements = CIBlockElement::GetList($arOrder,$arFilter,false,false,$arSelect);
while ($arElement = $rsElements->GetNext()) {
  $arHit[] = $arElement;
}
?>
<div class="bestseller">
  <div class="right-block__second-block bestseller__block">
    <?foreach ($arHit as $product) {?>
      <a href="<?=$product['DETAIL_PAGE_URL']?>" class="second-block__item">
        <div class="second-block__item__body bestseller__body">
          <div class="second-block__item__block-img bestseller__img">
            <img src="<?=CFile::GetPath($product['PREVIEW_PICTURE'])?>" width="80px" height="80px">
          </div>
          <div class="second-block__item__info">
            <p class="second-block__item__text fz-14px">
              <?=$product['NAME']?>
            </p>
            <div class="second-block__item__price-block">
              <p class="second-block__item__price fz-18px bestseller__price ">
                <?=formatPrice($product['CATALOG_PRICE_1'])?> ₽
              </p>
              <div class="stars second-block__item__stars">
                <?for ($i=0; $i < 5; $i++) {
                  $showStar = ($i < round($product['PROPERTY_RATING_VALUE'])) ? 'star' : 'star-minus'; ?>
                  <div class="svg star-small <?=$showStar?>"></div>
                <?}?>
              </div>
            </div>
          </div>
        </div>
      </a>
    <?}?>
  </div>
</div>
