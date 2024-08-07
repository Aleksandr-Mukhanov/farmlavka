<!-- слайдер левая часть -->
<div class="swiper-slide main-content__left-block">
  <div class="left-block__text-block">
    <p class="left-block__title">
      <span class="block__title__span">Oral-b vitality <br /></span>электрическая зубная щетка
    </p>
    <p class="left-block__text fz-16px">
      Клинически доказано, что электрическая зубная щетка более
      эффективно очищает полость рта по сравнению с обычной
      мануальной зубной щеткой.
    </p>
    <!-- <div class="main-content_button-block nne-768">
        <a href="./product-filter.html" class="button main-content_button">
          <p class="main-content_button__text">
            Перейти в каталог
          </p>
          <div class="svg main-content_button__svg"></div>
        </a>
      </div> -->
  </div>
  <div class="left-block__img-block">
    <div>
      <img class="img img-p left-block__img" src="<?=SITE_TEMPLATE_PATH?>/img/main-content/left-block.jpg" width="324px" height="324px" alt="электронная зубная щетка" />
    </div>
  </div>
  <div class="main-content_button-block">
    <a href="/catalog/" class="button main-content_button shadow_blue">
      <p class="main-content_button__text">Перейти в каталог</p>
      <div class="svg main-content_button__svg"></div>
    </a>
  </div>
</div>

<!-- слайдер правая часть -->
<div class="swiper-slide main-content__right-block">
  <div class="right-block__first-block">
    <div class="right-block__first-block__body">
      <p class="first-block__body__title fz-18px">
        Увлажняющий крем для лица
        <span class="block__title__span right-block__body__span"><br />Nivea Care</span>
      </p>
      <div class="right-block__body__img-block">
        <img class="img right-block__body__img" src="<?=SITE_TEMPLATE_PATH?>/img/main-content/right-block.jpg" width="270px" height="250px" alt="Увлажняющий крем для лица Nivea Care" />
      </div>
      <div class="main-content_button-block main-content_button-block_2">
        <a href="/catalog/" class="button main-content_button main-content_button_2">
          <p class="main-content_button__text">
            Перейти в каталог
          </p>
          <div class="svg main-content_button__svg"></div>
        </a>
      </div>
    </div>
  </div>

  <div class="right-block__second-block">
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
    <?foreach ($arHit as $product) {?>
      <a href="<?=$product['DETAIL_PAGE_URL']?>" class="second-block__item">
        <div class="second-block__item__body">
          <div class="second-block__item__block-img">
            <img src="<?=CFile::GetPath($product['PREVIEW_PICTURE'])?>" width="80px" height="80px" />
          </div>
          <div class="second-block__item__info">
            <p class="second-block__item__text fz-14px">
              <?=$product['NAME']?>
            </p>
            <div class="second-block__item__price-block">
              <p class="second-block__item__price fz-18px">
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
