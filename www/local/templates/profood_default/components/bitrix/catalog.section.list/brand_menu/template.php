<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$this->setFrameMode(true);
?>

<?php if (is_array($arResult['SECTIONS']) && count($arResult['SECTIONS']) > 0): ?>
<div class="pmenu">
	<ul class="menu-sidebar list-unstyled clearfix">
		<?php foreach($arResult['SECTIONS'] as $arSection): ?>
		<li class="first"><a class="clearfix" href="<?=$arSection['SECTION_PAGE_URL']?>"><span class="imya"><?=$arSection['NAME']?></span></a></li>
		<?php endforeach; ?>
	</ul>
</div>
<?php endif; ?>
