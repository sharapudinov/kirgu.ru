<?php

namespace Redsign\Tuning;

use Bitrix\Main\Page\Asset;

class RadioOption extends TuningOption
{

	protected $name = 'radio';
	protected $description = 'Radio buttons';

	public function showOption($options = array()) {
        if ($options['VIEW'] == 'buttons') {
            $col = false;
        } else {
            $col = (!empty($options['GRID_SIZE_VALUE']) ? $options['GRID_SIZE_VALUE'] : 12);
        }

        $cssStyleClass = '';
        if (empty($options['VIEW']) && $options['SHOW_IMAGES'] == 'Y') {
            $options['VIEW'] = 'images';
        }
        switch ($options['VIEW']) {
            case 'images':
                $cssStyleClass = 'rstuning__option__radio__images';
                break;
            case 'buttons':
                $cssStyleClass = 'rstuning__option__radio__buttons';
                break;
        }
		?>
        <?php if (!empty($options['VALUES'])): ?>
<div class="rstuning__option rstuning-col-<?=$options['GRID_SIZE']?> <?=$options['CSS_CLASS']?> js-rs_option_info" data-reload="<?=($options['RELOAD'] == 'Y' ? 'Y' : 'N')?>">
    <div class="rstuning__option__radio <?=$cssStyleClass?>">
        <?php if($options['NAME']): ?>
			<div class="rstuning__option-opname"><?=$options['NAME']?></div>
        <?php endif; ?>
        <?=($col ? '<div class="rstuning-row">' : '')?>
        <?php foreach ($options['VALUES'] as $arValue): ?>
            <div class="rstuning__option__alone-radio<?=($col ? ' rstuning-col-'.$col : '')?>">
                <input <?
                    ?>class="with-gap" <?
                    ?>type="radio" <?
                    ?>id="<?=$arValue['CONTROL_ID']?>" <?
                    ?>name="<?=$options['CONTROL_NAME']?>" <?
                    ?>value="<?=$arValue['HTML_VALUE']?>" <?
                    ?><?=($arValue['HTML_VALUE'] == $options['VALUE'] ? 'checked="checked"' : '')?> <?
                    ?><?=$options['ATTR']?> <?
                    if (!empty($options['MACROS']) && $options['MACROS'] != '') {
                        ?>data-macros="<?=$options['MACROS']?>" <?
                    }
                ?>>
                <label for="<?=$arValue['CONTROL_ID']?>"><?
                    if ($options['HIDE_LABELS'] != 'Y') {
                        if ($options['VIEW'] == 'images') {
                            ?><span class="rstuning__option__radio-name"><?=$arValue['NAME']?></span><?
                        } else {
                            ?><span class="rstuning__option__radio-div rstuning__option__radio-overname"><span class="rstuning__option__radio-name"><?=$arValue['NAME']?></span></span><?
                        }
                    }
                    if ($options['VIEW'] == 'images') {
                        ?><span class="rstuning__option__radio-div rstuning__option__radio__image" title="<?=$arValue['NAME']?>"><?
                            ?><img src="<?=$arValue['IMAGE']?>" alt="" title=""><?
                        ?></span><?
                    }
                ?></label>
            </div>
        <?php endforeach; ?>
	    <?=($col ? '</div>' : '')?>
	</div>
</div>
        <?php endif; ?>
		<?
	}

    public function onload($options = array()) {
		$asset = Asset::getInstance();
		$asset->addCss('/bitrix/css/redsign.tuning/options/radio/style.css');
    }

}
