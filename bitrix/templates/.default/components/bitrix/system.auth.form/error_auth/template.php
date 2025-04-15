<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

if(!isset($arResult['ERROR_MESSAGE']) || empty($arResult['ERROR_MESSAGE']))
	echo "SUCCESS";
else
	echo $arResult['ERROR_MESSAGE']['MESSAGE'];
?>
