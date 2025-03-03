<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отзывы о нас");

$arSort = [
	'date' => 'По дате',
	'like' => 'Самые полезные',
	'score' => 'По оценке',
];

// получим отзывы
if ($_REQUEST['sort'] == 'date')
	$arOrder = ['UF_DATE'=>'DESC'];
elseif ($_REQUEST['sort'] == 'like')
	$arOrder = ['UF_LIKE'=>'DESC'];
elseif ($_REQUEST['sort'] == 'score')
	$arOrder = ['UF_SCORE'=>'DESC'];
else
	$arOrder = ['ID'=>'DESC'];

$arFilter = ['UF_ACTIVE'=>true];
$arElHL = getElHL(9,$arOrder,$arFilter,['*']);
foreach ($arElHL as $key => $value) {
	$arScore[$value['UF_SCORE']][] = $value['UF_SCORE'];
	$scoreSum += $value['UF_SCORE'];
	$arReview[] = $value;
}

$rating = round($scoreSum / count($arReview),2);
?>
<section class="reviews-page">
	<div class="_container">
		<div class="reviews-page__body">
			<div class="reviews-page__rp-left">
				<div class="rp-left__top">
					<div class="reviews-left__body rp-left__body">
						<div class="reviews-left__body__top">
							<h2 class="reviews-left__title">Cредняя оценка аптеки</h2>
							<div class="reviews-left__top">
								<p class="reviews-left__grade__text"><?=$rating?></p>
								<div class="stars second-block__item__stars product-card__start">
									<?for ($i=0; $i < 5; $i++) {
										$star = ($i < $rating) ? 'star' : 'star-minus';?>
										<div class="svg star-small <?=$star?>"></div>
									<?}?>
								</div>
							</div>
						</div>
						<div class="reviews-left__grade-block">
							<p class="reviews-left__text fz-16px">
								Общий рейтинг на основе <?=($arReview)?count($arReview):0?> отзывов наших покупателей
							</p>
							<div class="reviews-left__button-block">
								<a href="#feedbackAdd" class="button reviews__button">
									Оставить отзыв</a>
							</div>
						</div>
					</div>
				</div>
				<div class="rp-left__bottom">
					<div class="rp-left__srars">
						<input class="rp-left__input reviewStars" type="checkbox" id="reviewStars5" value="5" checked>
						<label for="reviewStars5">
							<div class="stars second-block__item__stars product-card__start">
								<div class="svg star-small star"></div>
								<div class="svg star-small star"></div>
								<div class="svg star-small star"></div>
								<div class="svg star-small star"></div>
								<div class="svg star-small star">
								</div>
							</div>
						</label>
						<p class="rp-left__reviews"><?=($arScore[5])?count($arScore[5]):0?> отзывов</p>
					</div>
					<div class="rp-left__srars">
						<input class="rp-left__input reviewStars" type="checkbox" id="reviewStars4" value="4" checked>
						<label for="reviewStars4">
							<div class="stars second-block__item__stars product-card__start">
								<div class="svg star-small star"></div>
								<div class="svg star-small star"></div>
								<div class="svg star-small star"></div>
								<div class="svg star-small star"></div>
								<div class="svg star-small star-minus">
								</div>
							</div>
						</label>
						<p class="rp-left__reviews"><?=($arScore[4])?count($arScore[4]):0?> отзывов</p>
					</div>
					<div class="rp-left__srars">
						<input class="rp-left__input reviewStars" type="checkbox" id="reviewStars3" value="3" checked>
						<label for="reviewStars3">
							<div class="stars second-block__item__stars product-card__start">
								<div class="svg star-small star"></div>
								<div class="svg star-small star"></div>
								<div class="svg star-small star"></div>
								<div class="svg star-small star-minus"></div>
								<div class="svg star-small star-minus">
								</div>
							</div>
						</label>
						<p class="rp-left__reviews"><?=($arScore[3])?count($arScore[3]):0?> отзывов</p>
					</div>
					<div class="rp-left__srars">
						<input class="rp-left__input reviewStars" type="checkbox" id="reviewStars2" value="2" checked>
						<label for="reviewStars2">
							<div class="stars second-block__item__stars product-card__start">
								<div class="svg star-small star"></div>
								<div class="svg star-small star"></div>
								<div class="svg star-small star-minus"></div>
								<div class="svg star-small star-minus"></div>
								<div class="svg star-small star-minus">
								</div>
							</div>
						</label>
						<p class="rp-left__reviews"><?=($arScore[2])?count($arScore[2]):0?> отзывов</p>
					</div>
					<div class="rp-left__srars">
						<input class="rp-left__input reviewStars" type="checkbox" id="reviewStars1" value="1" checked>
						<label for="reviewStars1">
							<div class="stars second-block__item__stars product-card__start">
								<div class="svg star-small star"></div>
								<div class="svg star-small star-minus"></div>
								<div class="svg star-small star-minus"></div>
								<div class="svg star-small star-minus"></div>
								<div class="svg star-small star-minus">
								</div>
							</div>
						</label>
						<p class="rp-left__reviews"><?=($arScore[1])?count($arScore[1]):0?> отзывов</p>
					</div>
				</div>
			</div>
			<div class="reviews-page__rp-right">
				<div class="categories__sort">
					<div class="sort__left">
						<div class="sort__left__body">
							<p class="section__title">
								Сортировать:
							</p>
						</div>
						<?foreach ($arSort as $key => $value) {?>
							<a href="?sort=<?=$key?>" class="<?=($_REQUEST['sort'] == $key)?'sort__text':'sort__price'?> sort__hover">
								<?if($_REQUEST['sort'] != $key):?>
									<div class="sort__price__svg-block">
										<span></span>
									</div>
								<?endif;?>
								<p class="sort__price__text"><?=$value?></p>
							</a>
						<?}?>
					</div>
					<!-- <div class="sort__right">
						<a href="#" class="sort__page">
							<p>1</p>
						</a>
						<a href="#" class="sort__page">
							<p>2</p>
						</a>
						<a href="#" class="sort__page">
							<p>3</p>
						</a>
						<a href="#" class="sort__page">
							<p>4</p>
						</a>
						<a href="#" class="sort__page">
							<p>...</p>
						</a>
						<a href="#" class="sort__page">
							<p>32</p>
						</a>
					</div> -->
				</div>

				<ul class="reviews-right__body">
					<?foreach ($arReview as $key => $review) {?>
						<li class="review__li cnt_stars_<?=$review['UF_SCORE']?>">
							<div class="review__top">
								<div class="rb__flex">
									<p class="review__title">
										<?=$review['UF_NAME']?>, <?=$review['UF_CITY']?>,
										<span class="review__span"><?=$review['UF_DATE']?></span>
									</p>
									<div class="stars second-block__item__stars product-card__start review__stars">
										<?for ($i=0; $i < 5; $i++) {
											$star = ($i < $review['UF_SCORE']) ? 'star' : 'star-minus';?>
											<div class="svg star-small <?=$star?>"></div>
										<?}?>
									</div>
								</div>
								<!-- <div class="people-review__like-block" data-id="<?=$review['ID']?>">
									<a href="#" class="like-block__text like-block__text__like reviewLike" data-type="like">
										<?=$review['UF_LIKE']?>
										<div class="like"></div>
									</a>
									<a href="#" class="like-block__text like-block__text__dislike reviewLike" data-type="dislike">
										<?=$review['UF_DISLIKE']?>
										<div class="dislike"></div>
									</a>
								</div> -->
							</div>
							<p class="review__text">
								<?=$review['UF_TEXT']?>
							</p>
						</li>
					<?}?>
				</ul>

				<!-- <div class="block__button">
					<a href="#" class="button__link">
						<div class="svg button__link__svg"> </div>
						Показать ещё отзывы
					</a>
				</div> -->

				<div class="leave-feedback" id="feedbackAdd">
					<div class="leave-feedback__body reviews_feedback__body">
						<h3 class="leave-feedback__title">Оставить отзыв</h3>
						<div class="leave-feedback__stars">
							<p class="leave-feedback__stars__title">
								Оценка:
							</p>
							<div class="stars second-block__item__stars leave-feedback__start-block reviewScore">
								<div class="svg star-small star-big" data-id='1'></div>
								<div class="svg star-small star-big" data-id='2'></div>
								<div class="svg star-small star-big" data-id='3'></div>
								<div class="svg star-small star-big" data-id='4'></div>
								<div class="svg star-small star-big star-big__minus" data-id='5'></div>
							</div>
						</div>
						<form class="popup-new__form leave-feedback__form sendReview" action="" method="post">
							<div class="popup-new__block-name leave-feedback__name">
								<input class="popup-new__input popup-new__input-name" type="text" name="name" placeholder="Ваше имя" value="<?=$USER->GetFullName()?>" required>
							</div>
							<div class="popup-new__block-email leave-feedback__email">
								<input class="popup-new__input popup-new__input-email" type="email" name="email" placeholder="Ваш e-mail" value="<?=$USER->GetEmail()?>" required>
							</div>
							<div class="popup-new__block-text leave-feedback__problem">
								<textarea class="popup-new__input popup-new__input-text" name="text" placeholder="Напишите подробный отзыв, это важно ..." rows="7"></textarea>
							</div>
							<div class="popup-new__bottom-block leave-feedback__bottom-block">
								<input type="hidden" name="score" value="4">
								<input type="hidden" name="city" value="<?=$_SESSION["SOTBIT_REGIONS"]["NAME"]?>">
								<button type="submit" class="popup-request button popup-new__button">отправить</button>
							</div>
							<div class="popup-new__bottom-block__text leave-feedback__text">
								<p class="popup-new__bottom-text">Нажимая на кнопку, вы соглашаетесь на обработку <u><a href="/info/privacy/" class="popup-new__bottom-span">персональных данных</a></u></p>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
