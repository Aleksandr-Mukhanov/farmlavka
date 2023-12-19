<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)die();
use Bitrix\Main\Page\Asset,
    Bitrix\Main\Loader,
    Bitrix\Highloadblock as HL,
    Bitrix\Main\Entity,
    Bitrix\Main\Context,
    Bitrix\Sale\Fuser,
    Bitrix\Sale\Basket;
  Loader::includeModule('highloadblock');
  Loader::includeModule("sale");

  Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/reset.css');
  Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/normalize.css');
  Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/swiper-bundle.css');
  Asset::getInstance()->addCss('https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css');
  Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/style.css');

  Asset::getInstance()->addJs('https://yastatic.net/jquery/3.3.1/jquery.min.js');
  Asset::getInstance()->addJs('https://unpkg.com/js-image-zoom@0.7.0/js-image-zoom.js');
  Asset::getInstance()->addJs('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js');
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/popup.js');
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/range.js');
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/swiper-bundle.js');
  // Asset::getInstance()->addJs('https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js');
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/product-page.js');
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/forblog.js');
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/script.js');
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/jquery.cookie.js');
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/jquery.maskedinput.min.js');
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/scripts.js');

  $arElHL = getElHL(3,[],[],['*']);
  foreach ($arElHL as $value)
    $arSetting[$value['UF_CODE']] = $value['UF_VALUE'];

  $arElHL = getElHL(2,[],[],['*']);
  foreach ($arElHL as $key => $value)
    $arServicePage[$value['UF_SECTION']][] = $value;

  $arSectionSP = getListProperty([],['CODE'=>'UF_SECTION']);

  $siteID = Context::getCurrent()->getSite();
  $userID = Fuser::getId();
  $basket = Basket::loadItemsForFUser($userID, $siteID);
  $basketCNT = array_sum($basket->getQuantityList());

  if(isset($_COOKIE['favorites']))
  	$arFavorites = explode('-',$_COOKIE['favorites']);

  $sumFavorites = count($arFavorites);

  // получим теги
  $rsPropertyEnum = CIBlockPropertyEnum::GetList(
    ["SORT"=>"ASC"],["IBLOCK_ID"=>1, "CODE"=>"TAGS"]
  );
  while($arPropertyEnum = $rsPropertyEnum->Fetch())
    $arTag[$arPropertyEnum['ID']] = $arPropertyEnum['VALUE'];
?>
<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>">

<head>
  <title><?$APPLICATION->ShowTitle()?></title>
  <link rel="icon" href="favicon.ico">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <meta property="og:title" content="<?=$APPLICATION->ShowProperty("title");?>"/>
  <meta property="og:description" content="<?=$APPLICATION->ShowProperty("description");?>"/>
  <meta property="og:image" content="<?='https://'.SITE_SERVER_NAME.SITE_TEMPLATE_PATH?>/images/logo.svg"/>
  <meta property="og:type" content="website" />
  <meta property="og:site_name" content="Аптека.Онлайн" />
  <meta property="og:url" content= "<?='https://'.SITE_SERVER_NAME.$APPLICATION->GetCurDir();?>" />

  <?$APPLICATION->ShowHead()?>
</head>

