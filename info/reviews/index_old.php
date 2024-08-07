<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отзывы");?>
<section class="reviews-page">
	<div class="_container">
		<div class="reviews-page__body">
			<div class="reviews-page__rp-left">
				<div class="rp-left__top">
					<div class="reviews-left__body rp-left__body">
						<div class="reviews-left__body__top">
							<p class="reviews-left__title">Cредняя оценка аптеки</p>
							<div class="reviews-left__top">
								<p class="reviews-left__grade__text">4.8</p>
								<div class="stars second-block__item__stars product-card__start">
									<div class="svg star-small star"></div>
									<div class="svg star-small star"></div>
									<div class="svg star-small star"></div>
									<div class="svg star-small star"></div>
									<div class="svg star-small star-minus"></div>
								</div>
							</div>
						</div>
						<div class="reviews-left__grade-block">
							<p class="reviews-left__text fz-16px">
								Общий рейтинг на основе 4349 отзывов наших покупателей
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
						<input class="rp-left__input" type="checkbox" id="reviewStars5" name="reviewStars5" value="newsletter">
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
						<p class="rp-left__reviews">471 отзывов</p>
					</div>
					<div class="rp-left__srars">
						<input class="rp-left__input" type="checkbox" id="reviewStars4" name="reviewStars4" value="newsletter">
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
						<p class="rp-left__reviews">121 отзывов</p>
					</div>
					<div class="rp-left__srars">
						<input class="rp-left__input" type="checkbox" id="reviewStars3" name="reviewStars3" value="newsletter">
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
						<p class="rp-left__reviews">38 отзывов</p>
					</div>
					<div class="rp-left__srars">
						<input class="rp-left__input" type="checkbox" id="reviewStars2" name="reviewStars2" value="newsletter">
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
						<p class="rp-left__reviews">21 отзывов</p>
					</div>
					<div class="rp-left__srars">
						<input class="rp-left__input" type="checkbox" id="reviewStars1" name="reviewStars1" value="newsletter">
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
						<p class="rp-left__reviews">12 отзывов</p>
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
						<a href="#" class="sort__price sort__hover">
							<div class="sort__price__svg-block">
								<span></span>
							</div>
							<p class="sort__price__text">По цене</p>
						</a>
						<a href="#" class="sort__text sort__hover">
							По популярности
						</a>
						<a href="#" class="sort__price sort__hover none-768">
							<div class="sort__price__svg-block">
								<span></span>
							</div>
							<p class="sort__price__text">По оценке</p>
						</a>
					</div>
					<div class="sort__right">
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
					</div>
				</div>

				<?$APPLICATION->IncludeComponent(
					"sotbit:reviews.reviews.list",
					"about",
					Array(
						"AJAX" => "N",
						"CACHE_TIME" => "36000000",
						"CACHE_TYPE" => "A",
						"DATE_FORMAT" => "d.m.Y",
						"ID_ELEMENT" => 0,
						"MAX_RATING" => "5",
						"PRIMARY_COLOR" => "#a76e6e"
					)
				);?>

				<div class="block__button">
					<a href="#" class="button__link">
						<div class="svg button__link__svg"> </div>
						Показать ещё отзывы
					</a>
				</div>

				<?$APPLICATION->IncludeComponent(
					"sotbit:reviews.reviews.add",
					"blog",
					Array(
						"ADD_REVIEW_PLACE" => "1",
						"AJAX" => "N",
						"BUTTON_BACKGROUND" => "#dbbfb9",
						"CACHE_TIME" => "36000000",
						"CACHE_TYPE" => "A",
						"DEFAULT_RATING_ACTIVE" => "3",
						"ID_ELEMENT" => 0,
						"MAX_RATING" => "5",
						"NOTICE_EMAIL" => "",
						"PRIMARY_COLOR" => "#a76e6e",
						"TEXTBOX_MAXLENGTH" => "200"
					)
				);?>
			</div>
		</div>
	</div>
</section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
