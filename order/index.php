<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");?>
<?$APPLICATION->IncludeComponent(
	"farmlavka:sale.order",
	"",
	Array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A"
	)
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
