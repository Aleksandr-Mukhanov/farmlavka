<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Доставка и самовывоз");
use Bitrix\Main\Page\Asset;
  Asset::getInstance()->addJs('https://api-maps.yandex.ru/2.1/?apikey=f80d129d-d6ef-4dbd-a236-09618983f891&lang=ru_RU');

// dump($_SESSION["SOTBIT_REGIONS"]);
$locationCode = $_SESSION["SOTBIT_REGIONS"]['LOCATION']['CODE'];

$rsDelivery = \Bitrix\Sale\Delivery\Services\Table::getList([
	'filter' => ['ACTIVE'=>'Y'],
	'select' => ['ID','NAME','CONFIG']
]);

while($arDelivery=$rsDelivery->fetch())
	if (\Bitrix\Sale\Delivery\Restrictions\ByLocation::check($locationCode, [], $arDelivery['ID']))
		$arDeliveryAviable[] = $arDelivery;

$arCard = getListProperty([],['USER_FIELD_ID'=>48]);

$rsStore = \Bitrix\Catalog\StoreTable::getList([
	'filter' => ['ID'=>$_SESSION["SOTBIT_REGIONS"]['STORE']],
	'select' => ['ID','TITLE','ADDRESS','GPS_N','GPS_S','PHONE','SCHEDULE','UF_CARD','UF_AVAILABLE']
]);

