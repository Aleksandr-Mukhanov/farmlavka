<?php

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
$this->setFrameMode(true);
$frame = $this->createFrame()->begin("");
?>

<a class="popup-request header__top__block hide" id="regions_choose_component_delivery">
  <div class="header__city__svg header__city__svg__1"></div>
  <span class="header__city__text" data-entity="select-city__block__text-city"></span>
  <div class="header__city__sign"></div>
</a>

<div class="select-city__dropdown-wrap" id="regions_choose_component_dropdown_delivery" style="display: none;">
    <div class="select-city__dropdown">
        <div class="select-city__dropdown__title-wrap">
        <span class="select-city__dropdown__title" data-entity="select-city__dropdown__title">
            <?= Loc::getMessage(SotbitRegions::moduleId . '_YOUR_CITY') . ' ###?' ?>
        </span>
        </div>
        <div class="select-city__dropdown__choose-wrap">
            <span class="select-city__dropdown__choose__yes select-city__dropdown__choose"
                data-entity="select-city__dropdown__choose__yes"
                ><?= Loc::getMessage(SotbitRegions::moduleId . '_YES') ?>
            </span>
            <span class="select-city__dropdown__choose__no select-city__dropdown__choose"
                data-entity="select-city__dropdown__choose__no"
            >
                <?= Loc::getMessage(SotbitRegions::moduleId . '_NO') ?>
            </span>
        </div>
    </div>
</div>

<div class="delivery__body" id="regon_choose_select-city__modal_delivery">

  <div class="popup-new__top">
    <h3 class="popup-new__title">Выбор города: <span data-entity="select-city__js"></span></h3>
  </div>

  <div class="city__input-block">
    <div class="select-city__modal__submit__block-wrap__input_wrap_error" style="display:none;" data-entity="select-city__modal__submit__block-wrap__input_wrap_error"><?= Loc::getMessage(SotbitRegions::moduleId . '_ERROR') ?></div>
    <input type="search" class="city__input" placeholder="Найдите свой город..." data-entity="select-city__modal__submit__input">
    <div class="svg city__input__svg submitCity" data-entity="select-city__modal__submit__btn"></div>
    <div class="select-city__modal__submit__vars" data-entity="select-city__modal__submit__vars" style="display: none;"></div>
  </div>

  <div class="cities__items__container">
    <ul class="delivery__items" data-entity="select-city__modal__list">
      <!-- region names -->
    </ul>
  </div>

</div>

<script>
    $componentRegionsChoose = new RegionsChooseDelivery();
</script>

<? $frame->end();?>
