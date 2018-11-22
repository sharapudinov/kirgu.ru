<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

$id = 'inheadauthform_'.$this->randString();
?>

<div class="authinhead" id="<?=$id?>">
    <?php
	$frame = $this->createFrame($id, false)->begin();
	$frame->setBrowserStorage(true);
    ?>
        <?php if ($arResult["FORM_TYPE"] == 'login'): ?>
            <div class="authinheadinner guest"><?
                ?><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-lock"></use></svg><?
                ?><a href="<?=SITE_DIR?>auth/"><?=GetMessage('RSGOPRO_AUTH')?></a> | <a href="<?
                    if ($arParams['REGISTER_URL'] != ''):
                        ?><?=$arParams['REGISTER_URL']?><?php
                    else:
                        ?><?=SITE_DIR?>auth/?register=yes<?php
                    endif;
                    ?>"><?=GetMessage('RSGOPRO_REGISTRATION')?></a>
            </div>
        <?php else: ?>
            <div class="authinheadinner logged">
                <a class="auth_top_panel-item" href="<?
                    if ($arParams['PROFILE_URL'] != ''):
                        ?><?=$arParams['PROFILE_URL']?><?php
                    else:
                        ?><?=SITE_DIR?>personal/<?php
                    endif;
                    ?>"><span class="visible-md-inline visible-lg-inline"><?=$arResult['USER_LOGIN']?></span><?
                        ?><span class="visible-xs-inline visible-sm-inline"><?=GetMessage('RSGOPRO_PERSONAL_PAGE')?></span><?
                ?></a><?
                ?><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-logout"></use></svg><?
                ?><a class="auth_top_panel-item" href="?logout=yes"><?=GetMessage('RSGOPRO_EXIT')?></a>
            </div>
        <?php endif; ?>

	<?php $frame->beginStub(); ?>
    <div class="authinheadinner logged">
        <i class="icon pngicons"></i><a href="<?=SITE_DIR?>auth/"><?=GetMessage('RSGOPRO_AUTH')?></a> | <a href="<?
            if ($arParams['REGISTER_URL'] != ''):
                ?><?=$arParams['REGISTER_URL']?><?php
            else:
                ?><?=SITE_DIR?>auth/?register=yes<?php
            endif;
            ?>"><?=GetMessage('RSGOPRO_REGISTRATION')?></a>
    </div>

    <?php $frame->end(); ?>
</div>
