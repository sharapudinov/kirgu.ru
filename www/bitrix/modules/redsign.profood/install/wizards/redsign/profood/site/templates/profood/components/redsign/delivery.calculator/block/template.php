 <?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
$prefix = $arParams['PREFIX'];

$arJSONResult = array();

?>

<?php if ($arParams['AJAX_CALL'] != 'Y'): ?>
<?php
    $arAjaxParams = array(
        'templateName' => $this->GetName(),
        'siteId' => SITE_ID,
        'arParams' => $arResult['ORIGINAL_PARAMS'],
    );
    $ajaxPath = $templateFolder.'/ajax.php';
?>
<script>

BX.addCustomEvent('rs_delivery_update', function(productId, quantity, beforeFn, afterFn) {
    var params = <?=CUtil::PhpToJSObject($arAjaxParams); ?>;
    params.arParams.ELEMENT_ID = productId || params.arParams.ELEMENT_ID;
    params.arParams.QUANTITY = quantity || params.arParams.QUANTITY;
    beforeFn = beforeFn || function() {};
    afterFn = afterFn || function() {};

    beforeFn();

    BX.ajax.post('<?=$ajaxPath?>', params, function(result) {
        var json = BX.parseJSON(result);
        afterFn();
        var deliveryBlock = BX("<?=$prefix?>delivery_block");
        var deliveryTab = BX("delivery-tab");

        if (deliveryBlock && json['SIMPLE']) {
            deliveryBlock.innerHTML = json['SIMPLE'];

            deliveryList = BX("<?=$prefix?>delivery_block_list");
            deliveryList.parentElement.style.height = (deliveryList.offsetHeight + 25) + 'px';
            deliveryList.style.left = '0px';

            setTimeout(function() {
                deliveryList.style.position = 'static';
                deliveryList.parentElement.style.height = 'auto';
            }, 600);
        }

        if (deliveryTab && json['EXTENDED']) {
            deliveryTab.innerHTML = json['EXTENDED'];
        }

    });
});
BX.onCustomEvent('rs_delivery_update');

