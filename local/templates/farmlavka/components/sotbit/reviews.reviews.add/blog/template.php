<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $frame = $this->createFrame()->begin(); ?>
<? global $APPLICATION;
global $USER;
if (!is_object($USER)) $USER = new CUser; ?>
<div class="leave-feedback" id="feedbackAdd">
	<div class="leave-feedback__body reviews_feedback__body">
		<div class="success" style="display:none;"><?= GetMessage(CSotbitReviews::iModuleID . "_REVIEWS_SUCCESS_TEXT") ?></div>

		<div class="spoiler-reviews-body">
			<? if ($USER->IsAuthorized() || COption::GetOptionString(CSotbitReviews::iModuleID, "REVIEWS_REGISTER_USERS_" . SITE_ID, "") != 'Y') : ?>
				<?
				if ($arResult['BAN'] != "Y") :
					if ((COption::GetOptionString(CSotbitReviews::iModuleID, "REVIEWS_IF_BUY_" . SITE_ID, "") == 'Y' && $arResult['REVIEWS_BUY'] == 'Y') || COption::GetOptionString(CSotbitReviews::iModuleID, "REVIEWS_IF_BUY_" . SITE_ID, "") != 'Y') : ?>
						<? if ($arResult['CAN_REPEAT'] == 1) : ?>
							<h3 class="leave-feedback__title">Оставить комментарий</h3>

								<p class="add-check-error" style="display:none;"></p>
								<div class="leave-feedback__stars">
									<p class="leave-feedback__stars__title">
										Оценка:
									</p>
								</div>
								<form class="popup-new__form article-" id="add_review" action="javascript:void(null);" enctype="multipart/form-data">
									<div class='rating_selection stars second-block__item__stars leave-feedback__start-block'>
										<? for ($i = 1; $i <= $arParams['MAX_RATING']; ++$i) : ?>
											<input data-id="<?= $i ?>" id="star-<?= $i ?>" type="radio" name="rating" value="<?= $i ?>" <?= ($i == $arParams['DEFAULT_RATING_ACTIVE']) ? 'checked' : ''; ?> />
											<label class="js-label no-select" data-count="<?= $i ?>" title="" for="star-<?= $i ?>"></label>
										<? endfor; ?>
									</div>
									<input type="hidden" name="ID_ELEMENT" value="<?= $arParams['ID_ELEMENT'] ?>" />
									<input type="hidden" name="MODERATION" value="<?= COption::GetOptionString(CSotbitReviews::iModuleID, "REVIEWS_MODERATION_" . SITE_ID, "") ?>" />
									<input type="hidden" name="NOTICE_EMAIL" value="<?= $arParams['NOTICE_EMAIL'] ?>" />
									<input type="hidden" name="SITE_DIR" value="<?= SITE_DIR ?>" />
									<input type="hidden" name="SPAM_ERROR" value="<?= GetMessage(CSotbitReviews::iModuleID . "_REVIEWS_SPAM_ERROR") ?>" />
									<input type="hidden" name="VIDEO_ERROR" value="<?= GetMessage(CSotbitReviews::iModuleID . "_REVIEWS_VIDEO_ERROR") ?>" />
									<input type="hidden" name="PAGE_URL" value="<?= $APPLICATION->GetCurPage() ?>" />
									<input type="hidden" name="SPAM_ERROR" value="<?= GetMessage(CSotbitReviews::iModuleID . "_REVIEWS_SPAM_ERROR") ?>" />
									<input type="hidden" name="PRIMARY_COLOR" value="<?= $arParams['PRIMARY_COLOR'] ?>" />
									<input type="hidden" name="MAX_RATING" value="<?= $arParams['MAX_RATING'] ?>" />
									<input type="hidden" name="BUTTON_BACKGROUND" value="<?= $arParams['BUTTON_BACKGROUND'] ?>" />
									<input type="hidden" name="ADD_REVIEW_PLACE" value="<?= $arParams['ADD_REVIEW_PLACE'] ?>" />
									<input type="hidden" name="TEMPLATE" value="<?= $templateName ?>" />

									<div class="popup-new__block-name leave-feedback__name">
										<input name="AddFields_REVIEW_USERNAME" class="popup-new__input popup-new__input-name" type="text" id="REVIEW_USERNAME" placeholder="Ваше имя" required>
									</div>
									<div class="popup-new__block-email leave-feedback__email">
										<input name="AddFields_REVIEW_USEREMAIL" class="popup-new__input popup-new__input-email" type="text" id="REVIEW_USEREMAIL" placeholder="Ваш e-mail" required>
									</div>

									<div class="popup-new__block-text leave-feedback__problem">
										<input name="text" id="contentbox" class="popup-new__input popup-new__input-text " type="text" placeholder="Напишите подробный отзыв, это важно ..." required>
									</div>

									<? if (isset($arResult['RECAPTCHA2_SITE_KEY']) && !empty($arResult['RECAPTCHA2_SITE_KEY'])) : ?>
										<div data-captcha-review="Y" id="recaptcha-review-<?= $arResult["REVIEWS_CNT"] ?>" class="captcha-block"></div>
									<? endif; ?>

									<div class="popup-new__bottom-block leave-feedback__bottom-block">
										<button type="submit" id="review_submit" class="popup-request button popup-new__button">отправить</button>
									</div>
									<div class="popup-new__bottom-block__text leave-feedback__text">
										<p class="popup-new__bottom-text">Нажимая на кнопку, вы соглашаетесь на обработку <u><a href="#" class="popup-new__bottom-span">персональных данных</a></u></p>
									</div>
								</form>

						<? else : ?>

							<? if ($arResult['CAN_REPEAT'] == 0) : ?>
								<p class="not-error"><?= GetMessage(CSotbitReviews::iModuleID . "_REPEAT") ?></p>
							<? else : ?>
								<p class="not-error"><?= GetMessage(CSotbitReviews::iModuleID . "_REPEAT_TIME") . ' ' . $arResult['CAN_REPEAT'] ?></p>
							<? endif; ?>

						<? endif; ?>
					<? else : ?>
						<p class="not-buy-error"><?= GetMessage(CSotbitReviews::iModuleID . "_REVIEWS_IF_BUY_NOT_TITLE") ?></p>
					<? endif; ?>


				<? else : ?>
					<p class="not-error not-ban-error"><?= GetMessage(CSotbitReviews::iModuleID . "_REVIEWS_USER_BAN_TITLE") ?></p>
					<? if (isset($arResult['REASON']) && !empty($arResult['REASON'])) : ?>
						<p class="reason-title"><?= GetMessage(CSotbitReviews::iModuleID . "_REVIEWS_USER_BAN_REASON_TITLE") ?></p>
						<p class="reason-text"><?= $arResult['REASON'] ?></p>
					<? endif; ?>
				<? endif; ?>


			<? else : ?>
				<div class="auth-error">
					<?= GetMessage(CSotbitReviews::iModuleID . "_REVIEWS_NO_AUTH") ?>
				</div>
				<div class="forms">
					<div class="form-auth">
						<p id="auth-title"><?= GetMessage(CSotbitReviews::iModuleID . "_AUTH_TITLE") . SITE_SERVER_NAME ?></p>
						<p id="auth_review-check-error" style="display:none;"></p>
						<? $APPLICATION->IncludeComponent(
							"bitrix:system.auth.form",
							"",
							array(
								"REGISTER_URL" => SITE_DIR . "login/",
								"FORGOT_PASSWORD_URL" => SITE_DIR . "login/?forgot_password=yes",
								"PROFILE_URL" => SITE_DIR . "personal/",
								"SHOW_ERRORS" => "Y",
							),
							$component
						); ?>
					</div>
					<div class="form-reg">
						<p id="register-title"><?= GetMessage(CSotbitReviews::iModuleID . "_REGISTER_TITLE") ?></p>
						<p id="registration_review-check-error" style="display:none;"></p>
						<? if (COption::GetOptionString(CSotbitReviews::iModuleID, "REVIEWS_ANONYM_REG_" . SITE_ID, "") == 'Y') : ?>
							<? $APPLICATION->IncludeComponent(
								"sotbit:reviews.anonymregister",
								"",
								array(
									"USER_GROUP" => "",
								),
								$component
							); ?>
						<? else : ?>
							<? $APPLICATION->IncludeComponent(
								"bitrix:main.register",
								"",
								array(
									"USER_PROPERTY_NAME" => "",
									"SEF_MODE" => "Y",
									"SHOW_FIELDS" => array('NAME', 'LAST_NAME'),
									"REQUIRED_FIELDS" => array(),
									"AUTH" => "Y",
									"USE_BACKURL" => "N",
									"SUCCESS_PAGE" => "",
									"SET_TITLE" => "N",
									"USER_PROPERTY" => array(),
									"SEF_FOLDER" => "/",
									"VARIABLE_ALIASES" => array(),
								),
								$component
							); ?>
						<? endif; ?>
					</div>
					<div class="clear"></div>
				</div>
			<? endif; ?>
		</div>
	</div>
</div>
<style>
	.add-reviews .spoiler-input {
		background: <?= $arParams['BUTTON_BACKGROUND'] ?>
	}

	.spoiler-reviews-body .review-add-title {
		color: <?= $arParams['PRIMARY_COLOR'] ?>
	}

	.spoiler-reviews-body .add-check-error {
		color: <?= $arParams['PRIMARY_COLOR'] ?>;
	}

	.spoiler-reviews-body .not-buy-error {
		color: <?= $arParams['PRIMARY_COLOR'] ?>
	}
</style>
<? $frame->end(); ?>
