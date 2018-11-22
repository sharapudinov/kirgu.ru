<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$svgStar = '<svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-star"></use></svg>';
?>

<div id="detailreviews" class="detailreviews">
<?php if (intval($arResult['NAV_RESULT']->NavRecordCount) > 0): ?>
<script type="text/javascript">
$(document).ready(function() {
	$('.js-detailelement-review-count').html(<?=intval($arResult['NAV_RESULT']->NavRecordCount)?>);
});
</script>
<?php endif; ?>

	<!-- ERRORS -->
	<?php if (!empty($arResult['ERROR_MESSAGE'])): ?>
		<div class="contentinner"><?=ShowError($arResult['ERROR_MESSAGE']);?></div>
	<?php endif; ?>

	<!-- FORM -->
	<div class="contentinner"><?
		include(__DIR__."/form.php");
	?></div>

	<!-- MESSAGES -->
	<?php
	if (!empty($arResult['MESSAGES'])) {
		?><div class="b-reviews"><?
			// NAV
			if($arResult['NAV_RESULT'] && $arResult['NAV_RESULT']->NavPageCount > 1)
			{
				?><?=$arResult['NAV_STRING']?><?
			}

			foreach ($arResult['MESSAGES'] as $arMessage): ?>
				<div class="b-review" id="message<?=$arMessage['ID']?>">

					<div class="b-review__head">
						<div class="row">
							<div class="col-xs-2 col-sm-2 col-md-1 col-lg-1 hidden-xs"><?
								?><div class="b-review__icon"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-reviews-user"></use></svg></div><?
							?></div>
							<div class="col-xs-12 col-sm-10 col-md-11 col-lg-11"><?
								?><div class="b-review__name-date-rating"><?
									?><span class="b-review__name"><?=$arMessage['AUTHOR_NAME']?></span><?
									?><span class="b-review__date"><?=$arMessage['POST_DATE_EXT']?></span><?
									?><span class="b-review__rating"><?php
									// RATING
									if ($arMessage['POST_MESSAGE_TEXT_EXT']['RATING'] > 0) {
										for ($i = 1; $i < 6; $i++) {
											if ($i <= $arMessage['POST_MESSAGE_TEXT_EXT']['RATING']) {
												?><span class="b-review__star active"><?=$svgStar;?></span><?
											} else {
												?><span class="b-review__star"><?=$svgStar;?></span><?
											}
										}
									}
									?></span><?
								?></div><?
							?></div>
						</div>
					</div>

					<div class="b-review__data">
						<div class="row">
							<div class="col-xs-12 col-sm-10 col-md-9 col-lg-9 col-sm-offset-2 col-md-offset-1 col-lg-offset-1">
								<?php if (!empty($arMessage['POST_MESSAGE_TEXT_EXT']['PLUS'])): ?>
								<div class="b-review__text b-review__dignity"><?
									?><span class="b-review__message-name"><?=Loc::getMessage('POST_MSG_TEXT_PLUS')?>:</span><?
									?><span class="b-review__message-value"><?=$arMessage['POST_MESSAGE_TEXT_EXT']['PLUS']?></span><?
								?></div>
								<?php endif; ?>
								<?php if (!empty($arMessage['POST_MESSAGE_TEXT_EXT']['MINUS'])): ?>
								<div class="b-review__text b-review__limitations"><?
									?><span class="b-review__message-name"><?=Loc::getMessage('POST_MSG_TEXT_MINUS')?>:</span><?
									?><span class="b-review__message-value"><?=$arMessage['POST_MESSAGE_TEXT_EXT']['MINUS']?></span><?
								?></div>
								<?php endif; ?>
								<div class="b-review__text b-review__comment"><?
									?><span class="b-review__message-name"><?=Loc::getMessage('POST_MSG_TEXT_COMMENT')?>:</span><?
									?><span class="b-review__message-value"><?=$arMessage['POST_MESSAGE_TEXT_EXT']['COMMENT']?></span><?
								?></div>
								<?php if ($arResult['PANELS']['MODERATE'] == 'Y' || $arResult['PANELS']['DELETE'] == 'Y'): ?>
								<div class="b-review__moderate">
									<?php
									if ($arResult['PANELS']['MODERATE'] == 'Y') {
										?><a rel="nofollow" href="<?=$arMessage['URL']['MODERATE']?>#postform"><?=Loc::getMessage((($arMessage['APPROVED'] == 'Y') ? 'F_HIDE' : 'F_SHOW'))?></a><?
										if ($arResult['PANELS']['DELETE'] == 'Y') { ?> &nbsp; | &nbsp; <? }
									}
									if ($arResult['PANELS']['DELETE'] == 'Y') {
										?><a rel="nofollow" href="<?=$arMessage['URL']['DELETE']?>#postform"><?=Loc::getMessage('F_DELETE')?></a><?
									}
									?>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</div>

				</div>
			<?php endforeach;
			
			// REVIEW
			/*
			foreach($arResult['MESSAGES'] as $arMessage)
			{
				?><div class="b-reviews__message" id="message<?=$arMessage['ID']?>"><?
					?><div class="b-reviews__message-head clearfix"><?
						?><div class="name"><?
							?><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-reviews-user"></use></svg><?
							?><?=$arMessage['AUTHOR_NAME']?><?
						?></div><?
						?><div class="date"><?=$arMessage['POST_DATE_EXT']?></div><?
					?></div><?
					?><div class="contentinner"><?
						?><div class="line rating"><? // RATING
							if($arMessage['POST_MESSAGE_TEXT_EXT']['RATING']>0)
							{
								for($i=1;$i<6;$i++)
								{
									?><i class="icon pngicons<?if($i<=$arMessage['POST_MESSAGE_TEXT_EXT']['RATING']):?> active<?endif;?>"></i><?
								}
							}
						?></div><?
						if( isset($arMessage['POST_MESSAGE_TEXT_EXT']['PLUS']) && $arMessage['POST_MESSAGE_TEXT_EXT']['PLUS']!='' )
						{
							?><div class="line"><? // PLUS
								?><div class="part"><?=GetMessage('POST_MSG_TEXT_PLUS')?>:</div><?
								?><?=$arMessage['POST_MESSAGE_TEXT_EXT']['PLUS']?><?
							?></div><?
						}
						if( isset($arMessage['POST_MESSAGE_TEXT_EXT']['MINUS']) && $arMessage['POST_MESSAGE_TEXT_EXT']['MINUS']!='' )
						{
							?><div class="line"><? // MINUS
								?><div class="part"><?=GetMessage('POST_MSG_TEXT_MINUS')?>:</div><?
								?><?=$arMessage['POST_MESSAGE_TEXT_EXT']['MINUS']?><?
							?></div><?
						}
						?><div class="line"><? // COMMENT
							?><?=$arMessage['POST_MESSAGE_TEXT_EXT']['COMMENT']?><?
						?></div><?
						// moderator panel
						if ($arResult['PANELS']['MODERATE']=='Y' || $arResult['PANELS']['DELETE']=='Y')
						{
							?><div class="line"><?
								if ($arResult['PANELS']['MODERATE']=='Y')
								{
									?><a rel="nofollow" href="<?=$arMessage['URL']['MODERATE']?>#postform"><?=GetMessage((($arMessage['APPROVED'] == 'Y') ? 'F_HIDE' : 'F_SHOW'))?></a><?
									if ($arResult['PANELS']['DELETE']=='Y') { ?> &nbsp; | &nbsp; <? }
								}
								if ($arResult['PANELS']['DELETE']=='Y')
								{
									?><a rel="nofollow" href="<?=$arMessage['URL']['DELETE']?>#postform"><?=GetMessage('F_DELETE')?></a><?
								}
							?></div><?
						}
					?></div><?
				?></div><?
			}
			*/

		?></div><?
	} else {
		?><div class="errortext"><?=GetMessage('NO_MESSAGES')?></div><?
		?><script>
		$('#detailreviews').find('.js-reviewform').removeClass('hide');
		</script><?
	}
	
?></div><?
