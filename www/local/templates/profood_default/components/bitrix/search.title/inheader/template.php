<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

// echo"<pre>";
// print_r($arParams);
// echo"</pre>";
$this->setFrameMode(true);

$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID) <= 0)
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if(strlen($CONTAINER_ID) <= 0)
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

$jsOpenser = $arParams['JS_OPENER'] == 'Y' || $arParams['JS_OPENER_MOBILE'] == 'Y' ? true : false;
$showSearchBar = $arParams['SHOW_SEARCHBAR'] == 'Y' || $arParams['JS_OPENER_MOBILE'] == 'Y' ? true : false;

$submitId = 'submit_search_title_'.$this->randString();
?>

<?php if ($arParams["SHOW_INPUT"] !== "N"): ?>

	<?php if ($showSearchBar): ?>
	<ul class="nav navbar-nav navbar-border-bottom navbar-right list-unstyled search-bar<?=($jsOpenser ? ' js-search-bar' : '')?><?=($arParams['JS_OPENER_MOBILE'] == 'Y' ? ' js-search-bar-mobile' : '')?>">
		<li>
			<span class="searchinhead__btn<?=($jsOpenser ? ' js-show-search-bar' : '')?>"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-search"></use></svg></span>
			<div class="search-open <?=($arParams['START_HIDDEN'] == 'Y' ? 'closed' : 'open')?><?=($jsOpenser == 'Y' ? ' js-search-open' : '')?><?=($arParams['JS_OPENER_MOBILE'] == 'Y' ? ' js-mobile' : '')?>"<?=($arParams['START_HIDDEN'] == 'Y' ? ' style="display: none;"' : '')?>>
	<?php endif; ?>

	<div id="<?=$CONTAINER_ID?>" class="searchinhead nowrap js-pseudo-focus-blur">
		<form class="js-form" action="<?=$arResult["FORM_ACTION"]?>" data-starthidden="<?=$arParams['START_HIDDEN']?>" data-showsearchbar="<?=$showSearchBar?>" data-window-width-jsopenser="<?=$arParams['WINDOW_WIDTH_MOBILE_OPENER_USE']?>">
			<div class="searchinhead__flex">
				<label class="searchinhead__flexbox searchinhead__zoom js-pseudo-border-top js-pseudo-border-bottom js-pseudo-border-left" for="<?=$submitId?>"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-search"></use></svg></label>
				<div class="searchinhead__flexbox searchinhead__aroundtext js-pseudo-border-top js-pseudo-border-bottom"><?
				?><input id="<?=$INPUT_ID?>" class="searchinhead__input js-pseudo-focus-blur-input" type="text" name="q" value="" size="40" maxlength="50" autocomplete="off" placeholder="<?=GetMessage("RSGOPRO_PLACEHOLDER")?>" /></div>
				<input class="nonep" type="submit" name="s" id="<?=$submitId?>" value="<?=GetMessage("RSGOPRO_BTN")?>" />
				<label class="searchinhead__flexbox searchinhead__enter" for="<?=$submitId?>"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-search"></use></svg></label>
			</div>
		</form>
	</div>

	<?php if ($showSearchBar): ?>
			</div>
		</li>
	</ul>
	<?php endif; ?>

<?php endif; ?>

<?php if (strpos($INPUT_ID, 'fly') < 1): ?>
<script>
	BX.ready(function(){
		new JCTitleSearch({
			'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
			'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
			'INPUT_ID': '<?echo $INPUT_ID?>',
			'MIN_QUERY_LEN': 2
		});
	});
</script>
<?php endif; ?>
