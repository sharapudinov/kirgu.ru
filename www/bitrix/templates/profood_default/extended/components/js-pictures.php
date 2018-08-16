<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application;

$request = Application::getInstance()->getContext()->getRequest();
$protocol = \Bitrix\Main\Context::getCurrent()->getRequest()->isHttps() ? "https://" : "http://";

$arPictures = array();

$params = array(
    'PAGE' => ($params['PAGE'] == 'list' ? 'list' : 'detail'),
);

if ($haveOffers && !empty($arItem['OFFERS'])) {
    foreach ($arItem['OFFERS'] as $arOffer) {
        $arPictures[$arOffer['ID']] = array();

        if ($params['PAGE'] == 'detail') {
            if (is_array($arOffer['DETAIL_PICTURE']['RESIZE'])) {
                $arPictures[$arOffer['ID']][] = array(
                    'SRC' => $arOffer['DETAIL_PICTURE']['RESIZE']['src'],
                    'ALT' => (!empty($arOffer['DETAIL_PICTURE']['ALT']) ? $arOffer['DETAIL_PICTURE']['ALT'] : ''),
                    'TITLE' => (!empty($arOffer['DETAIL_PICTURE']['TITLE']) ? $arOffer['DETAIL_PICTURE']['TITLE'] : ''),
                    'SRC_ORIGINAL' => $arOffer['DETAIL_PICTURE']['SRC'],
                );
                if (empty($templateData['imageOgOffer'])) {
                    $templateData['imageOgOffer'] = $protocol.SITE_SERVER_NAME.$arOffer['DETAIL_PICTURE']['SRC'];
                }
            }
        } else {
            if (is_array($arOffer['PREVIEW_PICTURE']['RESIZE'])) {
                $arPictures[$arOffer['ID']][] = array(
                    'SRC' => $arOffer['PREVIEW_PICTURE']['RESIZE']['src'],
                    'ALT' => (!empty($arOffer['PREVIEW_PICTURE']['ALT']) ? $arOffer['PREVIEW_PICTURE']['ALT'] : ''),
                    'TITLE' => (!empty($arOffer['PREVIEW_PICTURE']['TITLE']) ? $arOffer['PREVIEW_PICTURE']['TITLE'] : ''),
                    'SRC_ORIGINAL' => $arOffer['PREVIEW_PICTURE']['SRC'],
                );
            }
        }
        if (is_array($arOffer['PROPERTIES'][$arParams['PROP_SKU_MORE_PHOTO']]['VALUE'][0]['RESIZE'])) {
            foreach ($arOffer['PROPERTIES'][$arParams['PROP_SKU_MORE_PHOTO']]['VALUE'] as $arImage) {
                $arPictures[$arOffer['ID']][] = array(
                    'SRC' => $arImage['RESIZE']['src'],
                    'ALT' => (!empty($arOffer['NAME']) ? $arOffer['NAME'] : ''),
                    'TITLE' => (!empty($arOffer['NAME']) ? $arOffer['NAME'] : ''),
                    'SRC_ORIGINAL' => $arImage['SRC'],
                );
            }
            if ($params['PAGE'] == 'detail' && empty($templateData['imageOgOffer'])) {
                $templateData['imageOgOffer'] = $protocol.SITE_SERVER_NAME.$arOffer['PROPERTIES'][$arParams['PROP_SKU_MORE_PHOTO']]['VALUE'][0]['SRC'];
            }
        }
    }
}

// get _$strAlt_ and _$strTitle_
include(EXTENDED_PATH.'/img_alt_title.php');

$arPictures[$arItem['ID']] = array();
if ($params['PAGE'] == 'detail') {
    if (is_array($arItem['DETAIL_PICTURE']['RESIZE'])) {
        $arPictures[$arItem['ID']][] = array(
            'SRC' => $arItem['DETAIL_PICTURE']['RESIZE']['src'],
            'ALT' => (!empty($strAlt) ? $strAlt : ''),
            'TITLE' => (!empty($strTitle) ? $strTitle : ''),
            'SRC_ORIGINAL' => $arItem['DETAIL_PICTURE']['SRC'],
        );
        $templateData['imageOg'] = $protocol.SITE_SERVER_NAME.$arItem['DETAIL_PICTURE']['SRC'];
    }
} else {
    if (is_array($arItem['PREVIEW_PICTURE']['RESIZE'])) {
        $arPictures[$arItem['ID']][] = array(
            'SRC' => $arItem['PREVIEW_PICTURE']['RESIZE']['src'],
            'ALT' => (!empty($strAlt) ? $strAlt : ''),
            'TITLE' => (!empty($strTitle) ? $strTitle : ''),
            'SRC_ORIGINAL' => $arItem['PREVIEW_PICTURE']['SRC'],
        );
    }
}
if (is_array($arItem['PROPERTIES'][$arParams['PROP_MORE_PHOTO']]['VALUE'][0]['RESIZE'])) {
    foreach ($arItem['PROPERTIES'][$arParams['PROP_MORE_PHOTO']]['VALUE'] as $arImage) {
        $arPictures[$arItem['ID']][] = array(
            'SRC' => $arImage['RESIZE']['src'],
            'ALT' => (!empty($strAlt) ? $strAlt : ''),
            'TITLE' => (!empty($strTitle) ? $strTitle : ''),
            'SRC_ORIGINAL' => $arImage['SRC'],
        );
    }
    if ($params['PAGE'] == 'detail' && empty($templateData['imageOg'])) {
        $templateData['imageOg'] = $protocol.SITE_SERVER_NAME.$arItem['PROPERTIES'][$arParams['PROP_MORE_PHOTO']]['VALUE'][0]['SRC'];
    }
}

?>
<script type="text/javascript">
RSGoPro_Pictures[<?=$arItem['ID']?>] = <?=CUtil::PhpToJSObject($arPictures)?>;
</script>