<body>
  <div id="panel"><?$APPLICATION->ShowPanel();?></div>
  <div class="wrapper">
    <div class="wrapper-top">
      <a href="#" class="svg wrapper-top__block"></a>
    </div>
    <header class="header ">
      <div class="header__top">
        <div class="_container header_container">
          <div class="header__top__flex">
            <div class="header__top__flex__block">
              <?$APPLICATION->IncludeComponent(
                "sotbit:regions.choose",
                "farmlavka",
                Array(
              	   "FROM_LOCATION" => "Y",	// Данные берутся из местоположений
              	),
              	false
              );?>
              <a class="header__top__block header__top__block_2 hbb-active " data-hover-2='2'>
                <div class="header__city__svg header__city__svg__2"></div>
                <span class="header__city__text">Служебные страницы</span>
              </a>
            </div>
            <div class="header__top__flex__block">
              <a href="/favorites/" class="header__top__block">
                <span class="header__city__text">Избранное</span>
                <div class="header__city__svg header__city__svg__3">
                  <span id="cntFavorites"><?=($sumFavorites)?$sumFavorites:0?></span>
                </div>
              </a>
              <?if($USER->IsAuthorized()):?>
                <a class="header__top__block" href="/lk/">
                  <span class="header__city__text"><?=$USER->GetLogin()?></span>
                  <div class="header__city__svg header__city__svg__4"></div>
                </a>
              <?else:?>
                <a class="header__top__block myBtn" data-modal="myModal2">
                  <span class="header__city__text">Личный кабинет</span>
                  <div class="header__city__svg header__city__svg__4"></div>
                </a>
              <?endif;?>
            </div>
          </div>
        </div>
      </div>
      <div class="service-page__section">
        <div class="_container service-page">
          <div class="service-page__grid">
            <?foreach ($arServicePage as $key => $servicePage) {?>
              <div class="service-page__block">
                <h3 class="section__title"><?=$arSectionSP[$key]?></h3>
                <ul class="medicine__ul">
                  <?foreach ($servicePage as $page) {?>
                    <li class="medicine__li">
                      <a href="<?=$page['UF_URL']?>" class="medicine__link">
                        <p>
                          <?=$page['UF_NAME']?>
                        </p>
                        <div class="svg categories-block__item-svg medicine__link__svg"></div>
                      </a>
                    </li>
                  <?}?>
                </ul>
              </div>
            <?}?>
          </div>
        </div>
      </div>
      <div class="_container header_container">
        <div class="header__body">
          <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "inc",
              "EDIT_TEMPLATE" => "",
              "PATH" => "/local/include/header_logo.php"
            )
          );?>
          <div class="header__block__search">
            <div class="header__messages">
              <a href="<?=$arSetting['vk']?>" class="svg header__message header__message-1" target="_blank"></a>
              <a href="<?=$arSetting['instagram']?>" class="svg header__message header__message-2" target="_blank"></a>
              <a href="<?=$arSetting['youtube']?>" class="svg header__message header__message-3" target="_blank"></a>
            </div>
            <div class="header__contacts">
              <div class="header__contact__item">
                <a href="mailto:<?=$arSetting['email']?>" class="header__contact">
                  <div class="svg header__contact__svg header__contact__svg__email"></div>
                  <p class="header__contact__title"><?=$arSetting['email']?></p>
                  <p class="header__contact__suptitle">Напишите нам</p>
                </a>
              </div>
              <div class="header__contact__item">
                <a href="tel:<?=formatPhone($arSetting['phone_1'])?>" class="header__contact">
                  <div class="svg header__contact__svg"></div>
                  <p class="header__contact__title"><?=$arSetting['phone_1']?></p>
                  <p class="header__contact__suptitle">Круглосуточно</p>
                </a>
              </div>
              <div class="header__contact__item">
                <a href="tel:<?=formatPhone($arSetting['phone_2'])?>" class="header__contact">
                  <div class="svg header__contact__svg"></div>
                  <p class="header__contact__title"><?=$arSetting['phone_2']?></p>
                  <p class="header__contact__suptitle">Интернет-аптека</p>
                </a>
              </div>
            </div>
          </div>
          <div class="header__search none-1224" id="searchHeader">
            <?$APPLICATION->IncludeComponent("bitrix:search.form", "header", Array(
            	 "PAGE" => "#SITE_DIR#search/index.php",	// Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
            	 "USE_SUGGEST" => "Y",	// Показывать подсказку с поисковыми фразами
            	),
            	false
            );?>
          </div>
          <div class="header__tell">
            <!-- <a
                href="#"
                class="svg header__tell-svg header__search-button"
              ></a> -->
            <div class="header__search-button header__search-1024px">
              <input class="header__search-1024px__input" placeholder="Начинайте писать или введите название товара..." />
            </div>
            <button class="button myBtn" class="button" data-modal="myModal6">Заказать звонок</button>
            <a href="/basket/" class="svg header__tell-svg header__basket">
              <span><?=$basketCNT?></span>
            </a>
          </div>
        </div>
      </div>
      <?$APPLICATION->IncludeComponent(
      	"bitrix:menu",
      	"main_menu",
      	array(
      		"ALLOW_MULTI_SELECT" => "N",
      		"CHILD_MENU_TYPE" => "left",
      		"DELAY" => "N",
      		"MAX_LEVEL" => "2",
      		"MENU_CACHE_GET_VARS" => array(
      		),
      		"MENU_CACHE_TIME" => "3600",
      		"MENU_CACHE_TYPE" => "A",
      		"MENU_CACHE_USE_GROUPS" => "Y",
      		"ROOT_MENU_TYPE" => "top",
      		"USE_EXT" => "N",
      		"COMPONENT_TEMPLATE" => "main_menu"
      	),
      	false
      );?>

      <div class="header__bottom">
        <div class="_container">
          <div class="header__bottom-items">
            <div class="slider">
              <div class="slider-list grab header-bottom__desktop">
                <div class="slider-track">
                  <div class="slide header__bottom-item header__bottom-item__first">
                    <a href="/catalog/lekarstva/?tag=action" class="header__bottom-item__text header__bottom-item__first">
                      <span class="header__bottom-item__svg">%</span>Акция
                    </a>
                  </div>
                  <div class="slide header__bottom-item header__bottom-item__second">
                    <a href="/catalog/lekarstva/?tag=sale" class="header__bottom-item__text">
                      <span class="header__bottom-item__svg">₽</span>Скидки
                    </a>
                  </div>

                  <?foreach ($arTag as $key => $value) {?>
                    <div class="slide slide__header_1 header__bottom-item">
                      <a href="/catalog/lekarstva/?tag=<?=$key?>" class="header__bottom-item__text"><?=$value?></a>
                    </div>
                	<?}?>

                  <!-- <div class="slide slide__header_1 header__bottom-item">
                    <a href="#" class="header__bottom-item__text">Еще 52</a>
                  </div> -->
                </div>
              </div>
              <div class="slider-arrows header__bottom__slider-arrows">
                <button type="button" class="svg prev"></button>
                <button type="button" class="svg next"></button>
              </div>
            </div>
          </div>
        </div>
      </div>

    </header>

    <header class="header header_mobile ">
      <div class="header__top">
        <div class="_container header_container">
          <div class="header__top__flex">
            <div class="header__top__flex__block">
              <a href="#" class="popup-request header__top__block myBtn" data-modal="myModal7">
                <div class="header__city__svg header__city__svg__1"></div>
                <span class="header__city__text">Москва и область</span>
              </a>
              <a href="#" class="header__top__block myBtn" data-modal="myModal9">
                <div class="header__city__svg header__city__svg__2"></div>
                <span class="header__city__text">Служебные страницы</span>
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="_container header_container">
        <div class="header__body">
          <a href="#" class="svg header__tell-svg header__burger"></a>
          <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "inc",
              "EDIT_TEMPLATE" => "",
              "PATH" => "/local/include/header_logo.php"
            )
          );?>
          <a href="/basket/" class="svg header__tell-svg header__basket"></a>
        </div>
      </div>
      <div class="header__contacts__block">
        <button class="header__contacts__block__text active">
          <div data-contact="1" class="header__contacts__block__text__active">
            <div class="svg header__contacts__block__svg header__contacts-1"></div>
            Мы вам перезвоним
          </div>
          <div data-contact="2" class="header__contacts__block__text__active">
            <div class="svg header__contacts__block__svg header__contacts-2"></div>
            Скрыть контакты
          </div>
        </button>
        <!-- <p class="header__contacts__block ">Скрыть контакты</p> -->
        <div class="header__mobile__contacts__active">
          <div class="header__contacts">
            <div class="header__contact__item">
              <a href="mailto:<?=$arSetting['email']?>" class="header__contact myBtn" data-modal="myModal1">
                <div class="svg header__contact__svg header__contact__svg__email"></div>
                <p class="header__contact__title"><?=$arSetting['email']?></p>
                <p class="header__contact__suptitle">Напишите нам</p>
              </a>
            </div>
            <div class="header__contact__item">
              <a href="tel:<?=formatPhone($arSetting['phone_1'])?>" class="header__contact myBtn" data-modal="myModal6">
                <div class="svg header__contact__svg"></div>
                <p class="header__contact__title"><?=$arSetting['phone_1']?></p>
                <p class="header__contact__suptitle">Напишите нам</p>
              </a>
            </div>
            <div class="header__contact__item">
              <a href="tel:<?=formatPhone($arSetting['phone_2'])?>" class="header__contact myBtn" data-modal="myModal1">
                <div class="svg header__contact__svg"></div>
                <p class="header__contact__title"><?=$arSetting['phone_2']?></p>
                <p class="header__contact__suptitle">Интернет-аптека</p>
              </a>
            </div>
          </div>
          <div class="header__messages">
            <a href="<?=$arSetting['vk']?>" class="svg header__message header__message-1"></a>
            <a href="<?=$arSetting['instagram']?>" class="svg header__message header__message-2"></a>
            <a href="<?=$arSetting['youtube']?>" class="svg header__message header__message-3"></a>
          </div>
        </div>
      </div>
      <div class="header__bottom header__bottom__condition">
        <div class="_container">
          <div class="header__bottom-items">
            <div class="slider">
              <div class="slider-list">
                <div class="slider-track">
                  <div class="slide header__bottom-item header__bottom-item__first">
                    <a href="/catalog/lekarstva/?tag=action" class="header__bottom-item__text header__bottom-item__first">
                      <span class="header__bottom-item__svg">%</span>Акция
                    </a>
                  </div>
                  <div class="slide header__bottom-item header__bottom-item__second">
                    <a href="/catalog/lekarstva/?tag=sale" class="header__bottom-item__text">
                      <span class="header__bottom-item__svg">₽</span>Скидки
                    </a>
                  </div>

                  <?foreach ($arTag as $key => $value) {?>
                    <div class="slide slide__header_1 header__bottom-item">
                      <a href="/catalog/lekarstva/?tag=<?=$key?>" class="header__bottom-item__text"><?=$value?></a>
                    </div>
                	<?}?>

                  <!-- <div class="slide slide__header_1 header__bottom-item">
                    <a href="#" class="header__bottom-item__text">Еще 52</a>
                  </div> -->
                </div>
              </div>
              <div class="slider-arrows header__bottom__slider-arrows">
                <button type="button" class="svg prev"></button>
                <button type="button" class="svg next"></button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="header-mobile__menu">
        <div class="header-mobile__search">
          <div class="header__search-button header__search-1024px">
            <input class="header__search-1024px__input" />
          </div>
        </div>
        <div class="header__catalogs">
          <div class="header_container">
            <?$APPLICATION->ShowViewContent('catalog_mobile');?>
            <div class="header__top__flex__block header__bottom__flex__block">
              <a class="header__top__block ">
                <div class="header__city__svg header__city__svg__3"></div>
                <span class="header__city__text header__city__text__bottom">Избранное</span>
              </a>
              <a class="header__top__block myBtn" data-modal="myModal2">
                <div class="header__city__svg header__city__svg__4"></div>
                <span class="header__city__text header__city__text__bottom">Личный кабинет</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </header>

    <main class="main">
      <?if(!CSite::InDir('/index.php')):?>
        <div class="page-titles">
          <div class="_container">
            <?$APPLICATION->IncludeComponent(
              "bitrix:breadcrumb",
              "farmlavka",
              Array(
              	"PATH" => "",
              	"SITE_ID" => "s1",
              	"START_FROM" => "0",
            	),
            	false
            );?>
            <div class="page__title">
              <div class="product-filter__top">
                <h1 class="main-title"><?=$APPLICATION->ShowTitle()?></h1>
              </div>
            </div>
          </div>
        </div>
      <?endif;?>
