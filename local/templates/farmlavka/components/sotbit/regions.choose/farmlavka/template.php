<?php

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
$this->setFrameMode(true);
$frame = $this->createFrame()->begin("");
?>

<div class="select-city__dropdown-wrap" id="regions_choose_component_dropdown" style="display: none;">
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

<div id="myModal7" class="modal popup popup__request ">
  <div class="popup-new cities" id="regon_choose_select-city__modal">
    <div class="cities__body">

      <div class="popup-new__top ">
        <p class="popup-new__title">Выбор города: <span data-entity="select-city__js"></span></p>
        <a data-modal="myModal7" class="close popup__close close-popup close-popup_request popup-new__close">
          <div class='svg popup-new__close__svg'></div>
        </a>
      </div>

      <div class="city__input-block">
        <div class="select-city__modal__submit__block-wrap__input_wrap_error" style="display:none;" data-entity="select-city__modal__submit__block-wrap__input_wrap_error"><?= Loc::getMessage(SotbitRegions::moduleId . '_ERROR') ?></div>
        <input type="search" class="city__input" placeholder="Найдите свой город..." data-entity="select-city__modal__submit__input">
        <div class="select-city__modal__submit__vars" data-entity="select-city__modal__submit__vars" style="display: none;"></div>
        <div class="svg city__input__svg submitCity" data-entity="select-city__modal__submit__btn"></div>
      </div>

      <div class="select-city__modal__list" data-entity="select-city__modal__list">
          <!-- region names -->
      </div>

    </div>
  </div>
</div>

<script>
    $componentRegionsChoose = new RegionsChoose();
</script>
<? $frame->end();?>
