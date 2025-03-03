<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");?>
<div class="_container contacts-page">
	<div class="contacts__c-contacts">
		<div class="c-contacts__main">
			<div class="c-contacts__ofice">
				<div class="c-contacts__ofice-body">
					<p class="c-contacts__ofice-text">
						 Информация о службе заказа
					</p>
					<h2 class="c-contacts__ofice-title"></h2>
				</div>
			</div>
			<div class="c-contacts__adress">
				<div class="c-contacts__item">
					 <a class="c-contacts__item__body" >
            <p class="c-contacts__item__title">8-800-201-93-75</p>
            <p class="c-contacts__item__text">Заказать звонок</p>
          </a>
				</div>
				<div class="c-contacts__item">
					 <a class="c-contacts__item__body" >
            <p class="c-contacts__item__title">-</p>
            <p class="c-contacts__item__text">Бесплатно по России</p>
          </a>
				</div>
				<div class="c-contacts__item">
					 <a class="c-contacts__item__body" >
            <p class="c-contacts__item__title">8:00 - 17:00</p>
            <p class="c-contacts__item__text">Будни</p>
          </a>
				</div>
				<div class="c-contacts__item">
					 <a class="c-contacts__item__body" >
            <p class="c-contacts__item__title">info@farmlavka.ru</p>
            <p class="c-contacts__item__text">Написать нам</p>
          </a>
				</div>
			</div>
		</div>
		<!-- <div class="contacts__c-net">
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
		</div> -->
		<div class="contacts__c-requisites">
			<h2 class="company-page__today c-requisites__title">Реквизиты</h2>
			<div class="c-requisites__text-block">
				<p class="c-requisites__text">
 					<span class="c-requisites__span">
						ООО «Торговая компания «Тетра»
 					</span>
				</p>
				<p class="c-requisites__text">
 					<span class="c-requisites__span">
						Юридический адрес: 140200 г. Воскресенск, ул. Победы, д. 18
					</span>
				</p>
				<p class="c-requisites__text">
 					<span class="c-requisites__span">
						ИНН 5005007369
					</span>
				</p>
				<p class="c-requisites__text">
 					<span class="c-requisites__span">
						ОГРН 1025000922759
					</span>
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
	<!-- <div class="contacts__с-how">
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
	</div> -->
</div>
<div class="_container">
	<h2 class="company-page__today c-requisites__title">Режим работы аптек</h2><br>
	<table class="table_contacts">
		<tbody>
			<tr>
				<td>
					<p>
						г. Луховицы, ул.Гагарина д.16
					</p>
				</td>
				<td>
					<p>
						Круглосуточно
					</p>
				</td>
			</tr>
			<tr>
				<td>
					<p>
						г.Воскресенск, ул. Горького д.33
					</p>
				</td>
				<td>
					<p>
						09.00-21.00
					</p>
				</td>
			</tr>
			<tr>
				<td>
					<p>
						г.Воскресенск, ул.Зелинского 5"Г"
					</p>
				</td>
				<td>
					<p>
						Круглосуточно
					</p>
				</td>
			</tr>
			<tr>
				<td>
					<p>
						г. Воскресенск, ул.Зелинского, 6 "Б"
					</p>
				</td>
				<td>
					<p>
						09.00-21.00
					</p>
				</td>
			</tr>
			<tr>
				<td>
					<p>
						г.Воскресенск, ул.Коммунистическая стр.25
					</p>
				</td>
				<td>
					<p>
						08.00-20.00
					</p>
				</td>
			</tr>
			<tr>
				<td>
					<p>
						г.Воскресенск, ул. Комсомольская д.10
					</p>
				</td>
				<td>
					<p>
						08.00-20.00
					</p>
				</td>
			</tr>
			<tr>
				<td>
					<p>
						г.Воскресенск, ул. Комсомольская д.8А
					</p>
				</td>
				<td>
					<p>
						08.00-20.00
					</p>
				</td>
			</tr>
			<tr>
				<td>
					<p>
						г.Воскресенск ул. Менделеева д.8
					</p>
				</td>
				<td>
					<p>
						08.00-20.00
					</p>
				</td>
			</tr>
			<tr>
				<td>
					<p>
						г.Воскресенск, ул. Октябрьская д.7
					</p>
				</td>
				<td>
					<p>
						08.00-20.00
					</p>
				</td>
			</tr>
			<tr>
				<td>
					<p>
						г. Воскресенск ул. Победы д.18
					</p>
				</td>
				<td>
					<p>
						Кругосуточно
					</p>
				</td>
			</tr>
			<tr>
				<td>
					<p>
						г.Воскресенск, ул.Победы д.7
					</p>
				</td>
				<td>
					<p>
						08.00-20.00
					</p>
				</td>
			</tr>
			<tr>
				<td>
					<p>
						г.Воскресенск,&nbsp; ул. Советская д.9А
					</p>
				</td>
				<td>
					<p>
						08.00-20.00
					</p>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<br><br><hr><br><br>
<div class="_container">
	<div class="contacts__c-requisites">
		<div class="c-requisites__text-block">
			<p class="c-requisites__text">
				<span class="c-requisites__span">
					Общество с ограниченной ответственностью «Сайдана»
				</span>
			</p>
			<p class="c-requisites__text">
				<span class="c-requisites__span">
					Юридический адрес: 140200 г. Воскресенск, ул. Победы, д. 18
				</span>
			</p>
			<p class="c-requisites__text">
				<span class="c-requisites__span">
					ИНН 5005029676
				</span>
			</p>
			<p class="c-requisites__text">
				<span class="c-requisites__span">
					ОГРН 1025000922924
				</span>
			</p>
		</div>
	</div>
</div>
<br><br>
<div class="_container">
	<h2 class="company-page__today c-requisites__title">Режим работы аптек</h2><br>
	<table class="table_contacts">
		<tbody>
			<tr>
				<td>
					<p>
						г.Воскресенск,&nbsp;ул.Зелинского&nbsp;д.6
					</p>
				</td>
				<td>
					<p>
						08.00-20.00
					</p>
				</td>
			</tr>
			<tr>
				<td>
					<p>
						г.Воскресенск,&nbsp;ул.Коломенская&nbsp;д.5В
					</p>
				</td>
				<td>
					<p>
						08.00-20.00
					</p>
				</td>
			</tr>
			<tr>
				<td>
					<p>
						г.Воскресенск&nbsp;,&nbsp;ул.Ломоносова&nbsp;107Б
					</p>
				</td>
				<td>
					<p>
						Круглосуточно
					</p>
				</td>
			</tr>
			<tr>
				<td>
					<p>
						г.Воскресенск,&nbsp;ул.Менделеева&nbsp;д.5
					</p>
				</td>
				<td>
					<p>
						08.00-20.00
					</p>
				</td>
			</tr>
			<tr>
				<td>
					<p>
						г.Егорьевск,&nbsp;мкр&nbsp;5-ый&nbsp;д.16&nbsp;п.8
					</p>
				</td>
				<td>
					<p>
						08.00-20.00
					</p>
				</td>
			</tr>
			<tr>
				<td>
					<p>
						г.Воскресенск,&nbsp;ул.Победы&nbsp;д.12
					</p>
				</td>
				<td>
					<p>
						08.00-21.00
					</p>
				</td>
			</tr>
			<tr>
				<td>
					<p>
						г.Воскресенск,&nbsp;ул.&nbsp;Центральная&nbsp;д.9А
					</p>
				</td>
				<td>
					<p>
						круглосуточно
					</p>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
