<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<?//для блока "Обратите внимание"
$arRelatedItems[] = $arResult['PROPERTIES']['PROD_1']['VALUE'];
$arRelatedItems[] = $arResult['PROPERTIES']['PROD_2']['VALUE'];

$arSelect = Array('CATALOG_QUANTITY','NAME','ID','XML_ID','CATALOG_PRICE_1');
$arFilter = Array("IBLOCK_ID"=>1, "ID"=>$arRelatedItems, "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($ar_fields = $res->GetNext())
{
    $arResult['RELATED_PROD'][]=$ar_fields;
}

//для встроенной внутрь блока статьи
$arSelect = Array();
$arFilter = Array("IBLOCK_ID"=>2, "ID"=>$arResult['PROPERTIES']['INSERT_ARTICLE']['VALUE'], "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($ar_fields = $res->GetNext())
{
    $arResult['INSERT_ARTICLE']=$ar_fields;
}

//"Читайте также"
$arSelect = Array();
$arFilter = Array("IBLOCK_ID"=>2, "ID"=>$arResult['PROPERTIES']['OTHER_ARTICLES']['VALUE'], "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($ar_fields = $res->GetNext())
{
    $arResult['OTHER_ARTICLES'][] = $ar_fields;
}