<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

if ($arParams['USE_RATING'] != 'Y')
    return;

if (empty($arParams['RATING_PROP_COUNT']) || empty($arParams['RATING_PROP_SUM']))
    return;

$count = intVal($arItem['PROPERTIES'][$arParams['RATING_PROP_COUNT']]['VALUE']);
if ($count < 1)
    return;

$sum = intVal($arItem['PROPERTIES'][$arParams['RATING_PROP_SUM']]['VALUE']);
$rating = round($sum/$count, 0);
$max = 5;
?>

<span class="c-rating js-rating" data-count="<?=$count?>" data-sum="<?=$sum?>" data-rating="<?=$rating?>">
    <?php for ($i = 0; $i < $max; $i++): ?>
        <span class="c-rating__star<?=($i < $rating ? ' active' : '')?>" data-><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-rating"></use></svg></span>
    <?php endfor; ?>
    <span class="c-rating__count"><?=$count?></span>
</span>
