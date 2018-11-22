<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

?><div class="rsec_thistab_basket"><?
	$normalCount = IntVal(count($arResult['ITEMS']['AnDelCanBuy']));

	if (strlen($arResult['ERROR_MESSAGE']) <= 0 && $normalCount > 0) {
		?><form method="post" action="<?=POST_FORM_ACTION_URI?>" name="basket_form"><?
			include($_SERVER['DOCUMENT_ROOT'].$templateFolder.'/basket_items.php');
			?><input type="hidden" name="BasketRefresh" value="BasketRefresh" /><?
		?></form><?
	} else {
		?><div class="rsec_emptytab rsec_clearfix"><?
			?><div class="rsec_emptytab_icon"><?=$arResult['ERROR_MESSAGE']?></div><?
		?></div><?
	}
?></div>
