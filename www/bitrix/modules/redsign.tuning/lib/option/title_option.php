<?php

namespace Redsign\Tuning;

use Bitrix\Main\Page\Asset;

class TitleOption extends TuningOption
{

	protected $name = 'title';
	protected $description = 'Title block';

	public function showOption($options = array()) {
		?>
<div class="rstuning__option rstuning-col-<?=$options['GRID_SIZE']?>">
	<div class="rstuning__option__title"><?=$options['NAME']?></div>
</div>
		<?
	}

    public function onload($options = array()) {
		$asset = Asset::getInstance();
		$asset->addCss('/bitrix/css/redsign.tuning/options/title/style.css');
    }

}
