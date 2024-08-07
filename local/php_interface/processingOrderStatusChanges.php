<?php
$_SERVER["DOCUMENT_ROOT"] = realpath(dirname(__FILE__) . "/../../../dev.farmlavka.ru/");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('sale');

function updateStatuses()
{
//    $logfile = '/var/log/farmlavka_integration/statuses/status' . date("Y-m-d_H-i-s") . '.log';
//    $file = fopen($logfile, 'a');
//    $timestamp = date("Y-m-d H:i:s");
//    if ($file === false) {
//        die('Unable to open log file for writing.');
//    }
//    $logMessage = $timestamp . " начат процесс обработки статусов заказов" . PHP_EOL;
//    fwrite($file, $logMessage);

    $directory = '/home/back1c/ftp/statuses/';
    // Получаем список файлов в директории
    $files = scandir($directory);
    $matchingFiles = preg_grep('/[\s\S]+\.json/', $files);
//    $logMessage = $timestamp . " начат процесс обработки статусов заказов" . PHP_EOL;
//    fwrite($file, $logMessage);
//    echo $logMessage;

    foreach ($matchingFiles as $filename) {
        if (is_file($directory . $filename)) {
            // Чтение содержимого файла
            $content = file_get_contents($directory . $filename);
            $myRightJson = removeBOM($content);
            $data = json_decode($myRightJson);

            if (json_last_error() !== JSON_ERROR_NONE) {
//                fwrite($file, 'Ошибка при декодировании JSON: ' . json_last_error_msg() . PHP_EOL);
                continue;
            }

            $id = intval($data->id);
            $status = $data->status;

//            $logMessage = $id . " заказ начал обработку..." . PHP_EOL;
//            fwrite($file, $logMessage);

            // Находим заказ с таким id и меняем статус
            try {
                $order = \Bitrix\Sale\Order::load($id);
                if ($order) {
                    if ($status == 'Success') {
                        $order->setField('STATUS_ID', 'N');
                    } else if ($status == 'Canceled_by_farmacy') {
                        $order->setField('CANCELED', 'Y');
                        $order->setField('STATUS_ID', 'V');
                    } else if ($status == 'delivery') {
                        $order->setField('STATUS_ID', 'DF');
                    } else if ($status == 'Completed') {
                        $order->setField('STATUS_ID', 'F');
                    }
                    $order->save(false);
                } else {
//                    fwrite($file, 'Ошибка: заказ с id ' . $id . ' не найден.' . PHP_EOL);
                }
            } catch (Exception $e) {
//                fwrite($file, 'Ошибка при обработке заказа ' . $id . ': ' . $e->getMessage() . PHP_EOL);
            }
        }
    }

//    fclose($file);
}

updateStatuses();

function removeBOM($data)
{
    if (0 === strpos(bin2hex($data), 'efbbbf')) {
        return substr($data, 3);
    }
    return $data;
}
