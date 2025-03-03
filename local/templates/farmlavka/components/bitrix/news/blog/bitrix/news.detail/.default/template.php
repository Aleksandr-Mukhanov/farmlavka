<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
// $this->setFrameMode(true);
?>

<main class="main categories-main">
	<div class="_container ">
		<!-- <div class="page-titles articles__page-titles">
			<div class="_container">
				<div class="page-titles__body">
					<a href="./index.html" class="page-titles__link active">
						<div class="svg page-titles__svg page-titles__svg-1"></div>
						<p class="page-titles_text">Главная</p>
					</a>
					<a href="./favorites.html" class="page-titles__link active">
						<div class="svg page-titles__svg page-titles__svg-2"></div>
						<p class="page-titles_text">Лекарственные средства</p>
					</a>
					<a href="./favorites.html" class="page-titles__link active">
						<div class="svg page-titles__svg page-titles__svg-2"></div>
						<p class="page-titles_text">Ферментосодержащие препараты</p>
					</a>
					<a href="./favorites.html" class="page-titles__link">
						<div class="svg page-titles__svg page-titles__svg-2"></div>
						<p class="page-titles_text">Раздраженный кишечник</p>
					</a>
				</div>
			</div>
		</div> -->
		<div class="articles__a-main-content" data-name="<?=$arResult['NAME']?>" data-url="<?=$arResult['DETAIL_PAGE_URL']?>">
			<div class="a-main-content">
				<h1 class="a-main-content__text">
					<?=$arResult['NAME']?>
					<a class="vector vector-bottom"></a>
				</h1>
			</div>
			<div class="a-main-content__img">
				<img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>">
			</div>
		</div>
	</div>
	<div class="_container articles_container">
		<div class="articles__a-content">
			<div class="a-content a-content_top">
				<div class="a-content_top__block-1">
					<p class="after a-content_top__text-1"><?=$arResult['PROPERTIES']['READING_TIME']['VALUE']?> минут на чтение</p>
					<p class="a-content_top__text-2"><a href="<?=$arResult['SECTION']['PATH'][0]['SECTION_PAGE_URL']?>"><?=$arResult['SECTION']['PATH'][0]['NAME']?></a></p>
				</div>
				<div class="a-content_top__block-2">
					<!-- <div class="tags a-content_top__tags">

						<?foreach ($arResult['DISPLAY_PROPERTIES']['TAGS']['VALUE'] as $key => $tag) {?>

								<p class="tag__text"><a href="/blog/?tag=<?=$arResult['DISPLAY_PROPERTIES']['TAGS']['VALUE'][$key]?>" class="tag-detail"><?=$tag?></a></p>

						<?}?>

					</div> -->
				</div>
				<div class="a-content_top__block-3">
					<div class="product-card__top">
						<div class="product-card__top__1">

							<?$APPLICATION->IncludeComponent(
								"sotbit:reviews.statistics",
								"review_stat",
								Array(
									"CACHE_TIME" => "36000000",
									"CACHE_TYPE" => "A",
									"ID_ELEMENT" => $arResult['ID'],
									"MAX_RATING" => "5",
									"PRIMARY_COLOR" => "#a76e6e"
								)
							);?>

						</div>
						<a class="a-content_top__button myBtn" data-modal="modalReadLater">
							<p>Прочитать позже</p>
						</a>

					</div>
				</div>
			</div>
			<div class="articles__a-content-main">
				<div class="a-content-main__left">
					<div class="a-content-main__left__body MBShow">
						<div class="c-main__title user ">
							<p class="c-main__title__text SBtn">
								Содержание
							</p>
						</div>
						<ul class="c-main__items BShow">
							<?foreach ($arResult['TITLES'] as $title) {?>
								<li class="c-main__li">
									<a href="#<?=$title['CODE']?>" class="c-main__item">
										<p class="c-main__item__text"><?=$title['NAME']?>
										</p>
									</a>
								</li>
							<?}?>
						</ul>
					</div>
				</div>
				<div class="a-content-main__right">
					<div class="a-content-main__right__body">

						<div class="articles__text text_format"><?=$arResult['DETAIL_TEXT']?></div>

					</div>
				</div>
			</div>
		</div>

    <?if($arResult['PROPERTIES']['TEXT_H2']['VALUE']):?>
      <div class="acticle__a-info-block">
        <h2 id="title_h2" class="article-suptitle article-suptitle-h2"><?=$arResult['PROPERTIES']['TITLE_H2']['VALUE']?></h2>
        <p class="articles__text"><?=$arResult['PROPERTIES']['TEXT_H2']['VALUE']['TEXT']?></p>
      </div>
    <?endif;?>

    <?if($arResult['RELATED_PROD']):?>
			<section class="note acticle__a-note ">
				<h2 class="main-title">
					Обратите внимание
				</h2>
				<div class="note__body">
					<a href="<?=$arResult['RELATED_PROD'][0]['DETAIL_PAGE_URL']?>" class="product-card note-card">
						<div class="product-card__block__img">
							<div class="product-card__img after-none ">
								<img src="<?=$arResult['RELATED_PROD'][0]['IMAGE']?>" alt="таблетка">
							</div>
						</div>
						<div class="product-card__body">
							<div class="product-card__top">
								<p class="product-card__available fz-12px">
									<?=($arResult['RELATED_PROD'][0]['CATALOG_AVAILABLE']=='Y')? 'Есть в наличии':'Нет в наличии'?>
								</p>
								<div class="stars second-block__item__stars product-card__start">
									<div class="svg star-small star"></div>
									<div class="svg star-small star"></div>
									<div class="svg star-small star"></div>
									<div class="svg star-small star"></div>
									<div class="svg star-small star-minus"></div>
								</div>
							</div>
							<p class="product-card__title fz-16px">
								<?=$arResult['RELATED_PROD'][0]['NAME']?>
							</p>
						</div>
					</a>
					<a href="<?=$arResult['RELATED_PROD'][1]['DETAIL_PAGE_URL']?>" class=" product-card note-card">
						<div class="product-card__block__img">
							<div class="product-card__img after-none">
								<img src="<?=$arResult['RELATED_PROD'][1]['IMAGE']?>" alt="таблетка">
							</div>
						</div>
						<div class="product-card__body">
							<div class="product-card__top">
								<p class="product-card__available fz-12px">
								<?=($arResult['RELATED_PROD'][1]['CATALOG_AVAILABLE']=='Y')? 'Есть в наличии':'Нет в наличии'?>
								</p>
								<div class="stars second-block__item__stars product-card__start">
									<div class="svg star-small star"></div>
									<div class="svg star-small star"></div>
									<div class="svg star-small star"></div>
									<div class="svg star-small star"></div>
									<div class="svg star-small star-minus"></div>
								</div>
							</div>
							<p class="product-card__title fz-16px">
								<?=$arResult['RELATED_PROD'][1]['NAME']?>
							</p>
						</div>
					</a>
					<?/*?>
					<div class="note__last">
						<div class="note__n-last-body">
							<p class="n-last-body__text">
								Вместе дешевле
							</p>
							<div class="product-card__price">
								<p class="product-card__price__1 fz-24px">
									<?
									$const = 10; //перенести в константы
									$sum = $arResult['RELATED_PROD'][0]['CATALOG_PRICE_1']+$arResult['RELATED_PROD'][1]['CATALOG_PRICE_1'];
									$newSum = $sum-$sum/10;
									?>
									<?=$newSum?> руб.
								</p>
								<p class="product-card__price__2 fz-14px">
								<?=$sum?> руб.
								</p>
							</div>
							<div class="button counter__butten">
								<p>В корзину</p>
							</div>
						</div>
					</div>
					<?*/?>
				</div>
			</section>
    <?endif;?>

    <?if($arResult['PROPERTIES']['TEXT_H3']['VALUE']):?>
      <div class="acticle__a-info-block">
        <h3 id="title_h3" class="article-suptitle article-suptitle-h3"><?=$arResult['PROPERTIES']['TITLE_H3']['VALUE']?></h3>
        <p class="articles__text"><?=$arResult['PROPERTIES']['TEXT_H3']['VALUE']['TEXT']?></p>
      </div>
    <?endif;?>
    <?if($arResult['PROPERTIES']['TEXT_H4']['VALUE']):?>
      <div class="acticle__a-info-block">
        <h2 id="title_h4" class="article-suptitle article-suptitle-h4"><?=$arResult['PROPERTIES']['TITLE_H4']['VALUE']?></h2>
        <p class="articles__text"><?=$arResult['PROPERTIES']['TEXT_H4']['VALUE']['TEXT']?></p>
      </div>
    <?endif;?>
    <?if($arResult['PROPERTIES']['TEXT_H5']['VALUE']):?>
      <h2 id="title_h5" class="article-suptitle article-suptitle-h5"><?=$arResult['PROPERTIES']['TITLE_H5']['VALUE']?></h2>
      <p class="articles__text"><?=$arResult['PROPERTIES']['TEXT_H5']['VALUE']['TEXT']?></p>
    <?endif;?>

    <?if($arResult['INSERT_ARTICLE']):?>
			<div class="acticle__a-question">
				<div class="a-question__left-block">
					<div class="a-question__img-p">
						<?$arFile3 = CFile::GetFileArray($arResult['INSERT_ARTICLE']['PREVIEW_PICTURE']);?>
						<img src="<?=$arFile3['SRC']?>" width="360px" height="140px" class="a-question__img">
					</div>
				</div>
				<div class="a-question__right-block">
					<div class="a-question__right-body">
						<h2 class="main-title">
							<?=$arResult['INSERT_ARTICLE']['NAME']?>
						</h2>
						<a href="<?=$arResult['INSERT_ARTICLE']['DETAIL_PAGE_URL']?>" class="articles__text a-question__text">Читать подробнее</a>
					</div>
				</div>
			</div>
    <?endif;?>

    <?if($arResult['PROPERTIES']['TEXT_H5END']['VALUE']):?>
      <div class="acticle__a-info-block">
        <p class="articles__text"><?=$arResult['PROPERTIES']['TEXT_H5END']['VALUE']['TEXT']?></p>
      </div>
    <?endif;?>

		<div class="acticle__a-video">
			<h6 id="title_h6" class="article-suptitle article-suptitle-h6">
				<?=$arResult['PROPERTIES']['TITLE_H6']['VALUE']?>
			</h6>
			<div class="a-video__body">
        <?if($arResult['PROPERTIES']['TEXT_H6']['VALUE']):?>
          <div class="a-video__left">
              <p class="articles__text"><?=$arResult['PROPERTIES']['TEXT_H6']['VALUE']['TEXT']?></p>
          </div>
        <?endif;?>

        <?if($arResult['PROPERTIES']['VIDEO_PREVIEW']['VALUE']):?>
					<div class="a-video__right">
						<?
						$arFile4 = CFile::GetFileArray($arResult['PROPERTIES']['VIDEO_PREVIEW']['VALUE']);
						?>
						<div class="a-video__block__video">
							<img src="<?=SITE_TEMPLATE_PATH?>/img/articles/video_play.png" alt="" class="video_play">
							<img src="<?=$arFile4['SRC']?>" style="width:100%;height:auto;" class="modal-open" alt="">
							<!-- <video width="400" height="300" controls="controls" poster="video/duel.jpg">
								<source src="video/duel.ogv" type='video/ogg; codecs="theora, vorbis"'>
								<source src="video/duel.mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
								<source src="video/duel.webm" type='video/webm; codecs="vp8, vorbis"'>
								Тег video не поддерживается вашим браузером.
								<a href="video/duel.mp4">Скачайте видео</a>.
							</video> -->
						</div>
					</div>
        <?endif;?>

			</div>
		</div>

		<div class="article__a-share">
			<div class="a-share__body">
				<div class="a-share__left">
					<p class="a-share__title">
						<span class="a-share__title-span">Понравилась статья? </span>
						Поделитесь ссылкой с друзьями!
					</p>
					<ul class="a-share__messengers">
						<li class="a-share__item">
							<a href="https://www.facebook.com/sharer/sharer.php?u=dev.farmlavka.ru<?=$arResult['DETAIL_PAGE_URL']?>" class="a-share__item__body a-share__item__body__facebook">
								<p class="a-share__item__text a-share__svg-1"></p>
							</a>
						</li>
						<li class="a-share__item">
							<a href="https://vk.com/share.php?url=dev.farmlavka.ru<?=$arResult['DETAIL_PAGE_URL']?>" class="a-share__item__body a-share__item__body__vk">
								<p class="a-share__item__text a-share__svg-1"></p>
							</a>
						</li>
						<li class="a-share__item">
							<a href="https://twitter.com/share?url=dev.farmlavka.ru<?=$arResult['DETAIL_PAGE_URL']?>" class="a-share__item__body a-share__item__body__twiter">
								<p class="a-share__item__text a-share__svg-1"></p>
							</a>
						</li>
						<li class="a-share__item">
							<a href="https://telegram.me/share/url?url=dev.farmlavka.ru<?=$arResult['DETAIL_PAGE_URL']?>" class="a-share__item__body a-share__item__body__telegram">
								<p class="a-share__item__text a-share__svg-1"></p>
							</a>
						</li>
						<li class="a-share__item">
							<a href="https://connect.ok.ru/offer?url=dev.farmlavka.ru<?=$arResult['DETAIL_PAGE_URL']?>" class="a-share__item__body a-share__item__body__ok">
								<p class="a-share__item__text a-share__svg-1"></p>
							</a>
						</li>
						<li class="a-share__item">
							<a class="a-share__item__body a-share__item__body__youtube">
								<p class="a-share__item__text a-share__svg-1"></p>
							</a>
						</li>
					</ul>
				</div>

				<dia class="a-share__right">
					<p class="a-share__title a-share__right__text">Оцените статью</p>
					<a class="stars second-block__item__stars leave-feedback__start-block">

					<?$APPLICATION->IncludeComponent(
						"sotbit:reviews.reviews.add",
						"review_stars",
						Array(
							"ADD_REVIEW_PLACE" => "1",
							"AJAX" => "N",
							"BUTTON_BACKGROUND" => "#dbbfb9",
							"CACHE_TIME" => "36000000",
							"CACHE_TYPE" => "A",
							"DEFAULT_RATING_ACTIVE" => "3",
							"ID_ELEMENT" => $arResult['ID'],
							"MAX_RATING" => "5",
							"NOTICE_EMAIL" => "",
							"PRIMARY_COLOR" => "#a76e6e",
							"TEXTBOX_MAXLENGTH" => "200"
						)
					);?>
						<!-- <div class="svg star-small star-big"></div>
						<div class="svg star-small star-big"></div>
						<div class="svg star-small star-big"></div>
						<div class="svg star-small star-big"></div>
						<div class="svg star-small star-big__minus"></div> -->
					</a>
				</div>

			</div>
		</div>

  	<?if($arResult['OTHER_ARTICLES']):?>
			<div class="article__a-read-also">
				<p class="a-read-also__title">
					Читайте также
				</p>
				<ul class="a-read-also__items">
					<?foreach ($arResult['OTHER_ARTICLES'] as $article) {?>
						<li class="a-read-also__item">
							<a href="<?=$article["DETAIL_PAGE_URL"]?>" class="a-read-also__items-body">
								<p class="a-read-also__text"><?=$article["NAME"]?></p>
							</a>
						</li>
					<?}?>
				</ul>
			</div>
    <?endif;?>

	</div>
</main>

<div class="callme-form-modal modal_video">
	<div class="callme-form-modal__content">
		<span class="modal-close">&times;</span>
		<div class="callme-form-modal__text">
			<div class="proj_video">
				<?
				$url = str_replace('https://youtu.be/', '',$arResult["PROPERTIES"]['VIDEO']['~VALUE']);
				?>
				<iframe width="100%" height="420" src="https://www.youtube.com/embed/<?=$url?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
		</div>
	</div>
</div>

<div class="js-after-review-modal callme-form-modal">
	<div class="callme-form-modal__content">
		<!-- <span class="js-modal-close modal-close">&times;</span> -->
		<div class="callme-form-modal__text">
				Ваш отзыв принят и отправлен на модерацию
		</div>
	</div>
</div>
