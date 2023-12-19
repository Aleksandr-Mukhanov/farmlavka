<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if (empty($arResult)) return "";

$strReturn = '';

$strReturn .= '<div class="page-titles__body" itemscope itemtype="http://schema.org/BreadcrumbList">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$arrow = ($index > 0) ? 'page-titles__svg-2' : 'page-titles__svg-1';

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '
			<div id="bx_breadcrumb_'.$index.'" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="item" class="page-titles__link active">
					<div class="svg page-titles__svg '.$arrow.'"></div>
					<p class="page-titles_text" itemprop="name">'.$title.'</p>
					<meta itemprop="position" content="'.($index + 1).'" />
				</a>
			</div>';
	}
	else
	{
		$strReturn .= '
			<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" class="page-titles__link">
				<div class="svg page-titles__svg '.$arrow.'"></div>
				<p class="page-titles_text">'.$title.'</p>
			</a>';
	}
}

$strReturn .= '</div>';

return $strReturn;

?>
