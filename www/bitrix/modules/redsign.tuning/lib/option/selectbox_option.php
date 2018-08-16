<?php

namespace Redsign\Tuning;

use Bitrix\Main\Page\Asset;

class SelectboxOption extends TuningOption
{

	protected $name = 'selectbox';
	protected $description = 'Selectbox control';

	public function showOption($options = array()) {
		$svgArrow = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129"><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"></path></svg>';
		?>
		<?php if (empty($options['VALUES'])) 
			return;
		?>
<div class="rstuning__option rstuning-col-<?=$options['GRID_SIZE']?> <?=$options['CSS_CLASS']?> js-rs_option_info" data-reload="<?=($options['RELOAD'] == 'Y' ? 'Y' : 'N')?>">
	<div class="rstuning__selectbox">
		<?php if ($options['NAME']): ?>
			<span class="rstuning__selectbox-name"><?=$options['NAME']?></span>
		<?php endif; ?>
		<input <?
			?>type="text" <?
			?>id="<?=$options['CONTROL_ID']?>" <?
			?>name="<?=$options['CONTROL_NAME']?>" <?
			?>value="<?=$options['VALUE']?>" <?
			?><?=$options['ATTR']?> <?
			if (!empty($options['MACROS']) && $options['MACROS'] != '') {
				?>data-macros="<?=$options['MACROS']?>" <?
			}
		?>>
		<div class="rstuning__selectbox__select js-rstuning__selectbox__select">
		<?php foreach ($options['VALUES'] as $arValue): ?>
			<div <?
				?>class="rstuning__selectbox__option js-rstuning__selectbox-open <?=($arValue['HTML_VALUE'] == $options['VALUE'] ? ' active' : '')?>" <?
				?>id="<?=$arValue['CONTROL_ID']?>" <?
				?>value="<?=$arValue['HTML_VALUE']?>" <?
				?>><?
					?><?=$arValue['NAME']?><?
					?><span class="rstuning__selectbox__arrow js-rstuning__selectbox-open"><?=$svgArrow?></span><?
				?></div>
		<?php endforeach; ?>
		</div>
	</div>
</div>
		<?
	}

    public function onload($options = array()) {
		$asset = Asset::getInstance();
		$asset->addCss('/bitrix/css/redsign.tuning/options/selectbox/style.css');
		$asset->addJs('/bitrix/css/redsign.tuning/options/selectbox/script.js');
    }

}
