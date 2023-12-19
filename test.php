<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");

$locationCode = $_SESSION["SOTBIT_REGIONS"]['LOCATION']['CODE'];

$rsDelivery = \Bitrix\Sale\Delivery\Services\Table::getList([
	'filter' => ['ACTIVE'=>'Y'],
	'select' => ['ID','NAME','CONFIG']
]);
// dump($locationCode);
while($arDelivery=$rsDelivery->fetch())
{
	if (\Bitrix\Sale\Delivery\Restrictions\ByLocation::check($locationCode, [], $arDelivery['ID']))
	{
		$arDeliveryAviable[] = $arDelivery;
	}
}
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:search.suggest.input",
	"",
	array(
		"NAME" => "q",
		"VALUE" => "",
		"INPUT_SIZE" => 15,
		"DROPDOWN_SIZE" => 10,
	),
	$component, array("HIDE_ICONS" => "N")
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
