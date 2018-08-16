<?php

namespace Redsign\Tuning;

use Bitrix\Main\Page\Asset;
use Bitrix\Main\Application;

class SwitchOption extends TuningOption
{

	protected $name = 'switch';
	protected $description = 'Switch button';

	public function showOption($options = array()) {
		$imageSrc = (!empty($options['IMAGE']) && file_exists(Application::getDocumentRoot().$options['IMAGE']) ? $options['IMAGE'] : false );
		$gridSize = (!$imageSrc ? $options['GRID_SIZE'] : 12);
		?>
<div class="rstuning__option rstuning-col-<?=$gridSize?> <?=$options['CSS_CLASS']?> js-rs_option_info" data-reload="<?=($options['RELOAD'] == 'Y' ? 'Y' : 'N')?>">
	<div class="rstuning__option__switch switch<?=($imageSrc ? ' rstuning__option__switch-imgmod' : '')?>">
		<label for="<?=$options['CONTROL_ID']?>">
			<?=$options['NAME']?><input <?
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
			<span class="lever"></span>
			<?php if ($imageSrc): ?>
				<div class="rstuning__option__switch-image"><img src="<?=$imageSrc?>" alt="" title=""></div>
			<?php endif; ?>
		</label>
	</div>
</div>
		<?
	}

    public function onload($options = array()) {
		$asset = Asset::getInstance();
		$asset->addCss('/bitrix/css/redsign.tuning/options/switch/style.css');
    }

}