</script>
<?php elseif ($arParams['AJAX_CALL'] == 'Y'): ?>
    <?php $APPLICATION->RestartBuffer(); ?>
    <?php if ($arParams['BLOCK_DELIVERY'] == 'Y'): ?>
        <?php ob_start(); ?>
        <div class="product-delivery__title">
            <?=Loc::getMessage('RSDC_TEMPLATE_DELIVERY'); ?>
            <?php
                if (isset($arResult['LOCATION_TO']['LOCATION_NAME'])) {
                    echo Loc::getMessage('RSDC_TEMPLATE_DELIVERY_IN_CITY').' '.$arResult['LOCATION_TO']['LOCATION_NAME'].': ';
                }
            ?>
        </div>
        <?php if (count($arResult['DELIVERIES']) > 0): ?>
            <ul class="product-delivery__list" id="<?=$prefix?>delivery_block_list" style="position: absolute; left: -9999999px;">
            <?php foreach ($arResult['DELIVERIES'] as $arDelivery): ?>
                <?php if ($arDelivery['CALCULATION']['IS_SUCCESS']): ?>
                    <li><?
                    ?><span class="product-delivery__name"><?=$arDelivery['NAME']?>: </span><?=$arDelivery['CALCULATION']['FORMAT_PRICE'] ?><?
                    ?><?php if ($arDelivery['CALCULATION']['PERIOD']): ?><?
                        ?>(<?=$arDelivery['CALCULATION']['PERIOD']?>)<?
                    ?><?php endif; ?><?
                    ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php if ($arParams['DELIVERY_COST_PAY_LINK'] != '' || $arParams['DELIVERY_COST_DELIVERY_LINK'] != ''):?>
                <li class="product-delivery__information">
                    <br>
                    <?=Loc::getMessage('RSDC_TEMPLATE_LINKS_PRE')?>
                    <?php if ($arParams['DELIVERY_COST_DELIVERY_LINK'] != ''):?>
                        <?=Loc::getMessage('RSDC_TEMPLATE_LINKS_DELIVERY', array('#DELIVERY_LINK#' => $arParams['DELIVERY_COST_DELIVERY_LINK']))?>
                    <?php endif; ?>
                    <?php if ($arParams['DELIVERY_COST_PAY_LINK'] != '' && $arParams['DELIVERY_COST_DELIVERY_LINK'] != ''):?>
                        <?=Loc::getMessage('RSDC_TEMPLATE_LINKS_AND')?>
                    <?php endif; ?>
                    <?php if ($arParams['DELIVERY_COST_PAY_LINK'] != ''):?>
                        <?=Loc::getMessage('RSDC_TEMPLATE_LINKS_PAYMENT', array('#PAYMENT_LINK#' => $arParams['DELIVERY_COST_PAY_LINK']))?>
                    <?php endif; ?>
                </li>
            <?php endif; ?>
            </ul>
        <?php else: ?>
            <?=Loc::getMessage('RSDC_TEMPLATE_DELIVERY_NOT_FOUND'); ?>
        <?php endif; ?>
        <?php $arJSONResult['SIMPLE'] = ob_get_clean(); ?>
    <?php endif; ?>

    <?php if ($arParams['TAB_DELIVERY'] == 'Y' && count($arResult['DELIVERIES']) > 0): ?>
        <?php ob_start(); ?>
        <div class="row p-delivery is-cart">
            <div class="col col-sm-12 col-md-9">
                <div class="p-delivery__table-wrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="2"><?=Loc::getMessage('RSDC_TEMPLATE_DELIVERY_SERVICE')?></th>
                                <th><?=Loc::getMessage('RSDC_TEMPLATE_DELIVERY_COST')?></th>
                                <th><?=Loc::getMessage('RSDC_TEMPLATE_DELIVERY_TIME')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($arResult['DELIVERIES'] as $arDelivery):?>
                                <?php if ($arDelivery['CALCULATION']['IS_SUCCESS']): ?>
                                    <tr>
                                        <td class="p-delivery__picture text-center">
                                            <?php if(strlen($arDelivery['PICTURE_PATH']) > 0): ?>
                                                <img src="<?=$arDelivery['PICTURE_PATH']?>" alt="<?=$arDelivery['NAME']?>" src="<?=$arDelivery['NAME']?>">
                                            <?php else: ?>
                                                <img src="<?=$templateFolder.'/images/no-image.png'?>" alt="<?=$arDelivery['NAME']?>" src="<?=$arDelivery['NAME']?>">
                                            <?php endif; ?>
                                        </td>
                                        <td><?=$arDelivery['NAME']?></td>
                                        <td class="text-center price new"><?=$arDelivery['CALCULATION']['FORMAT_PRICE']?></td>
                                        <td class="text-center"><?=$arDelivery['CALCULATION']['PERIOD']?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php
    $arJSONResult['EXTENDED'] = ob_get_clean();
    endif;
    ?>

    <?php  echo CUtil::PhpToJSObject($arJSONResult); ?>
    <?php die(); ?>
<?php endif; ?>

<?php if ($arParams['BLOCK_DELIVERY'] == 'Y'): ?>
<div class="product-delivery media">
    <div class="media-left product-delivery__pic hidden-xs">
        <img src="<?=SITE_TEMPLATE_PATH?>/assets/img/delivery.png" alt="" title="">
    </div>
    <div class="media-body product-delivery__body">
        <?php if ($arParams['AJAX_CALL'] != 'Y'): ?>
            <div id="<?=$prefix?>delivery_block" class="product-delivery__block">
                <div class="product-delivery__title"><?=Loc::getMessage('RSDC_TEMPLATE_DELIVERY'); ?></div>
                <ul class="product-delivery__list">
                    <li><?=Loc::getMessage('RSDC_TEMPLATE_LOADING'); ?></li>
                </ul>
            </div>
        <?php endif; ?>

    </div>
</div>
<?php endif; ?>
