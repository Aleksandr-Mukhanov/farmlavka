<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

//для блока "Обратите внимание"
if ($arResult['PROPERTIES']['PROD_1']['VALUE']) $arRelatedItems[] = $arResult['PROPERTIES']['PROD_1']['VALUE'];
if ($arResult['PROPERTIES']['PROD_2']['VALUE']) $arRelatedItems[] = $arResult['PROPERTIES']['PROD_2']['VALUE'];

if ($arRelatedItems) {
    $arSelect = Array('CATALOG_QUANTITY','NAME','ID','XML_ID','CATALOG_PRICE_1','DETAIL_PAGE_URL');
    $arFilter = Array("IBLOCK_ID"=>1, "ID"=>$arRelatedItems, "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
    while($ar_fields = $res->GetNext())
    {
        $arResult['RELATED_PROD'][]=$ar_fields;
    }
}


//для встроенной внутрь блока статьи
if ($arResult['PROPERTIES']['INSERT_ARTICLE']['VALUE']) {
    $arSelect = Array();
    $arFilter = Array("IBLOCK_ID"=>2, "ID"=>$arResult['PROPERTIES']['INSERT_ARTICLE']['VALUE'], "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
    while($ar_fields = $res->GetNext())
    {
        $arResult['INSERT_ARTICLE']=$ar_fields;
    }
}

//"Читайте также"
if ($arResult['PROPERTIES']['OTHER_ARTICLES']['VALUE']) {
    $arSelect = Array();
    $arFilter = Array("IBLOCK_ID"=>2, "ID"=>$arResult['PROPERTIES']['OTHER_ARTICLES']['VALUE'], "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
    while($ar_fields = $res->GetNext())
    {
        $arResult['OTHER_ARTICLES'][] = $ar_fields;
    }
}

// сделаем содержание
$arParams = [
    "max_len" => "100", // обрезает символьный код до 100 символов
    "change_case" => "L", // буквы преобразуются к нижнему регистру
    "replace_space" => "-", // меняем пробелы на тире
    "replace_other" => "-", // меняем левые символы на тире
    "delete_repeat_replace" => "true", // удаляем повторяющиеся символы
    "use_google" => "false", // отключаем использование google
];

$text = stripslashes($arResult["DETAIL_TEXT"]);
preg_match_all("/<h2.*?>(.*?)<\/h2>/si", $text, $items);

foreach ($items[1] as $key => $value) {
    $arContent[$key] = [
        'CODE' => CUtil::translit($value, "ru", $arParams),
        'NAME' => $value
    ];
}

if (!empty($items[0]) && $arContent) {
    foreach ($items[0] as $i => $row) {
        $arResult["DETAIL_TEXT"] = str_replace($row, '<h2 id="'.$arContent[$i]['CODE'].'">'.$arContent[$i]['NAME'].'</h2>', $arResult["DETAIL_TEXT"]);
    }
}

for ($i=2; $i <= 6; $i++) {
  if ($arResult['PROPERTIES']['TITLE_H'.$i]['VALUE'])
    array_push($arContent,[
      'CODE'=>'title_h'.$i,
      'NAME'=>$arResult['PROPERTIES']['TITLE_H'.$i]['VALUE']
    ]);
}

$arResult['TITLES'] = $arContent;
