<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вакансии");
?>

<section class="company-page" >
  <div class="_container" >
    <div class="company-page__text-block" >
      <h2>Отправить резюме</h2>
      <form class="footer__question__form с-call-back__form sendForm" action="" method="post" data-title="Резюме">
        <input class="footer__question__input с-call-back__input" placeholder="Ваше имя" name="name" type="text" required>
        <input class="footer__question__input с-call-back__input phoneMask" placeholder="Телефон" name="phone" type="tel" required>
        <input class="footer__question__input с-call-back__input" placeholder="E-mail" name="email" type="email">
        <input class="footer__question__input с-call-back__input" placeholder="Желаемая должность" name="position" type="text" required>
        <input class="footer__question__input с-call-back__input" placeholder="Файл" name="file" type="file">
        <textarea class="footer__question__input с-call-back__input" name="text" rows="8" cols="80" placeholder="Текст резюме"></textarea>
        <p class="footer__question__text">
          Нажимая на кнопку, вы соглашаетесь на обработку
          <a href="#" class="footer__question__span">персональных данных</a>
        </p>
        <input type="submit" class="button footer__button" value="Отправить">
      </form>
    </div>
  </div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
