<?php

namespace Redsign\Tuning;

use Bitrix\Main\Page\Asset;

class CheckboxOption extends TuningOption
{

	protected $name = 'checkbox';
	protected $description = 'Checkbox button';

	public function showOption($options = array()) {
		?>
<div class="rstuning__option rstuning-col-<?=$options['GRID_SIZE']?> <?=$options['CSS_CLASS']?> js-rs_option_info" data-reload="<?=($options['RELOAD'] == 'Y' ? 'Y' : 'N')?>">
	<div class="rstuning__option__checkbox">
		<input <?
			?>type="checkbox" <?
			?>name="<?=$options['CONTROL_NAME']?>" <?
			?>value="N" <?
			?><?=($options['DEFAULT'] == 'N' ? 'checked="checked"' : '')?> <?
		?>>
		<input <?
			?>type="checkbox" <?
			?>id="<?=$options['CONTROL_ID']?>" <?
			?>name="<?=$options['CONTROL_NAME']?>" <?
			?>value="Y" <?
			?><?=($options['HTML_VALUE'] == $options['VALUE'] ? 'checked="checked"' : '')?> <?
			?><?=$options['ATTR']?> <?
			if (!empty($options['MACROS']) && $options['MACROS'] != '') {
				?>data-macros="<?=$options['MACROS']?>" <?
			}
		?>>
		<label for="<?=$options['CONTROL_ID']?>"><?=$options['NAME']?></label>
	</div>
</div>
		<?
	}

    public function onload($options = array()) {
		$asset = Asset::getInstance();
		$asset->addCss('/bitrix/css/redsign.tuning/options/checkbox/style.css');
    }

}
