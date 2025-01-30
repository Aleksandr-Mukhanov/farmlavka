<?set_time_limit(0);
$_SERVER["DOCUMENT_ROOT"] = '/home/bitrix/ext_www/dev.farmlavka.ru';
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
  Loader::includeModule("iblock");
use Bitrix\Main\IO\File;
// https://www.dev.farmlavka.ru/local/cron/import_Wshop.php?start=26000
$fileName = 'WshopExport.csv';
$strCSV = "import ".$fileName." ".date('d.m.Y H:i:s')."\n\n";
$i=$j=$k=$l=$cnt=0;
$start = ($_REQUEST['start']) ? $_REQUEST['start'] : 0;
$count = 100;

$pathImgFolder = $_SERVER["DOCUMENT_ROOT"].'/upload/Wshop/';
$fileWshop = $_SERVER["DOCUMENT_ROOT"].'/upload/'.$fileName;
$fileWshopContent = file_get_contents($fileWshop);
$arfileWshop = explode("\n",$fileWshopContent);

foreach ($arfileWshop as $key => $value) {
  if ($key == 0) continue; // пропустим заголовок

  if ($cnt < $start) {$cnt++;continue;}
  if ($cnt >= $start+$count) break;

  $arValue = explode(";",$value); // dump($arValue);
  if ($arValue[0]) {
    $arInfo[$arValue[0]] = [
      'IMAGE' => $arValue[12],
      'TEXT' => $arValue[13],
      'STORAGE' => $arValue[18]
    ];
    $arXMLids[] = $arValue[0];
    $cnt++;
  }
}

if ($arXMLids) {
  $arOrder = Array("SORT"=>"ASC");
  $arFilter = Array("IBLOCK_ID"=>1,"XML_ID" => $arXMLids);
  $arSelect = Array("ID","NAME","XML_ID",'DETAIL_PICTURE','DETAIL_TEXT',"PROPERTY_STORAGE");
  $rsElements = CIBlockElement::GetList($arOrder,$arFilter,false,false,$arSelect);
  while ($arElement = $rsElements->Fetch()) { $l++;
    // dump($arElement);
    $el = new CIBlockElement;

    // получим id фото
    $imageUrl = $arInfo[$arElement['XML_ID']]['IMAGE'];
    if ($imageUrl) { // && !$arElement['DETAIL_PICTURE']
      $arImage1 = explode('id=',$imageUrl); // dump($arImage1);
      $arImage2 = explode('&token=',$arImage1[1]); // dump($arImage2);
      $imageID = $arImage2[0];

      if ($imageID) {
        $imageOurPath = $pathImgFolder.$imageID.'.jpg';

        if (!File::isFileExists($imageOurPath))
          file_put_contents($imageOurPath, file_get_contents($imageUrl));

        $DETAIL_PICTURE = CFile::MakeFileArray($imageOurPath);
        $arLoadProductArray['DETAIL_PICTURE'] = $DETAIL_PICTURE;
        $j++;
      }
    }

    if ($arInfo[$arElement['XML_ID']]['TEXT']) { //  && !$arElement['DETAIL_TEXT']
      $DETAIL_TEXT = file_get_contents($arInfo[$arElement['XML_ID']]['TEXT']);
      $arLoadProductArray['DETAIL_TEXT'] = $DETAIL_TEXT;
      $k++;
    }

    if (!empty($arLoadProductArray)) { $i++;
      if ($el->Update($arElement['ID'],$arLoadProductArray))
        $strCSV .= $arElement['XML_ID']." (".$arElement['NAME'].") - успешно обновлено!\n";
      else
        $strCSV .= "Ошибка: ".$arElement['XML_ID']." (".$arElement['NAME'].") - ".$el->LAST_ERROR."\n";
    }
    unset($arLoadProductArray);

    // Условия хранения
    $storage = $arInfo[$arElement['XML_ID']]['STORAGE'];
    if ($storage && $storage != $arElement['PROPERTY_STORAGE_VALUE'])
      CIBlockElement::SetPropertyValues($arElement['ID'], 1, $storage, "STORAGE");
  }
}

$strCSV .= "\nВсего товаров: ".$l."\n";
$strCSV .= "Всего обновлено товаров: ".$i."\n";
$strCSV .= "Всего обновлено изображений: ".$j."\n";
$strCSV .= "Всего обновлено описаний: ".$k."\n---\n";

// echo str_replace("\n","<br>",$strCSV);

if ($start < 40000):?>
  <script type="text/javascript">
    document.location.href = 'https://www.dev.farmlavka.ru/local/cron/import_Wshop.php?start=<?=$start+$count?>';
  </script>
<?else:
  $strCSV = "import ".$fileName." ".date('d.m.Y H:i:s')."\n";
  // запишем в файл
  $fp = fopen($_SERVER["DOCUMENT_ROOT"].'/local/cron/import.csv', 'a+');
  fwrite($fp,$strCSV);
  fclose($fp);
endif;?>
