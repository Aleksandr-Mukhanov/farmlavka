<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");?><div class="_container contacts-page">
	<div class="contacts__c-contacts">
		<div class="c-contacts__main">
			<div class="c-contacts__ofice">
				<div class="c-contacts__ofice-body">
					<p class="c-contacts__ofice-text">
						 Главный офис
					</p>
					<h2 class="c-contacts__ofice-title"></h2>
				</div>
			</div>
			<div class="c-contacts__adress">
				<div class="c-contacts__item">
					 <a class="c-contacts__item__body" >
            <p class="c-contacts__item__title">8-800-777-22-33</p>
            <p class="c-contacts__item__text">Заказать звонок</p>
          </a>
				</div>
				<div class="c-contacts__item">
					 <a class="c-contacts__item__body" >
            <p class="c-contacts__item__title">8 (495) 223-34-03</p>
            <p class="c-contacts__item__text">Бесплатно по России</p>
          </a>
				</div>
				<div class="c-contacts__item">
					 <a class="c-contacts__item__body" >
            <p class="c-contacts__item__title">8:00 - 22:00</p>
            <p class="c-contacts__item__text">Без выходных</p>
          </a>
				</div>
				<div class="c-contacts__item">
					 <a class="c-contacts__item__body" >
            <p class="c-contacts__item__title">info@restoll.ru</p>
            <p class="c-contacts__item__text">Написать нам</p>
          </a>
				</div>
			</div>
		</div>
		<div class="contacts__c-net">
			<div class="c-net__body">
				<p class="c-net__title">
					 Присоединяйтесь к нам в социальных сетях
				</p>
				<div class="c-net__link-block">
 <a class="c-net__link" href="<?=$arSetting['vk']?>" target="_blank">
					<p class="c-net__text">
						 <?=$arSetting['vk']?>
					</p>
 </a> <a class="c-net__link" href="<?=$arSetting['instagram']?>" target="_blank">
					<p class="c-net__text c-net__text-2">
						 <?=$arSetting['instagram']?>
					</p>
 </a> <a class="c-net__link" href="<?=$arSetting['youtube']?>" target="_blank">
					<p class="c-net__text c-net__text-3">
						 <?=$arSetting['youtube']?>
					</p>
 </a>
				</div>
			</div>
		</div>
		<div class="contacts__c-requisites">
			<h2 class="company-page__today c-requisites__title">Реквизиты</h2>
			<div class="c-requisites__text-block">
				<p class="c-requisites__text">
 <span class="c-requisites__span">
					ИНН/КПП&nbsp;5005007369<br>
 </span>
				</p>
				<p class="c-requisites__text">
 <span class="c-requisites__span">
					р/с ларлпрарпл</span>
				</p>
				<p class="c-requisites__text">
 <span class="c-requisites__span">
					БИК&nbsp;</span>5005007369
				</p>
			</div>
		</div>
		<div class="contacts__с-call-back">
			<div class="footer__question__body с-call-back__body">
				<p class="footer__question__title">
					 Мы вам перезвоним
				</p>
				<form class="footer__question__form с-call-back__form sendForm" action="" method="post" data-title="Мы вам перезвоним">
 <input class="footer__question__input с-call-back__input" id="name" placeholder="Иванов Иван Иванович" name="name" type="text"> <input class="footer__question__input с-call-back__input phoneMask" id="number" placeholder="+7 (___) ___-__-__" name="phone" type="tel" required="">
					<p class="footer__question__text">
						 Нажимая на кнопку, вы соглашаетесь на обработку <a href="#" class="footer__question__span">персональных данных</a>
					</p>
					 <!-- <a class="button footer__button myBtn" data-modal="myModal5">перезвоните мне</a> --> <input type="submit" class="button footer__button" value="перезвоните мне">
				</form>
			</div>
		</div>
	</div>
	<div class="contacts__с-how">
		<h2 class="footer__question__title">Как проехать</h2>
		<p class="company-page__text">
 <br>
		</p>
	</div>
	<div class="delivery__d-map">
		 <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A1f3cbf981ad6ebefc335bc36298721c460a38a6a21d073cbaac4f130ac9b1c4d&amp;width=100%25&amp;height=500&amp;lang=ru_RU&amp;scroll=true"></script>
	</div>
	<div class="contacts__с-how">
		<h2 class="footer__question__title">Для партнеров</h2>
 <br>
		<h3 class="company-page__text text-color_level-3">Арендодателям</h3>
		<p class="company-page__text">
 <br>
		</p>
 <br>
		<h3 class="company-page__text text-color_level-3">Для предложений</h3>
		<p class="company-page__text">
 <br>
		</p>
 <br>
		<h3 class="company-page__text text-color_level-3">Центральный офис</h3>
		<p class="company-page__text">
 <br>
		</p>
	</div>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