while($arStore = $rsStore->fetch())
{
  $arStore['COORDINATES'] = $arStore['GPS_N'].','.$arStore['GPS_S'];

  foreach ($arStore['UF_CARD'] as $value)
    $arStore['UF_CARD_NAME'][] = $arCard[$value];

  $arStores[] = $arStore;
}
// dump($arDeliveryAviable);
?><div class="_container delivery-page">
    <?/*?>
  <?$APPLICATION->IncludeComponent(
    "sotbit:regions.choose",
    "delivery",
    Array(
       "FROM_LOCATION" => "Y",	// Данные берутся из местоположений
    ),
    false
  );?>
  <div class="delivery__d-fragmen">
    <div class="d-fragmen__body" >
      <div class="d-fragmen__text-body" >
        <p class="mini-section__title" >Оставайтесь дома! Заказывайте доставку!</p>
        <p class="articles__text" >Чтобы гарантировать безопасность и обеспечить ваше спокойствие, мы ежедневно проверяем самочувствие всех курьеров и на входе выдаем им новые медицинские маски, перчатки и антисептики.</p>
      </div>
    </div>
  </div>
  <div class="delivery__d-delivery">
    <h2 class="main-title" >Доставка</h2>
    <h3 class="mini-section__title">Доставка и самовывоз в Москве и области</h3>
    <p class="articles__text">Доставка заказов в пределах МКАД</p>
    <div class="delivery__d-table">
      <table class="d-table__table">
        <tr class="d-table__head" >
          <th class="d-table__th d-table__th-1" >
            <p class="d-table__th-p" >Способ доставки</p>
          </th>
          <th class="d-table__th" >
            <p class="d-table__th-p" >Время исполнения</p>
          </th>
          <th class="d-table__th" >
            <p class="d-table__th-p" >Стоимость</p>
          </th>
        </tr>
        <?foreach ($arDeliveryAviable as $key => $value) {?>
          <tr class="d-table__body" >
            <td class="d-table__td">
              <p class="d-table__td-p d-table__td-p-1"><?=$value['NAME']?></p>
            </td>
            <td class="d-table__td">
              <p class="d-table__td-p">Дней: <?=$value['CONFIG']['MAIN']['PERIOD']['FROM']?>-<?=$value['CONFIG']['MAIN']['PERIOD']['TO']?></p>
            </td>
            <td class="d-table__td">
              <p class="d-table__td-p"><span class="d-table__td-span"><?=$value['CONFIG']['MAIN']['PRICE']?></span> руб.</p>
            </td>
          </tr>
        <?}?>
      </table>
    </div>
    <p class="articles__text">С другой стороны начало повседневной работы по формированию позиции обеспечивает широкому кругу (специалистов) участие в формировании направлений прогрессивного развития. Повседневная практика показывает, что рамки и место обучения кадров позволяет выполнять важные задания по разработке модели развития. Повседневная практика показывает, что консультация с широким активом требуют от нас анализа позиций, занимаемых участниками в отношении поставленных задач. Идейные соображения высшего порядка, а также сложившаяся структура организации представляет собой интересный эксперимент проверки существенных финансовых и административных условий. Равным образом начало повседневной работы по формированию позиции позволяет оценить значение новых предложений.
    </p>
    <div class="delivery__d-service">
      <div class="d-service__body">
        <div class="d-service__items">
          <div class="d-service__item">
            <div class="d-service__item__body" >
              <p class="d-service__item__text d-service__item__text-1" >SMS с телефоном курьера в день доставки</p>
            </div>
          </div>
          <div class="d-service__item">
            <div class="d-service__item__body" >
              <p class="d-service__item__text d-service__item__text-2" >SMS с телефоном курьера в день доставки</p>
            </div>
          </div>
          <div class="d-service__item">
            <div class="d-service__item__body" >
              <p class="d-service__item__text d-service__item__text-3" >SMS с телефоном курьера в день доставки</p>
            </div>
          </div>
          <div class="d-service__item">
            <div class="d-service__item__body" >
              <p class="d-service__item__text d-service__item__text-4" >SMS с телефоном курьера в день доставки</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <p class="articles__text">Повседневная практика показывает, что дальнейшее развитие различных форм деятельности играет важную роль в формировании существенных финансовых и административных условий. Значимость этих проблем настолько очевидна, что сложившаяся структура организации позволяет выполнять важные задания по разработке существенных финансовых и административных условий. </p>
    <p class="articles__text">Не следует, однако забывать, что дальнейшее развитие различных форм деятельности способствует подготовки и реализации новых предложений. Разнообразный и богатый опыт постоянный количественный рост и сфера нашей активности играет важную роль в формировании направлений прогрессивного развития.</p>
  </div>
  <div class="delivery__d-info">
    <h3 class="mini-section__title" >Информация о доставке</h3>
    <div class="d-info__body" >
      <div class="d-info__item" >
        <div class="d-info__item-body" >
          <p class="articles__text">Доставка доступна для некоторых регионов. Товары для доставки на дом отмечены иконкой «грузовичка». Товары, не доступные для доставки, в заказ не выводятся. Они останутся в корзине для возможности оформления брони в удобную аптеку. </p>
          <p class="articles__text">Разнообразный и богатый опыт укрепление и развитие структуры играет важную роль в формировании новых предложений. Идейные соображения высшего порядка, а также начало повседневной работы по формированию позиции требуют определения и уточнения систем массового участия.</p>
        </div>
      </div>
      <div class="d-info__item" >
        <div class="d-info__item-body d-info__item-body-2 " >
          <p class="articles__text">Повседневная практика показывает, что реализация намеченных плановых заданий в значительной степени обуславливает создание дальнейших направлений развития. Реализация намеченных плановых заданий влечет за собой процесс внедрения и модернизации форм развития. </p>
          <p class="articles__text">Разнообразный и богатый опыт укрепление и развитие структуры играет важную роль в формировании новых предложений. Идейные соображения высшего порядка, а также начало повседневной работы по формированию позиции требуют определения и уточнения систем массового участия.</p>
        </div>
      </div>
      <div class="d-info__item" >
        <div class="d-info__item-body d-info__item-body-3 " >
          <p class="articles__text">Повседневная практика показывает, что реализация намеченных плановых заданий в значительной степени обуславливает создание дальнейших направлений развития. Реализация намеченных плановых заданий влечет за собой процесс внедрения и модернизации форм развития. </p>
          <p class="articles__text">Разнообразный и богатый опыт укрепление и развитие структуры играет важную роль в формировании новых предложений. Идейные соображения высшего порядка, а также начало повседневной работы по формированию позиции требуют определения и уточнения систем массового участия.</p>
        </div>
      </div>
      <div class="d-info__item" >
        <div class="d-info__item-body d-info__item-body-4 " >
          <p class="articles__text">Повседневная практика показывает, что реализация намеченных плановых заданий в значительной степени обуславливает создание дальнейших направлений развития. Реализация намеченных плановых заданий влечет за собой процесс внедрения и модернизации форм развития. </p>
          <p class="articles__text">Разнообразный и богатый опыт укрепление и развитие структуры играет важную роль в формировании новых предложений. Идейные соображения высшего порядка, а также начало повседневной работы по формированию позиции требуют определения и уточнения систем массового участия.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="delivery__d-exchange">
    <h3 class="mini-section__title" >Порядок обмена/возврата</h3>
    <p class="articles__text" >Отказаться от доставленного заказа и его оплаты возможно в следующих случаях:
    </p>
    <ul class="d-exchange__ul" >
      <li class="articles__text">доставленный товар не соответствует заказанному;
      </li>
      <li class="articles__text">товар поврежден вследствие нарушения целостности упаковки;
      </li>
      <li class="articles__text">товар поврежден вследствие несоответствия упаковки характеру вложения и условиям пересылки (за исключением требований по температурному режиму).
      </li>
    </ul>
    <p class="articles__text d-exchange__error" >Товар может быть возвращен только в момент доставки.</p>
    <p class="articles__text " >Согласно Постановлению Правительства РФ от 31.12.2020 №2463 не подлежат обмену и возврату следующие товары надлежащего качества:</p>
    <ul class="d-exchange__ul" >
      <li class="articles__text" >Товары для профилактики и лечения заболеваний в домашних условиях, лекарственные препараты;
      </li>
      <li class="articles__text">Предметы личной гигиены (зубные щетки и другие аналогичные товары);
      </li>
      <li class="articles__text">Парфюмерно-косметические товары.</li>
    </ul>
  </div>
  <div class="delivery__d-medicine">
    <div class="d-fragmen__body">
      <div class="d-medicine__text-body">
        <h3 class="mini-section__title d-medicine__title">Доставка безрецептурных лекарств</h3>
        <p class="articles__text">Согласно указу президента №187 от 17 марта 2020 года о дистанционной продаже безрецептурных лекарств осуществляется доставка на дом безрецептурных лекарственных средств, а также БАД, медицинских изделий, товаров для дома и красоты, бытовой химии и сопутствующих товаров.</p>
      </div>
    </div>
    <div class="d-fragmen__body">
      <div class="d-medicine__text-body">
        <h3 class="mini-section__title d-medicine__title">Доставка рецептурных лекарств</h3>
        <p class="articles__text">Доставка рецептурных лекарств, при наличии рецепта выписанного врачом, осуществляется до ближайшей аптеки.</p>
        </div>
    </div>
  </div>
    <?*/?>
  <div class="delivery__d-pickup">
    <h2 class="main-title" >Самовывоз</h2>
  </div>
  <div class="delivery__d-map">
    <script type="text/javascript">
      // Функция ymaps.ready() будет вызвана, когда
      // загрузятся все компоненты API, а также когда будет готово DOM-дерево.
      ymaps.ready(init);
      function init(){
        // Создание карты.
        var myMap = new ymaps.Map("mapPickUp", {
          center: [55.76, 37.64],
          zoom: 8
        });
        // создание меток
        <?foreach ($arStores as $store) {
          if ($store['COORDINATES']){?>
          var myPlacemark = new ymaps.Placemark(
            [<?=$store['COORDINATES']?>], {
    				hintContent: '<?=$store['TITLE']?>',
    			}, {
    				preset: 'islands#darkGreenDotIcon'
    			});

    			myMap.geoObjects.add(myPlacemark);
          <?}
        }?>

        $('.showInMap').click(function(){
          coordinates = $(this).attr('data-coordinates').split(',');
          myMap.setCenter(coordinates, 8);
        });
      }
    </script>
    <div id="mapPickUp" style="width: 100%; height: 500px"></div>
  </div>
  <div class="l-address">
    <table class="address__table">
      <tr class="address__tr__head">
        <th class="address__th">СПИСОК</th>
        <th class="address__th">АДРЕС</th>
        <th class="address__th">КАРТЫ</th>
        <th class="address__th">ЧАСЫ РАБОТЫ</th>
        <th class="address__th">ТЕЛЕФОН</th>
      </tr>
      <?foreach ($arStores as $store) { // dump($store);?>
        <tr class="address__tr__body" >
          <td class="address__td-body">
            <div class="address__td__block" >
                <div>
                  <p class="address__td-text"><?=$store['TITLE']?></p>
                </div>
            </div>
          </td>
          <td class="address__td-body">
            <div class="address__td__block" >
              <p class="address__td-text address__td-address"><?=$store['ADDRESS']?></p>
            </div>
          </td>
          <td class="address__td-body">
            <div class="address__td__block" >
              <div class="address__td-bank">
                <!-- <img src="./img/svg/bank-2.svg" class="address__td-img" width="90px" height="16px" > -->
                <?=($store['UF_CARD_NAME'])?implode(', ', $store['UF_CARD_NAME']):'-'?>
              </div>
            </div>
          </td>
          <td class="address__td-body">
            <div class="address__td__block" >
                <p class="address__td-text "><?=$store['SCHEDULE']?></p>
              </div>
          </td>
          <td class="address__td-body">
            <div class="address__td__last" >
              <div class="address__td__block" >
                <div>
                  <div class="address__td__block__tell" >
                  <p class="address__td-text address__td-tell"><?=$store['PHONE']?></p>
                </div>
                </div>
              </div>
              <a class="address__td-show">Показать номер</a>
              <div class="address__td-button-block">
                <a class="button footer__button showInMap" href="#mapPickUp" data-coordinates="<?=$store['COORDINATES']?>">Посмотреть</a>
              </div>
            </div>
          </td>
        </tr>
      <?}?>
    </table>
    <!-- <div class="block__button address__bottom-btn">
      <a href="#" class="button__link">
        <div class="svg button__link__svg"> </div>
        Показать все адреса
      </a>
    </div> -->
  </div>
  <div class="delivery__d-text">
    <h3 class="d-text__title">Условия самовывоза</h3>
    <p class="articles__text">
      Забрать собранный заказ вы можете в выбранной вами аптеке.
    </p>
    <p class="articles__text">
      Срок хранения заказа составляет 5 (пять) календарных дня с момента сборки заказа.
    </p>
    <p class="articles__text">
      Если в заказе есть рецептурный препарат, не забудьте взять с собой рецепт.
    </p>
    <p class="articles__text">
      Обязательно проверьте комплектность, целостность, сроки годности товара до оплаты. В случае несоответствия, вы вправе отказаться от заказа или оплатить заказ частично.
    </p>
  </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
