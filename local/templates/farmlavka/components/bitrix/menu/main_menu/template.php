<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="header__catalogs">
	<div class="_container header_container">
		<ul class="header__catalogs__body">
			<?foreach ($arResult['MENU'] as $item) {?>
				<li>
					<a href="<?=$item['SECTION_PAGE_URL']?>" class="header__catalog" data-submenu="<?=$item['ID']?>">
						<div class="svg header__catalog__svg header__catalog__svg-<?=$item['ID']?>"></div>
						<div class="header__catalog__text"><?=$item['NAME']?></div>
					</a>
				</li>
			<?}?>
		</ul>
	</div>
</div>
<div class="medicine__section">
	<div class="_container medicine">
		<div class="medicine__block">
			<h3 class="section__title">Категории</h3>
			<div class="medicine__grid">
				<?foreach ($arResult['SUBMENU'] as $id => $submenu) { $i=0; ?>
					<ul class="medicine__ul submenu_ul submenu-<?=$id?>">
						<?foreach ($submenu as $item) { $i++; ?>
							<?if ($i == 16) echo '</ul><ul class="medicine__ul">';?>
							<li class="medicine__li">
								<a href="<?=$item['SECTION_PAGE_URL']?>" class="medicine__link">
									<p>
										<?=$item['NAME']?>
									</p>
									<div class="svg categories-block__item-svg medicine__link__svg"></div>
								</a>
							</li>
						<?}?>
					</ul>
				<?}?>
			</div>
			<a href="/catalog/" class="reviews__href">
				<div class="svg reviews__href__svg"></div>
				<p class="reviews__href__text">Все категории</p>
			</a>
		</div>
		<div class="medicine__block">
			<h3 class="section__title">Заболевания</h3>
			<div class="medicine__grid">
				<ul class="medicine__ul">
					<?foreach ($arResult['DISEASE'] as $value) {?>
						<?if ($i == 16) echo '</ul><ul class="medicine__ul">';?>
						<li class="medicine__li">
							<a href="/catalog/lekarstva/?diseases=<?=$value['UF_XML_ID']?>" class="medicine__link">
								<p>
									<?=$value['UF_NAME']?>
								</p>
								<div class="svg categories-block__item-svg medicine__link__svg"></div>
							</a>
						</li>
					<?}?>
				</ul>
			</div>
			<a href="/disease/" class="reviews__href">
				<div class="svg reviews__href__svg"></div>
				<p class="reviews__href__text">ещё</p>
			</a>
		</div>
		<div class="medicine__block">
			<h3 class="section__title">хиты продаж</h3>
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
					"AREA_FILE_SHOW" => "file",
					"AREA_FILE_SUFFIX" => "inc",
					"EDIT_TEMPLATE" => "",
					"PATH" => "/local/include/hit.php"
				)
			);?>
		</div>
	</div>
</div>

<? // мобильное меню
$this->SetViewTarget('catalog_mobile');?>
  <ul class="header__catalogs__body">
		<?foreach ($arResult['MENU'] as $item) {?>
			<li class="header__catalog__li">
				<a href="<?=$item['SECTION_PAGE_URL']?>" class="header__catalog" data-submenu="<?=$item['ID']?>">
					<div class="svg header__catalog__svg header__catalog__svg-<?=$item['ID']?>"></div>
					<div class="header__catalog__text"><?=$item['NAME']?></div>
				</a>
			</li>
		<?}?>
		<li class="header__catalog__li">
			<a href="/catalog/" class="header__catalog">
				<div class="svg header__catalog__svg header__catalog__svg-10"></div>
				<div class="header__catalog__text">Весь каталог</div>
			</a>
		</li>
	</ul>
<?$this->EndViewTarget();?>
