<?php

namespace Redsign\Tuning;

use Bitrix\Main\Page\Asset;

class Line2BorderOption extends TuningOption
{

	protected $name = 'line2border';
	protected $description = 'Separation block';

	public function showOption($options = array()) {
		?>
<div class="rstuning__option rstuning-col-<?=$options['GRID_SIZE']?>">
	<div class="rstuning__option__line2border"></div>
</div>
		<?
	}

    public function onload($options = array()) {
		$asset = Asset::getInstance();
		$asset->addCss('/bitrix/css/redsign.tuning/options/line2border/style.css');
    }

}
