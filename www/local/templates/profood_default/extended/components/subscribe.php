<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

if (!$showSubscribeBtn)
    return;
?>

<?php $APPLICATION->includeComponent('bitrix:catalog.product.subscribe', 'gopro',
    array(
        'PRODUCT_ID' => $product['ID'],
        'BUTTON_ID' => $strMainID.'_subscribe_link',
        'BUTTON_CLASS' => 'b-pay__button b-pay__add2subscribe js-product-subscribe btn-default',
        'DEFAULT_DISPLAY' => true,
    ),
    $component,
    array('HIDE_ICONS' => 'Y')
);?>
