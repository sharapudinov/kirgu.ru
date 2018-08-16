<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
?>

<span class="authinhead2" id="inheadauthform">
    <?php
	$frame = $this->createFrame('inheadauthform',false)->begin();
	$frame->setBrowserStorage(true);
    ?>
        <?php if ($arResult["FORM_TYPE"] == 'login'): ?>
            <span class="guest"><?
                ?><span class="authinhead2__icon"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-lock"></use></svg></span><?
                ?><a href="<?=SITE_DIR?>auth/"><?=GetMessage('RSGOPRO_AUTH')?></a><?
            ?></span>
        <?php else: ?>
            <span class="authorized"><?
                ?><a class="" href="<?
                    if ($arParams['PROFILE_URL'] != ''):
                        ?><?=$arParams['PROFILE_URL']?><?php
                    else:
                        ?><?=SITE_DIR?>personal/<?php
                    endif;
                    ?>"><?
                        ?><span class="authinhead2__icon"><svg class="svg-icon svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-profil"></use></svg></span><?
                        ?><span class="hidden-xs hidden-sm"><?=$arResult['USER_LOGIN']?></span><?
                ?></a><?
            ?></span>
        <?php endif; ?>

    <?php $frame->beginStub(); ?>
        <span class="guest"><?
            ?><svg class="svg-icon svg-icon-header"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-profil-1"></use></svg><?
            ?><a href="<?=SITE_DIR?>auth/"><?=GetMessage('RSGOPRO_AUTH')?></a><?
        ?></span>

    <?php $frame->end(); ?>
</span>
