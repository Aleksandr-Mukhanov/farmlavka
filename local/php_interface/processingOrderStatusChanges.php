<?php
$_SERVER["DOCUMENT_ROOT"] = realpath(dirname(__FILE__)."/../../");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('sale');

function updateStatuses()
{
    $directory = '/home/back1c/ftp/orders/';
    $filename = $directory . 'tests.json';
    file_put_contents($filename, 'test text');
    $directory = '/home/back1c/ftp/statuses/';
    // Получаем список файлов в директории
    $files = scandir($directory);
    $matchingFiles = preg_grep('/[\s\S]+\.json/', $files);

//    $order = \Bitrix\Sale\Order::load(190);
//    echo '   == ' . $order -> getField('STATUS_ID') . '    ' . $order -> getField('CANCELED') . '   ';


    foreach ($matchingFiles as $file) {
        if (is_file($directory . $file)) {
            // Чтение содержимого файла
            $content = file_get_contents($directory . $file);
            $myRightJson = removeBOM($content);
            $data = json_decode($myRightJson);

            if (json_last_error() !== JSON_ERROR_NONE) {
                die('Ошибка при декодировании JSON: ' . json_last_error_msg());
            }

            $id = intval($data->id);
            $status = $data->status;
            // Находим заказ с таким id и меняем статус
            try {
                $order = \Bitrix\Sale\Order::load($id);
                if ($order) {
                    if ($status == 'Success') {
                        $order->setField('STATUS_ID', 'N');
                    } else if ($status == 'Canceled_by_farmacy') {
                        $order->setField('CANCELED', 'Y');
                    }else if($status == 'delivery') {
                        $order->setField('STATUS_ID', 'DF');
                    }else if($status == 'Completed') {
                        $order->setField('STATUS_ID', 'F');
                    }
                    $order->save(false);
                } else {
                    // Обработка ошибки, если заказ не был загружен
                }
            } catch (Exception $e) {
                // Обработка ошибки, если произошло исключение при обновлении статуса
            }

        }
    }
}

updateStatuses();
function removeBOM($data) {
    if (0 === strpos(bin2hex($data), 'efbbbf')) {
        return substr($data, 3);
    }
    return $data;
}