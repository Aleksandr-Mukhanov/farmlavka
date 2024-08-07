<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
  Loader::includeModule("iblock");

$request = $context->getRequest();
$action = $request->getPost('action');
$productID = $request->getPost('productID');
// $productID = 1;

$arOrder = ['SORT'=>'ASC'];
$arFilter = ['IBLOCK_ID'=>1,'ID'=>$productID];
$arSelect = ['ID','NAME','PREVIEW_PICTURE','PROPERTY_RATING'];
$rsElements = CIBlockElement::GetList($arOrder,$arFilter,false,false,$arSelect);
if ($arElement = $rsElements->Fetch()) {
  // dump($arElement);
  for ($i=0; $i < 5; $i++) {
    $showStar = ($i < round($arElement['PROPERTY_RATING_VALUE'])) ? 'star' : 'star-minus';
    $ratingHTML .= '<div class="svg star-small '.$showStar.'"></div>';
  }

	$arResult = [
    'NAME' => $arElement['NAME'],
    'PICTURE' => \CFile::GetPath($arElement['PREVIEW_PICTURE']),
    'RATING' => $ratingHTML
  ];
}

echo json_encode($arResult);
