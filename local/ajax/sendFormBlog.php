<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Mail\Event;
//отправка почтового  шаблона №93 из формы заявки

if (!empty($_POST)) {

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $articleName = $_POST['articlename'];
    $articleUrl = $_POST['articleurl'];
    // file_put_contents($_SERVER['DOCUMENT_ROOT'].'/testRegEmail.txt',print_r($email,1));
        // Event::send(array(
        //     "EVENT_NAME" => "READ_LATER",
        //     'MESSAGE_ID' => 93,
        //     "LID" => "s1",
        //     "C_FIELDS" => array(
        //         "USER_NAME" => $name,
        //         "USER_EMAIL" => $email,
        //         "ARTICLE_NAME" => $articleName,
        //         "ARTICLE_URL" => $articleUrl,
        //     ),
        // ));

        $mailFields = [
          "USER_NAME" => $name,
          "USER_EMAIL" => $email,
          "ARTICLE_NAME" => $articleName,
          "ARTICLE_URL" => $articleUrl,
        ];

        CEvent::Send("READ_LATER", "s1", $mailFields);

    $message = 'Ссылка на статью успешно отправлена на ваш email!';

} else {
    $message = 'Произошла ошибка, повторите вашу заявку.';
}
$response = ['message' => $message];

header('Content-type: application/json');
echo json_encode($response);
