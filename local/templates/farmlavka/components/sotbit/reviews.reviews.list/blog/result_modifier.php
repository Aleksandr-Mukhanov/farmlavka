<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

foreach ($arResult['REVIEWS'] as $key => $Review) {
    $rsUser = CUser::GetByID($Review['ID_USER']);
    $arUser = $rsUser->Fetch();

    if (!empty($arUser['NAME'])) {
        $arResult['REVIEWS'][$key]['USERNAME'] = $arUser['NAME'];
    } else {
        $arResult['REVIEWS'][$key]['USERNAME'] = $arUser['LOGIN'];
    }

}


?>