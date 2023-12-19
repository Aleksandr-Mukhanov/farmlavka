<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");?>
<section class="company-page">
  <div class="_container">
    <br>
    <?$APPLICATION->IncludeComponent(
    	"bitrix:search.page",
    	"farmlavka",
    	array(
    		"AJAX_MODE" => "N",
    		"AJAX_OPTION_ADDITIONAL" => "",
    		"AJAX_OPTION_HISTORY" => "N",
    		"AJAX_OPTION_JUMP" => "N",
    		"AJAX_OPTION_STYLE" => "Y",
    		"CACHE_TIME" => "3600",
    		"CACHE_TYPE" => "A",
    		"CHECK_DATES" => "N",
    		"DEFAULT_SORT" => "rank",
    		"DISPLAY_BOTTOM_PAGER" => "N",
    		"DISPLAY_TOP_PAGER" => "N",
    		"FILTER_NAME" => "",
    		"NO_WORD_LOGIC" => "N",
    		"PAGER_SHOW_ALWAYS" => "N",
    		"PAGER_TEMPLATE" => "",
    		"PAGER_TITLE" => "Результаты поиска",
    		"PAGE_RESULT_COUNT" => "50",
    		"RESTART" => "N",
    		"SHOW_WHEN" => "N",
    		"SHOW_WHERE" => "N",
    		"USE_LANGUAGE_GUESS" => "Y",
    		"USE_SUGGEST" => "Y",
    		"USE_TITLE_RANK" => "Y",
    		"arrFILTER" => array(
    			0 => "no",
    		),
    		"arrWHERE" => "",
    		"COMPONENT_TEMPLATE" => ".default"
    	),
    	false
    );?>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
