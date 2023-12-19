<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="people-reviews" id="reviews-list" data-primary-color="<?= $arParams['PRIMARY_COLOR'] ?>">
	<?
	$frame = $this->createFrame()->begin();
	global $APPLICATION;
	global $USER;

	// echo "<pre>";
	// print_r($arResult);
	// echo "<pre>";
	?>

	<div class="reviews_feedback__body">
		<!-- <div class="list" data-items-count="<?= $arResult["REVIEWS_FILTER_CNT"] ?>" data-date-format="<?= $arParams['DATE_FORMAT'] ?>"> -->
			<? if (isset($arResult['REVIEWS']) && is_array($arResult['REVIEWS'])) { ?>
				<? foreach ($arResult['REVIEWS'] as $Review) { ?>
					<div class="people-review" data-id="<?= $Review['ID'] ?>" data-site-dir="<?= SITE_DIR ?>" class="item" id="review-<?= $Review['ID'] ?>" itemscope itemtype="http://schema.org/Review">
						<div class="people-revuew__body">
							<div class="people-review__top">

								<div class="review__profile">
									<div class="people-review__img">
										<img class="img-responsive" alt="<?= $Review['NAME'] ?>" title="<?= $Review['NAME'] ?>" src="<?= $Review['PERSONAL_PHOTO'] ?>">
									</div>
									<p class="review__title"><?= $Review['USERNAME'] ?></p>
								</div>

								<div class="stars second-block__item__stars">
									<? for ($i = 1; $i <= $Review['RATING']; ++$i) : ?>
										<div class="svg star star-small"></div>
									<? endfor; ?>
								</div>
								<p class="people-review__date"><?= $Review['DATE_CREATION']; ?></p>
								<!-- <a href="#" class="people-review__answer people-review__answer-1">Ответить</a> -->
								<div class="people-review__like-block" data-review-id="<?= $Review['ID'] ?>" data-site-dir="<?= SITE_DIR ?>">

									<div class="like-block__text vote" data-review-id="<?= $Review['ID'] ?>" data-site-dir="<?= SITE_DIR ?>">

										<?= (isset($Review['ID']) && !empty($Review['ID']) && isset($_COOKIE['LIKE']) && is_array($_COOKIE['LIKE']) && in_array($Review['ID'], $_COOKIE['LIKE'])) ? '<div class="voted-yes"></div>' : '<div class="like yes" style="left:-45px;cursor:pointer"></div>'; ?>
										<div class="yescnt" style="position: absolute;left:-20px;"><?= $Review['LIKES'] ?></div>


										<?= (isset($Review['ID']) && !empty($Review['ID']) && isset($_COOKIE['LIKE']) && is_array($_COOKIE['LIKE']) && in_array($Review['ID'], $_COOKIE['LIKE'])) ? '<div class="voted-no"></div>' : '<div class="dislike no" style="cursor:pointer"></div>' ?>
										<div class="nocnt"><?= $Review['DISLIKES'] ?></div>

									</div>
								</div>
							</div>
							<p class="review__text"><?= $Review['TEXT'] ?></p>
							<!-- <a href="#" class="people-review__answer people-review__answer-2">Ответить</a> -->
						</div>
					</div>
				<? } ?>
			<? } else { ?>
				<p><?= GetMessage(CSotbitReviews::iModuleID . "_REVIEWS_NO_RESULTS") ?></p>
			<? } ?>
		<!-- </div> -->
	</div>

	<? if ($arResult['CNT_PAGES'] > 1) : ?>
		<div id="filter-pagination" data-cnt-left-pgn="<?= $arResult["CNT_LEFT_PGN"] ?>" data-cnt-right-pgn="<?= $arResult["CNT_RIGHT_PGN"] ?>" data-per-page="<?= COption::GetOptionString(CSotbitReviews::iModuleID, "REVIEWS_COUNT_PAGE_" . SITE_ID, "10") ?>" <?= ($arResult['CNT_PAGES'] <= 1) ? 'style="display:none;' : '' ?>>
			<? if ($arResult['CURRENT_PAGE'] > 1) : ?>
				<div class="left-arrows">
					<button data-number="1" type="button" class="first">
						<i class="fa fa-angle-double-left"></i>
					</button>
					<button data-number="<?= $arResult['CURRENT_PAGE'] - 1 ?>" type="button" class="prev">
						<i class="fa fa-angle-left"></i>
					</button>
				</div>
			<? endif; ?>

			<? for ($i = 1; $i <= $arResult['CNT_PAGES']; ++$i) : ?>

				<? if ($arResult['CNT_PAGES'] - $arResult["CNT_LEFT_PGN"] - $arResult["CNT_RIGHT_PGN"] < $arResult['CURRENT_PAGE']) : ?>
					<? if ($i >= $arResult['CNT_PAGES'] - $arResult["CNT_LEFT_PGN"] - $arResult["CNT_RIGHT_PGN"] && $i <= $arResult['CNT_PAGES'] - $arResult["CNT_RIGHT_PGN"]) : ?>
						<button data-number="<?= $i ?>" type="button" <?= ($i == $arResult['CURRENT_PAGE']) ? 'data-active="true" class="current"' : '' ?>><?= $i ?></button>
					<? endif ?>
				<? else : ?>
					<? if ((int) ceil($arResult['CURRENT_PAGE'] / $arResult["CNT_LEFT_PGN"]) == (int) ceil($i / ($arResult["CNT_LEFT_PGN"]))) : ?>
						<button data-number="<?= $i ?>" type="button" <?= ($i == $arResult['CURRENT_PAGE']) ? 'data-active="true" class="current"' : '' ?>><?= $i ?></button>
					<? endif; ?>


					<? if ((int) ceil($arResult['CURRENT_PAGE'] / $arResult["CNT_LEFT_PGN"]) * $arResult["CNT_LEFT_PGN"] + 1 == $i) : ?>
						<button data-number="<?= $i ?>" type="button" class="dots">...</button>
					<? endif; ?>
				<? endif; ?>
				<? if ($i > $arResult['CNT_PAGES'] - $arResult["CNT_RIGHT_PGN"]) : ?>
					<button data-number="<?= $i ?>" type="button" <?= ($i == $arResult['CURRENT_PAGE']) ? 'data-active="true" class="current"' : '' ?>><?= $i ?></button>
				<? endif; ?>

			<? endfor; ?>
			<? if ($arResult['CURRENT_PAGE'] <> $arResult['CNT_PAGES']) : ?>
				<div class="right-arrows">
					<button data-number="<?= $arResult['CURRENT_PAGE'] + 1 ?>" type="button" class="next">
						<i class="fa fa-angle-right"></i>
					</button>
					<button data-number="<?= $arResult['CNT_PAGES'] ?>" type="button" class="last">
						<i class="fa fa-angle-double-right"></i>
					</button>
				</div>
			<? endif; ?>
		</div>
	<? endif; ?>

	<style>
		#reviews-body #filter-pagination button.current {
			color: <?= $arParams['PRIMARY_COLOR'] ?>;
		}
	</style>
	<div id="idsReviews" style="display:none" data-site-dir="<?= SITE_DIR ?>"><?= $arResult['REVIEWS_IDS'] ?></div>
	<? $frame->end(); ?>

</div>
<script>
	$(".image-review").colorbox();
</script>