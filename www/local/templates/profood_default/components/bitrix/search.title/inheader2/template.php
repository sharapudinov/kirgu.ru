<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$this->setFrameMode(true);

$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID) <= 0)
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if(strlen($CONTAINER_ID) <= 0)
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);
?>

<?php if ($arParams["SHOW_INPUT"] !== "N"): ?>
	<!-- Search Block -->
	<ul class="nav navbar-nav navbar-border-bottom navbar-right list-unstyled search-bar">
		<li>
			<svg class="search-btn enter svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-search"></use></svg>
			<div class="search-open closed">
				<div id="<?=$CONTAINER_ID?>" class="searchinhead nowrap">
					<form action="<?=$arResult["FORM_ACTION"]?>">
						<a class="search-a-close" href="#"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-close-button"></use></svg></a>
						<label class="zoom" for="submit_search_title"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-enter-arrow"></use></svg></label>
						<label class="enter" for="submit_search_title"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-search"></use></svg></label>
						<div class="aroundtext"><input class="text" id="<?=$INPUT_ID?>" type="text" name="q" value="" size="40" maxlength="50" autocomplete="off" placeholder="<?=GetMessage("RSGOPRO_PLACEHOLDER")?>" /></div>
						<input class="nonep" type="submit" name="s" id="submit_search_title" value="<?=GetMessage("RSGOPRO_BTN")?>" />
					</form>
				</div>
			</div>
		</li>
	</ul>

	<script type="text/javascript">
	var jsControl_<?=md5($CONTAINER_ID)?> = new JCTitleSearch({
		'AJAX_PAGE' : '<?=CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
		'CONTAINER_ID': '<?=$CONTAINER_ID?>',
		'INPUT_ID': '<?=$INPUT_ID?>',
		'MIN_QUERY_LEN': 3
	});
	</script>
<?php endif; ?>
<!-- End Search Block -->
