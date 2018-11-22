<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$this->setFrameMode(true);
?>

<?php if (!empty($arResult)): ?>
	<ul class="nav navbar-nav list-unstyled main-menu-nav">
		<?php
		$previousLevel = 0;
		foreach ($arResult as $key => $arItem):
			if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) {
				echo str_repeat("</li></ul>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
			}
			?>
			<?php if ($arItem['DEPTH_LEVEL'] == 1): ?>
				<li class="dropdown lvl1 <?if ($arItem['SELECTED']=='Y'):?>active<?endif;?>" id="element<?=$key?>">
					<a href="<?=$arItem['LINK']?>" class="dropdown-toggle" data-toggle="dropdown">
						<?=$arItem['TEXT']?>
						<?php if ($arItem['IS_PARENT'] == 1): ?>
							<span class="js-opener submenu-opener visible-xs">
								<svg class="icon-plus svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-plus"></use></svg>
								<svg class="icon-minus svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-minus"></use></svg>
							</span>
						<?php endif; ?>
					</a>
			<?php else: ?>
				<?php if ($previousLevel == 1): ?>
					<ul class="dropdown-menu list-unstyled">
				<?php endif; ?>
				<?php if ($arItem['IS_PARENT'] == 1): ?>
					<li class="dropdown-submenu <?if ($arItem['SELECTED']=='Y'):?>active<?endif;?>">
						<a href="<?=$arItem['LINK']?>">
							<?=$arItem['TEXT']?>
							<?php if ($arItem['IS_PARENT'] == 1): ?>
								<svg class="visible-md visible-lg svg-icon arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arrow-linear-right"></use></svg>
								<span class="js-opener submenu-opener visible-xs">
									<svg class="icon-plus svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-plus"></use></svg>
									<svg class="icon-minus svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-minus"></use></svg>
								</span>
							<?php endif; ?>
						</a>
						<ul class="dropdown-menu list-unstyled">
				<?php else: ?>
					<li class="<?if ($arItem['SELECTED']=='Y') {?>active<?}?>"><a href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a>
				<?php endif; ?>
			<?php endif; ?>
			<?php
			$previousLevel = $arItem["DEPTH_LEVEL"];
			?>
		<?php endforeach; ?>
		<?php if ($previousLevel > 1) {
			echo str_repeat("</li></ul>", ($previousLevel-1) );
		}
		?>
		<li class="dropdown other invisible">
			<a class="other-link" href="#"><svg class="svg-icon svg-icon__morelink"><use xlink:href="#svg-more"></use></svg></a>
			<ul class="dropdown-menu list-unstyled dropdown-menu-right"></ul>
		</li>
	</ul>
<?php endif; ?>
