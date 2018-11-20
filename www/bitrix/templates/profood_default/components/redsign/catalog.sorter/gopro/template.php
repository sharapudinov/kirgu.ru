<?php
if (!defined('B_PROLOG_INCLUDED')||B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>

<div class="b-sorter js-sorter clearfix" <?php if (isset($arParams['AJAXPAGESID']) && $arParams['AJAXPAGESID'] != ''): ?> data-ajaxpagesid="<?=$arParams['AJAXPAGESID']?>"<?php endif; ?>>

    <?php
	$frame = $this->createFrame('composite_sorter', false)->begin();
	$frame->setBrowserStorage(true);
    ?>

	<?php if ($arParams['ALFA_CHOSE_TEMPLATES_SHOW'] == 'Y' && is_array($arResult['CTEMPLATE']) && count($arResult['CTEMPLATE']) > 1): ?>
		<div class="b-sorter__template hidden-print">
			<?php foreach ($arResult['CTEMPLATE'] as $template): ?>
				<a class="<?=($template['USING'] == 'Y' ? "selected " : "")?>js-sorter__a"<?
                    ?> href="<?=$template['URL']?>" data-fvalue="<?=CUtil::JSEscape($template['VALUE'])?>" title="<?=($template['NAME_LANG'] != '' ? $template['NAME_LANG'] : $template['VALUE']);
                    ?>"><?
                    ?><svg class="svg-icon icon-<?=$template['VALUE']?>"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-view-<?=$template['VALUE']?>"></use></svg><?
                    ?><span><?=($template['NAME_LANG'] != '' ? $template['NAME_LANG'] : $template['VALUE'])?></span><?
                ?></a>
			<?php endforeach; ?>
		</div>
	<?php endif;?>

    <?php if (!empty($arParams['BLOCK_NAME'])): ?>
        <div class="b-sorter__block-name"><?=$arParams['BLOCK_NAME']?></div>
    <?php endif; ?>
    
	<?php if ($arParams['ALFA_SORT_BY_SHOW'] == 'Y' && is_array($arResult['CSORTING']) && count($arResult['CSORTING']) > 1): ?>
        <div class="b-sorter__sortaou hidden-print">
            <div class="b-sorter__<?if($arParams['ALFA_SHORT_SORTER']=='Y'):?>shortsort js-sorter__shortsort<?else:?>sort js-sorter__sort<?endif;?>">
                <div class="cool">
                    <div class="b-sorter__title"><?=GetMessage('MSG_SORT')?></div>
                    <?php if ($arParams['ALFA_SHORT_SORTER'] == 'Y'): ?>
                        <?php
                        $arrUsed = array();
                        ?>
                        <?php foreach ($arResult['CSORTING'] as $sort): ?>
                            <?php 
                            if ('' == $sort['GROUP'] || in_array($sort['GROUP'], $arrUsed) || $sort['VALUE'] == $arResult['USING']['CSORTING']['ARRAY']['VALUE']){
                                continue;
                            }
                            ?>
                            <span class="b-sorter__drop"></span>
                            <?php if ($arResult['USING']['CSORTING']['ARRAY']['GROUP'] == $sort['GROUP']): ?>
                                <a class="selected js-sorter__a" href="<?=$sort['URL']?>" data-url1="<?=$sort['URL']?>" data-url2="<?=$sort['URL2']?>"><?
                                    ?><span class="nowrap"><?=GetMessage('CSORTING_'.$arResult['USING']['CSORTING']['ARRAY']['GROUP']);?><?
                                        ?><svg class="svg-icon <?=$arResult['USING']['CSORTING']['ARRAY']['DIRECTION'];?>"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arrow-linear-down"></use></svg><?
                                    ?></span><?
                                ?></a>
                            <?php else: ?>
                                <a class="js-sorter__a" href="<?=$sort['URL']?>" data-url1="<?=$sort['URL']?>" data-url2="<?=$sort['URL2']?>"><span class="nowrap"><?=GetMessage('CSORTING_'.$sort['GROUP']); ?><?
                                    ?><svg class="svg-icon <?=$sort['DIRECTION'];?>"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arrow-linear-down"></use></svg><?
                                ?></span></a>
                            <?php endif;?>
                            <?php
                            $arrUsed[] = $sort['GROUP'];
                            ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="b-sorter__dropdown js-sorter__dropdown">
                            <a class="select" href="#"><span class="nowrap"><?=GetMessage('CSORTING_'.$arResult['USING']['CSORTING']['ARRAY']['GROUP']);?><?
                                ?><svg class="svg-icon <?=$arResult['USING']['CSORTING']['ARRAY']['DIRECTION'];?>"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arrow-linear-down"></use></svg><?
                            ?></span></a>
                            <div class="b-sorter__dropdown-in">
                                <?php foreach ($arResult['CSORTING'] as $sort): ?>
                                    <a class="<?=($sort['USING'] == 'Y' ? "selected " : "")?>js-sorter__a" href="<?=$sort['URL']?>"><span class="nowrap"><?=GetMessage('CSORTING_'.$sort['GROUP'])?><?
                                        ?><svg class="svg-icon <?=$sort['DIRECTION'];?>"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arrow-linear-down"></use></svg><?
                                    ?></span></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    <?php endif;?>
    
    <?php $this->SetViewTarget('catalog_sorter_output_of_show'); ?>
    <div class="b-sorter js-sorter hidden-print" <?if(isset($arParams['AJAXPAGESID']) && $arParams['AJAXPAGESID']!=''):?> data-ajaxpagesid="<?=$arParams['AJAXPAGESID']?>"<?endif;?>>
        <div class="b-sorter__sortaou">
            <?php if ($arParams['ALFA_OUTPUT_OF_SHOW'] == 'Y' && is_array($arResult['COUTPUT']) && count($arResult['COUTPUT']) > 1): ?>
                <div class="b-sorter__output">
                    <div class="cool">
                        <div class="b-sorter__title"><?=GetMessage('MSG_OUTPUT')?></div>
                        <div class="b-sorter__dropdown js-sorter__dropdown">
                            <a class="select" href="#"><?
                            ?><?=$arResult['USING']['COUTPUT']['ARRAY']['NAME_LANG']?><?
                                ?><svg class="svg-icon rotate"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arrow-linear-down"></use></svg><?
                            ?></a><?
                            ?><div class="b-sorter__dropdown-in">
                                <?php foreach ($arResult['COUTPUT'] as $output): ?>
                                    <a class="<?=($output['USING'] == 'Y' ? "selected " : "")?>js-sorter__a" href="<?=$output['URL']?>"><?=($output['NAME_LANG']!=''?$output['NAME_LANG']:$output['VALUE'])?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif;?>
        </div>
    </div>
    <?php $this->EndViewTarget(); ?>
    
	<?php $frame->end(); ?>
    
</div>
