<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Application;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

global $isAjax;

if ($isAjax) {
	?></div></div><?
	die();
}

?>

				</div>
			</div>
		</div><!-- /content -->
	</div><!-- /body -->

<?$APPLICATION->IncludeFile(
	SITE_DIR."include/header/footer.before.php",
	array(),
	array("MODE"=>"html")
);?>

	<div id="footer" class="footer"><!-- footer -->
		<div class="centering">
			<div class="centeringin line1 clearfix">
				<div class="block one">
					<div class="logo">
						<a href="<?=SITE_DIR?>">
							<?$APPLICATION->IncludeFile(
								SITE_DIR."include/company_logo.php",
								Array(),
								Array("MODE"=>"html")
							);?>
						</a>
					</div>
					<div class="contacts clearfix">
						<div class="phone1">
							<a class="fancyajax fancybox.ajax recall" href="<?=SITE_DIR?>include/popup/recall/?AJAX_CALL=Y" title="<?=Loc::getMessage('RSGOPRO.RECALL')?>"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-mobile-phone"></use></svg><?=Loc::getMessage('RSGOPRO.RECALL')?></a>
							<div class="phone">
								<?$APPLICATION->IncludeFile(
									SITE_DIR."include/footer/phone1.php",
									Array(),
									Array("MODE"=>"html")
								);?>
							</div>
						</div>
						<div class="phone2">
							<a class="fancyajax fancybox.ajax feedback" href="<?=SITE_DIR?>include/popup/feedback/?AJAX_CALL=Y" title="<?=Loc::getMessage('RSGOPRO.FEEDBACK')?>"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-dialog"></use></svg><?=Loc::getMessage('RSGOPRO.FEEDBACK')?></a>
							<div class="phone">
								<?$APPLICATION->IncludeFile(
									SITE_DIR."include/footer/phone2.php",
									Array(),
									Array("MODE"=>"html")
								);?>
							</div>
						</div>
					</div>
				</div>
				<div class="block two hidden-print">
					<?$APPLICATION->IncludeFile(
						SITE_DIR."include/footer/catalog_menu.php",
						Array(),
						Array("MODE"=>"html")
					);?>
				</div>
				<div class="block three hidden-print">
					<?$APPLICATION->IncludeFile(
						SITE_DIR."include/footer/menu.php",
						Array(),
						Array("MODE"=>"html")
					);?>
				</div>
				<div class="block four hidden-print">
					<div class="sovservice">
						<?$APPLICATION->IncludeFile(
							SITE_DIR."include/footer/socservice.php",
							Array(),
							Array("MODE"=>"html")
						);?>
					</div>
					<div class="subscribe">
						<?$APPLICATION->IncludeFile(
							SITE_DIR."include/footer/subscribe.php",
							Array(),
							Array("MODE"=>"html")
						);?>
					</div>
				</div>
			</div>
		</div>

		<div class="line2 hidden-print">
			<div class="centering">
				<div class="centeringin clearfix">
					<div class="sitecopy">
						<?$APPLICATION->IncludeFile(
							SITE_DIR."include/footer/law.php",
							Array(),
							Array("MODE"=>"html")
						);?>
					</div>
					<div class="developercopy hidden-xs"><?
						?><?php
						/****************************************************************************************/
						/* #REDSIGN_COPYRIGHT# */
						/****************************************************************************************/
						?><?
						?>Powered by <a href="https://www.redsign.ru/templates/store/<?=GOPRO_MODULE_ID?>/" target="_blank" rel="nofollow">ALFA Systems</a><?
					?></div>
				</div>
			</div>
		</div>
	</div><!-- /footer -->

<?$APPLICATION->IncludeFile(
	SITE_DIR."include/header/footer.after.php",
	array(),
	array("MODE"=>"html")
);?>

<?$APPLICATION->IncludeFile(
	SITE_DIR."include/footer/easycart.php",
	Array(),
	Array("MODE"=>"html")
);?>

<?php include(EXTENDED_PATH.'/footer_inc.php'); ?>

<script type="text/javascript">RSGoPro_SetSet();</script>

<div style="display:none;">Шамиль Шарапудинов</div>

<script>$('#svg-icons').setHtmlByUrl({url:SITE_TEMPLATE_PATH + '/assets/img/icons.svg?v404'});</script>

<?$APPLICATION->IncludeFile(
	SITE_DIR."include/tuning/component.php",
	Array(),
	Array("MODE"=>"html")
);?>

<?$APPLICATION->IncludeFile(
	SITE_DIR."include/footer/body_end.php",
	Array(),
	Array("MODE"=>"html")
);?>

</body>
</html>
