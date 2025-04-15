<?php
// Подключаем необходимые файлы Битрикса
require_once($_SERVER['DOCUMENT_ROOT'] . '/home/f/farmlavka/public_html/bitrix/modules/main/include/prolog_before.php');
CModule::IncludeModule('iblock');

// Путь к JSON файлу с категориями
$jsonFilePath = 'test_categories.json';

// Читаем содержимое JSON файла
$jsonData = @file_get_contents($jsonFilePath);
if($jsonData === false) {
    die('Ошибка чтения файла');
}


// Преобразуем JSON данные в массив
$categories = json_decode($jsonData, true);

// Идентификатор инфоблока, в который будем добавлять категории
$iblockId = 1;

// Создаем новые категории
foreach ($categories as $category) {
    $bs = new CIBlockSection;
    $sectionFields = array(
        'IBLOCK_SECTION_ID' => 0, // Идентификатор родительской категории (0 - корневая категория)
        'IBLOCK_ID' => $iblockId,
        'NAME' => $category['name'], // Название категории
    );
    $sectionId = $bs->Add($sectionFields); // Добавление категории

    if ($sectionId) {
        echo 'Категория "' . $category['name'] . '" успешно добавлена.' . PHP_EOL;
    } else {
        echo 'Ошибка при добавлении категории "' . $category['name'] . '". ' . $bs->LAST_ERROR . PHP_EOL;
    }
}

// Отключаем вывод пролога и окончания сайта, чтобы скрипт не выполнял ненужные действия
define('PUBLIC_AJAX_MODE', true);
define('NO_KEEP_STATISTIC', true);
define('NO_AGENT_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('CACHED_BX_STATISTIC', true);
define('STOP_STATISTICS', true);
define('NOT_CHECK_FILE_PERMISSIONS', true);
define('DisableEventsCheck', true);
