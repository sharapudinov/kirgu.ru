<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$this->setFrameMode(true);
?>

<!-- grupped properties -->
<div class="c-gruppedprops">
	<div class="row">
	<?php foreach ($arResult['GROUPED_ITEMS'] as $arrValue): ?>
		<?php if (is_array($arrValue['PROPERTIES']) && count($arrValue['PROPERTIES']) > 0): ?>
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
			<div class="c-gruppedprops__group">
				<div class="c-gruppedprops__group-name"><?=$arrValue["GROUP"]["NAME"]?></div>
				<div class="c-gruppedprops__group-props"><?
				?><?php foreach ($arrValue['PROPERTIES'] as $property): ?><?
					?><span class="c-gruppedprops__prop"><?
						?><span class="c-gruppedprops__prop-name"><?=$property["NAME"]?>:</span><?
						?><span class="c-gruppedprops__prop-value"><?
						?><?php if (is_array($property['DISPLAY_VALUE'])): ?><?
							?><?=implode('&nbsp;/&nbsp;', $property["DISPLAY_VALUE"] )?><?
						?><?php else: ?><?
							?><?=$property["DISPLAY_VALUE"]?><?
						?><?php endif; ?><?
						?></span><?
					?></span><?
					?><?php endforeach; ?><?
				?></div>
			</div>
		</div>
		<?php endif; ?>
	<?php endforeach; ?>
	
	<?php if (is_array($arResult['NOT_GROUPED_ITEMS']) && count($arResult['NOT_GROUPED_ITEMS']) > 0): ?>
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
			<div class="c-gruppedprops__group">
				<div class="c-gruppedprops__group-props"><?
				?><?php foreach ($arResult['NOT_GROUPED_ITEMS'] as $property): ?><?
					?><span class="c-gruppedprops__prop"><?
						?><span class="c-gruppedprops__prop-name"><?=$property["NAME"]?>:</span><?
						?><span class="c-gruppedprops__prop-value"><?
						?><?php if (is_array($property['DISPLAY_VALUE'])): ?><?
							?><?=implode('&nbsp;/&nbsp;', $property["DISPLAY_VALUE"] )?><?
						?><?php else: ?><?
							?><?=$property["DISPLAY_VALUE"]?><?
						?><?php endif; ?><?
						?></span><?
					?></span><?
				?><?php endforeach; ?><?
				?></div>
			</div>
		</div>
	<?php endif; ?>
	</div>
</div>
<!-- /grupped properties -->
