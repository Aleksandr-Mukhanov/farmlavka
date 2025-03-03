<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// получим разделы
$arOrder = ['NAME'=>'ASC'];
$arFilter = ['IBLOCK_ID'=>1,'ACTIVE'=>'Y'];
$arSelect = ['ID','NAME','IBLOCK_SECTION_ID','SECTION_PAGE_URL'];
$rsSections = CIBlockSection::GetList($arOrder,$arFilter,false,$arSelect,false);
while ($arSection = $rsSections->GetNext()) {
  if ($arSection['IBLOCK_SECTION_ID']) $arResult['SUBMENU'][$arSection['IBLOCK_SECTION_ID']][] = $arSection;
  else $arResult['MENU'][] = $arSection;
}

// $arResult['DISEASE'] = getElHL(4,[],[],['*']);

// dump($arResult['HIT']);
