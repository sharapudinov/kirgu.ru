<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application;
?>

<?php if ($arParams['USE_DELIVERY_COST_BLOCK'] == 'Y' || $arParams['USE_DELIVERY_COST_TAB'] == 'Y'): ?>
<!-- delivery cost -->
<div class="detail__delivery-cost hidden-print">
<?$APPLICATION->IncludeComponent(
    "redsign:delivery.calculator",
    "block",
    array(
        "CURRENCY" => $arParams['DELIVERY_CURRENCY_ID'],
        "ELEMENT_ID" => $product['ID'],
        "QUANTITY" => isset($arResult['QUANTITY']) ? $arResult['QUANTITY'] : 1,
        "DELIVERY" => array(),
        "BLOCK_DELIVERY" => $arParams['USE_DELIVERY_COST_BLOCK'],
        "TAB_DELIVERY" => $arParams['USE_DELIVERY_COST_TAB'],
        "DELIVERY_COST_PAY_LINK" => $arParams['DELIVERY_COST_PAY_LINK'],
        "DELIVERY_COST_DELIVERY_LINK" => $arParams['DELIVERY_COST_DELIVERY_LINK'],
    ),
    $component,
    array('HIDE_ICONS' => 'Y')
);?>
</div>
<!-- /delivery cost -->
<?php endif; ?>
