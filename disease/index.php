<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заболевания");
$arResult['DISEASE'] = getElHL(4,[],[],['*']);?>
<section class="product-filter">
	<div class="_container product-filter_container">
		<div class="product-filter__body">
			<div class="product-filter__top">
				<p class="main-title">Поиск по алфавиту</p>
			</div>
			<div class="product-filter__alphabet">
				<div class="alphabet__content">
					<?
						$arAlphabetRU = ['а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я'];
						$arAlphabetEN = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
						$arAlphabetNUM = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
					?>
					<div class="alphabet__items alphabet__ru">
						<?foreach ($arAlphabetRU as $value) {?>
							<a href="?letter=<?=$value?>" class="alphabet__item">
								<p class="alphabet__item__body alphabet__ru__item">
									<?=$value?>
								</p>
							</a>
						<?}?>
					</div>
					<div class="alphabet__items alphabet__en">
						<?foreach ($arAlphabetEN as $value) {?>
							<a href="?letter=<?=$value?>" class="alphabet__item">
								<p class="alphabet__item__body alphabet__en__item">
									<?=$value?>
								</p>
							</a>
						<?}?>
					</div>
					<div class="alphabet__items alphabet__number">
						<?foreach ($arAlphabetNUM as $value) {?>
							<a href="?letter=<?=$value?>" class="alphabet__item">
								<p class="alphabet__item__body alphabet__en__item">
									<?=$value?>
								</p>
							</a>
						<?}?>
					</div>
				</div>
				<div class="alphabet__big-number">
					<p class="alphabet__big-number__text">
						а-я
					</p>
				</div>
			</div>
		</div>
		<div class="product-filter__blocks">
			<div class="product-filter__block product-filter__block-1">
				<div class="product-filter__block__body">
					<ul class="product-filter__ul" style="margin-top: 0">
						<?
							foreach ($arResult['DISEASE'] as $key => $value) {
								// фильтрация по букве
								if ($_REQUEST['letter'] && mb_substr(mb_strtolower($value['UF_NAME']), 0, 1) !== $_REQUEST['letter'])
								 continue;
						?>
							<li class="product-filter__li">
								<a href="/catalog/lekarstva/?diseases=<?=$value['UF_XML_ID']?>" class="product-filter__link">
									<?=$value['UF_NAME']?>
								</a>
							</li>
						<?}?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>

<?$APPLICATION->IncludeComponent("bitrix:news.list", "blog_index", Array(
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"CACHE_FILTER" => "Y",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "N",	// Учитывать права доступа
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
		"DISPLAY_DATE" => "Y",	// Выводить дату элемента
		"DISPLAY_NAME" => "Y",	// Выводить название элемента
		"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"FIELD_CODE" => array(	// Поля
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",	// Фильтр
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"IBLOCK_ID" => "2",	// Код информационного блока
		"IBLOCK_TYPE" => "catalog",	// Тип информационного блока (используется только для проверки)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"NEWS_COUNT" => "4",	// Количество новостей на странице
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"PAGER_TITLE" => "Новости",	// Название категорий
		"PARENT_SECTION" => "",	// ID раздела
		"PARENT_SECTION_CODE" => "",	// Код раздела
		"PREVIEW_TRUNCATE_LEN" => "100",	// Максимальная длина анонса для вывода (только для типа текст)
		"PROPERTY_CODE" => array(	// Свойства
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
		"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
		"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
		"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
