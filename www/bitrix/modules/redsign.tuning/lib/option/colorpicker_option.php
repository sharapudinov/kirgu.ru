<?php

namespace Redsign\Tuning;

use Bitrix\Main\Page\Asset;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class ColorPickerOption extends TuningOption
{

	protected $name = 'colorpicker';
	protected $description = 'Color picker';

	public function showOption($options = array()) {
		if (1==1) {} // fix for normal VSCode syntaxis lights
		?>
		<?php if (is_array($options['VALUES']) && !empty($options['VALUES'])): ?>
<div class="rstuning__option rstuning-col-<?=$options['GRID_SIZE']?> <?=$options['CSS_CLASS']?> js-rs_option_info" data-reload="<?=($options['RELOAD'] == 'Y' ? 'Y' : 'N')?>">
	<div class="rstuning__option__color-picker rstuning__colorpicker_<?=$options['CONTROL_ID']?>">

		<?php if (is_array($options['SETS']) && !empty($options['SETS'])):
			$arTmpValue = array();
			foreach ($options['VALUES'] as $valKey => $arValue) {
				$arTmpValue[$valKey] = ($arValue['VALUE'] != '' ? $arValue['VALUE'] : $arValue['HTML_VALUE']);
			}
			$arTmpValue = \Bitrix\Main\Web\Json::encode($arTmpValue);
		?>
		<!-- row --><div class="rstuning-row"><div class="rstuning-col-12">
			<?php if ($options['SETS']['NAME']): ?><div class="rstuning__option-opname"><?=$options['SETS']['NAME']?></div><?php endif; ?>
			<div class="rstuning-row">
				<div class="rstuning-col-12">
					<div class="rstuning__colorpicker__sets">
						<?php foreach ($options['SETS']['VALUES'] as $setKey => $arSetValue):
							if (!is_array($arSetValue['VALUES']) || empty($arSetValue['VALUES'])) {
								continue;
							}
							$dataValue = \Bitrix\Main\Web\Json::encode($arSetValue['VALUES']);
						?>
						<div class="rstuning__option__alone-color<?=($arTmpValue == $dataValue ? ' active' : '')?>" data-colorpicker-id="rstuning__colorpicker_<?=$options['CONTROL_ID']?>">
							<a class="js-colorpicker-set" href="#<?=$arSetValue['CONTROL_ID']?>" data-setkey="<?=$setKey?>" data-inputid="<?=$arSetValue['CONTROL_ID']?>" title="" data-value='<?=$dataValue?>'>
								<div class="rstuning__option__color-picker__before-paint">
									<span class="rstuning__option__color-picker__incircle js-color-picker-set-paint" style="background: <?=$arSetValue['BACKGROUND']?>"></span>
								</div>
							</a>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div></div><!-- .row -->
		<?php endif; ?>
			
		<!-- row --><div class="rstuning-row"><div class="rstuning-col-12">
			<?php if ($options['NAME']): ?><div class="rstuning__option-opname"><?=$options['NAME']?></div><?php endif; ?>
			<?php
			$count = 0;
			$arFirstValue = array();
			$isMultiple = count($options['VALUES']) > 3 ? true : false;
			?>
			<div class="rstuning-row">
				<div class="rstuning-col-12">
					<div class="rstuning__colorpicker__values<?=($isMultiple ? ' rstuning__colorpicker__values__multiple js-colorpicker-multiple' : '')?>">
						<?php if ($isMultiple): ?>
							<div class="rstuning__colorpicker__values__multiple-select">
								<svg class="rstuning__colorpicker__arrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 477.175 477.175">
									<path d="M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5
										c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z"/>
								</svg>
						<?php endif; ?>
						<?php if (!empty($options['VALUES'])): ?>
							<div class="rstuning-row">
							<?php foreach ($options['VALUES'] as $valKey => $arValue): ?>
								<?php
								$value = $arValue['VALUE'] != '' ? $arValue['VALUE'] : $arValue['HTML_VALUE'];
								?>
								<div class="rstuning-col-4">
									<div class="rstuning__option__alone-color<?=($count < 1 ? ' active' : '')?>" data-colorpicker-id="rstuning__colorpicker_<?=$options['CONTROL_ID']?>">
										<input <?
											?>type="text" <?
											?>class="rstuning__option__color-picker__hide-me" <?
											?>name="<?=$options['CONTROL_NAME']?>[<?=$arValue['CONTROL_NAME']?>]" <?
											?>id="<?=$arValue['CONTROL_ID']?>" <?
											?>data-valkey="<?=$valKey?>" <?
											?>value="<?=$value?>" <?=$options['ATTR']?> <?
											if (!empty($arValue['MACROS']) && $arValue['MACROS'] != '') {
												?>data-macros="<?=$arValue['MACROS']?>" <?
											}
										?>>
										<a class="js-colorpicker-val" href="#<?=$arValue['CONTROL_ID']?>" data-inputid="<?=$arValue['CONTROL_ID']?>">
											<div class="rstuning__option__color-picker__before-paint">
												<span class="rstuning__option__color-picker__incircle js-color-picker-paint" style="background-color: #<?=$value?>"></span>
											</div>
											<div class="rstuning__option__color-picker-name"><?=$arValue['NAME']?></div>
										</a>
									</div>
								</div>
								<?php
								if ($count < 1) {
									$arFirstValue = $arValue;
								}
								$count++;
								?>
							<?php endforeach; ?>
							</div>
						<?php endif; ?>
						<?php if ($isMultiple): ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php
			$value = $arFirstValue['VALUE'] != '' ? $arFirstValue['VALUE']  : $arFirstValue['HTML_VALUE'];
			?>
			<input class="colorpickerHolder" id="rstuning__colorpicker_<?=$options['CONTROL_ID']?>" type="text" data-dcolor="<?=$value?>" />
			<div class="colorPickerValues">
				<div class="field r">
					<span class="name"><?=Loc::getMessage('RS.TUNING.COLORPICKER.COLOR.R')?></span>
					<span class="val"><input readonly="" type="text" value=""></span>
				</div>
				<div class="field g">
					<span class="name"><?=Loc::getMessage('RS.TUNING.COLORPICKER.COLOR.G')?></span>
					<span class="val"><input readonly="" type="text" value=""></span>
				</div>
				<div class="field b">
					<span class="name"><?=Loc::getMessage('RS.TUNING.COLORPICKER.COLOR.B')?></span>
					<span class="val"><input readonly="" type="text" value=""></span>
				</div>
				<div class="field hex">
					<span class="name"><?=Loc::getMessage('RS.TUNING.COLORPICKER.COLOR.HEX')?></span>
					<span class="val"><input class="rstuning__colopicker__input-hex js-colorpicker-hex" type="text" value=""></span>
				</div>
			</div>
		</div></div><!-- .row --><?
		?><script>rsTuningSpectrumInit('rstuning__colorpicker_<?=$options['CONTROL_ID']?>');</script>
	</div>
</div>
		<?php endif; ?>
		<?
	}

    public function onload($options = array()) {
		$asset = Asset::getInstance();
		// $asset->addJs('/bitrix/css/redsign.tuning/options/colorpicker/colorpicker/colorpicker.js', true);
		// $asset->addCss('/bitrix/css/redsign.tuning/options/colorpicker/colorpicker/colorpicker.css');

		$asset->addJs('/bitrix/css/redsign.tuning/options/colorpicker/script.js', true);
		$asset->addCss('/bitrix/css/redsign.tuning/options/colorpicker/style.css');

		$asset->addJs('/bitrix/css/redsign.tuning/options/colorpicker/spectrum/spectrum.js', true);
		$asset->addCss('/bitrix/css/redsign.tuning/options/colorpicker/spectrum/spectrum.css');
    }

}
