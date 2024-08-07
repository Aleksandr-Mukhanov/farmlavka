<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $frame = $this->createFrame()->begin(); ?>
<? global $APPLICATION;
global $USER;
if (!is_object($USER)) $USER = new CUser; ?>

		<div class="success" style="display:none;"><?= GetMessage(CSotbitReviews::iModuleID . "_REVIEWS_SUCCESS_TEXT") ?></div>

			<? if ($USER->IsAuthorized() || COption::GetOptionString(CSotbitReviews::iModuleID, "REVIEWS_REGISTER_USERS_" . SITE_ID, "") != 'Y') : ?>
				<?
				if ($arResult['BAN'] != "Y") :
					if ((COption::GetOptionString(CSotbitReviews::iModuleID, "REVIEWS_IF_BUY_" . SITE_ID, "") == 'Y' && $arResult['REVIEWS_BUY'] == 'Y') || COption::GetOptionString(CSotbitReviews::iModuleID, "REVIEWS_IF_BUY_" . SITE_ID, "") != 'Y') : ?>
						<? if ($arResult['CAN_REPEAT'] == 1) : ?>

								<form class="popup-new__form article-" id="add_review" action="javascript:void(null);" enctype="multipart/form-data" method="POST">
									<div class='rating_selection stars second-block__item__stars leave-feedback__start-block'>
										<? for ($i = 1; $i <= $arParams['MAX_RATING']; ++$i) : ?>
											<input data-id="<?= $i ?>" id="star-<?= $i ?>" type="radio" name="rating" value="<?= $i ?>" <?= ($i == $arParams['DEFAULT_RATING_ACTIVE']) ? 'checked' : ''; ?> />
											<label class="js-label1 no-select" data-count="<?= $i ?>" title="" for="star-<?= $i ?>"></label>
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

									<input name="text" id="contentbox" class="popup-new__input popup-new__input-text " type="hidden" id="text" value="Оценка статьи. Не для модерации">

									<div class="popup-new__bottom-block leave-feedback__bottom-block">
										<button type="submit" id="review_submit" class="js-review-submit popup-request button popup-new__button">оценить</button>
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
			<? endif; ?>
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