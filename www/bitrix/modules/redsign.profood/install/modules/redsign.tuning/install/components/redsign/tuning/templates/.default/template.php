<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die(); 

use Redsign\Tuning\Tuning;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;

$iconMenu = '<a class="rstuning__toggle-icon" href="#"><span></span><span></span><span></span></a>';
$svgSettings = '<svg class="rstuning__icon-settings" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 25"><path d="M17.016,12.959A4.806,4.806,0,0,0,15.539,9.4,4.869,4.869,0,0,0,12,7.944,4.8,4.8,0,0,0,8.438,9.42a4.866,4.866,0,0,0-1.453,3.539,4.8,4.8,0,0,0,1.477,3.562A4.865,4.865,0,0,0,12,17.975,4.828,4.828,0,0,0,15.539,16.5a4.827,4.827,0,0,0,1.476-3.539h0Zm-1.828,0A3.2,3.2,0,0,1,12,16.147a3.2,3.2,0,0,1-3.187-3.187A3.2,3.2,0,0,1,12,9.772,3.2,3.2,0,0,1,15.188,12.959Zm-2.672,12a3.8,3.8,0,0,0,.469-0.023l0.375-.047a2.52,2.52,0,0,1,.281-0.023h0.094a0.845,0.845,0,0,0,.8-0.8l0.281-1.828a10.9,10.9,0,0,0,1.641-.656l1.5,1.172a0.935,0.935,0,0,0,1.125,0l0.188-.141q0.187-.187.516-0.469t0.609-.562l0.094-.094q0.281-.281.563-0.609t0.422-.516l0.188-.187a0.856,0.856,0,0,0,0-1.125L20.531,17.6a11.642,11.642,0,0,0,.7-1.688l1.875-.234a0.9,0.9,0,0,0,.8-0.8V14.741a1.867,1.867,0,0,1,.023-0.258c0.015-.109.031-0.234,0.047-0.375A4.352,4.352,0,0,0,24,13.639V12.467A4.36,4.36,0,0,0,23.977,12c-0.016-.141-0.032-0.265-0.047-0.375a1.849,1.849,0,0,1-.023-0.258V11.225a0.845,0.845,0,0,0-.8-0.8l-1.828-.281a10.981,10.981,0,0,0-.656-1.641l1.125-1.5a0.937,0.937,0,0,0,0-1.125l-0.187-.187q-0.141-.187-0.422-0.516t-0.562-.609l-0.094-.094Q20.2,4.194,19.875,3.912t-0.516-.422L19.172,3.3a0.855,0.855,0,0,0-1.125,0L16.594,4.428a8.664,8.664,0,0,0-1.641-.7L14.672,1.85a0.845,0.845,0,0,0-.8-0.8H13.781A2.361,2.361,0,0,1,13.5,1.03l-0.375-.047A3.941,3.941,0,0,0,12.656.959H12a4.92,4.92,0,0,0-1.734.141,0.827,0.827,0,0,0-.8.75L9.188,3.678a8.626,8.626,0,0,0-1.641.7l-1.5-1.172a0.937,0.937,0,0,0-1.125,0L4.734,3.4q-0.188.141-.516,0.422t-0.609.563l-0.094.094q-0.281.281-.562,0.609T2.531,5.6l-0.187.188a0.855,0.855,0,0,0,0,1.125L3.469,8.366a8.667,8.667,0,0,0-.7,1.641l-1.875.281a0.845,0.845,0,0,0-.8.8v0.094a2.527,2.527,0,0,1-.023.281c-0.016.125-.031,0.25-0.047,0.375A3.792,3.792,0,0,0,0,12.3v0.656a4.919,4.919,0,0,0,.141,1.734,0.826,0.826,0,0,0,.75.8l1.828,0.281a8.629,8.629,0,0,0,.7,1.641l-1.172,1.5a0.935,0.935,0,0,0,0,1.125l0.188,0.188q0.141,0.188.422,0.516T3.422,21.35l0.094,0.094q0.281,0.281.609,0.563t0.516,0.422l0.188,0.188a0.856,0.856,0,0,0,1.125,0l1.453-1.125a8.629,8.629,0,0,0,1.641.7l0.281,1.875a0.844,0.844,0,0,0,.8.8h0.094a2.548,2.548,0,0,1,.281.023l0.375,0.047a3.787,3.787,0,0,0,.469.023h1.172ZM10.828,21.4a0.868,0.868,0,0,0-.7-0.8,8.983,8.983,0,0,1-2.156-.891A0.823,0.823,0,0,0,6.8,19.663L5.438,20.694a5.625,5.625,0,0,1-.609-0.516l-0.094-.141-0.562-.562L5.2,18.116a0.724,0.724,0,0,1,.141-0.187l0.047-.141a0.9,0.9,0,0,0-.094-0.8,7.278,7.278,0,0,1-.937-2.156V14.788a0.828,0.828,0,0,0-.75-0.8l-1.734-.234V12.069l1.734-.234a0.948,0.948,0,0,0,.8-0.75,8.786,8.786,0,0,1,.938-2.2l0.047-.047a1.023,1.023,0,0,0-.047-1.078L4.266,6.4q0.093-.093.281-0.3c0.125-.141.218-0.242,0.281-0.3l0.094-.094a6.837,6.837,0,0,1,.609-0.562L6.891,6.162a0.538,0.538,0,0,0,.375.188,0.876,0.876,0,0,0,.7-0.094,7.212,7.212,0,0,1,2.2-.937,0.827,0.827,0,0,0,.8-0.75L11.2,2.787A4.682,4.682,0,0,1,12,2.741h0.094a4.688,4.688,0,0,1,.8.047l0.234,1.734a0.947,0.947,0,0,0,.75.8,8.813,8.813,0,0,1,2.2.938,0.794,0.794,0,0,0,1.078,0l1.406-1.031a6.259,6.259,0,0,1,.563.516l0.141,0.141c0.062,0.063.156,0.164,0.281,0.3s0.2,0.227.234,0.258L18.75,7.85a0.83,0.83,0,0,0-.141.891,0.267,0.267,0,0,0,.094.188,8.488,8.488,0,0,1,.938,2.3,0.845,0.845,0,0,0,.75.7l1.734,0.234V13.85l-1.734.234a0.962,0.962,0,0,0-.8.8,8.8,8.8,0,0,1-.938,2.2,0.841,0.841,0,0,0,.047,1.031l1.031,1.406a6.058,6.058,0,0,1-.516.563l-0.141.141c-0.063.063-.164,0.157-0.3,0.281s-0.227.2-.258,0.234l-1.406-1.031a1.035,1.035,0,0,0-.375-0.187,1.425,1.425,0,0,0-.7.094,7.108,7.108,0,0,1-2.3.984,0.845,0.845,0,0,0-.7.75L12.8,23.084H11.063Z"/></svg>';
$svgClose = '<svg class="rstuning__icon-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14"><path d="M8.688,6.959l4.734-4.781a1.044,1.044,0,0,0,0-1.641,1.044,1.044,0,0,0-1.641,0L7,5.272,2.219,0.537a1.044,1.044,0,0,0-1.641,0,1.043,1.043,0,0,0,0,1.641L5.313,6.959,0.578,11.741a1.043,1.043,0,0,0,0,1.641,1.118,1.118,0,0,0,.8.375,1.165,1.165,0,0,0,.844-0.375L7,8.647l4.781,4.734a1.163,1.163,0,0,0,.844.375,1.119,1.119,0,0,0,.8-0.375,1.044,1.044,0,0,0,0-1.641Z"/></svg>';
$svgArrowBack = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 16"><path d="M18.859,6.928H3.625L8.359,2.194a0.938,0.938,0,0,0,0-1.5,0.892,0.892,0,0,0-1.453,0L0.391,7.209a0.937,0.937,0,0,0,0,1.5l6.516,6.516a0.954,0.954,0,0,0,.7.281,1.014,1.014,0,0,0,.75-0.281,0.892,0.892,0,0,0,0-1.453L3.625,8.991H18.859a1.031,1.031,0,0,0,0-2.062h0Z"/></svg>';
$svgArrow = '<svg class="rstuning__icon-sidebar-icon-absolute" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129"><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"></path></svg>';
$svgDefaultSettings = '<svg class="rstuning__icon-sidebar-icon-absolute" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 15"><path d="M16.981,6.026a0.766,0.766,0,0,0-1.125,0l-1.23,1.266a6.8,6.8,0,0,0-2.232-4.535A6.66,6.66,0,0,0,7.734.928,6.677,6.677,0,0,0,2.813,2.985,6.806,6.806,0,0,0,.773,7.959a6.8,6.8,0,0,0,2.039,4.975,6.677,6.677,0,0,0,4.922,2.057,6.705,6.705,0,0,0,3.938-1.231,0.8,0.8,0,0,0-.316-1.424,0.756,0.756,0,0,0-.6.158,5.3,5.3,0,0,1-3.023.949,5.131,5.131,0,0,1-3.814-1.6A5.348,5.348,0,0,1,2.355,7.959,5.35,5.35,0,0,1,3.92,4.075,5.093,5.093,0,0,1,7.7,2.475a5.119,5.119,0,0,1,3.656,1.477,5.432,5.432,0,0,1,1.723,3.586L11.566,6.026a0.8,0.8,0,0,0-1.125,1.125l2.707,2.742a0.855,0.855,0,0,0,1.125,0l2.742-2.742a0.718,0.718,0,0,0-.035-1.125h0Z"/></svg>';
$svgSocialVk = '<svg viewBox="0 0 20 12" xmlns="http://www.w3.org/2000/svg"><path d="M9.785 11.914a5.914 5.914 0 0 1-1.6-.234A7.256 7.256 0 0 1 6.582 11a7.039 7.039 0 0 1-1.738-1.43 15.032 15.032 0 0 1-1.817-2.343Q2.168 5.879 1.5 4.648T.059 1.68a.343.343 0 0 1-.039-.157.46.46 0 0 1-.01-.166.483.483 0 0 1 .049-.166.376.376 0 0 1 .156-.146A.785.785 0 0 1 .41.977H3.5A.44.44 0 0 1 3.633 1a.782.782 0 0 1 .156.059c.052.026.11.059.176.1q.059.059.107.117c.032.039.062.072.088.1a1 1 0 0 0 .059.137q.156.391.293.7t.332.707q.2.4.43.791.449.781.791 1.27a5.666 5.666 0 0 0 .6.742 1.077 1.077 0 0 0 .439.3A.471.471 0 0 0 7.441 6a.827.827 0 0 0 .313-.59 5.911 5.911 0 0 0 .117-.977q.019-.527-.02-1.348-.02-.312-.039-.527-.039-.215-.1-.449a1.082 1.082 0 0 0-.176-.391 1.015 1.015 0 0 0-.215-.2 2.218 2.218 0 0 0-.231-.131q-.137-.039-.254-.069a.8.8 0 0 0-.176-.029.071.071 0 0 1-.049-.089.328.328 0 0 1 .069-.145 1.239 1.239 0 0 1 .185-.186A1.2 1.2 0 0 1 7.09.723a1.73 1.73 0 0 1 .469-.147 5.239 5.239 0 0 1 .586-.068 5.549 5.549 0 0 1 .683-.039h.762q.312 0 .527.01t.371.01a2.359 2.359 0 0 1 .273.049c.079.019.157.035.239.048a.89.89 0 0 1 .527.322 1.207 1.207 0 0 1 .176.635 6.44 6.44 0 0 1 0 1.006q-.039.6-.039 1.416 0 .274-.01.576a5.471 5.471 0 0 0 .01.576 2.1 2.1 0 0 0 .1.527.622.622 0 0 0 .267.356.3.3 0 0 0 .225.039.88.88 0 0 0 .4-.254 4.17 4.17 0 0 0 .605-.693q.352-.478.859-1.338a7.624 7.624 0 0 0 .459-.811q.205-.42.361-.752.136-.352.313-.781l.059-.117a.691.691 0 0 1 .088-.111.718.718 0 0 1 .107-.088.306.306 0 0 1 .117-.049.723.723 0 0 1 .117-.01.247.247 0 0 1 .137 0h2.988a3.313 3.313 0 0 1 .508 0 1.287 1.287 0 0 1 .361.088.328.328 0 0 1 .205.186.962.962 0 0 1-.029.439 4.305 4.305 0 0 1-.244.654q-.2.371-.518.869t-.771 1.1q-.761 1.02-1.178 1.547a2.116 2.116 0 0 0-.478.879.752.752 0 0 0 .2.674 12.225 12.225 0 0 0 .9.908q.605.567.986.977a8.283 8.283 0 0 1 .6.7q.215.293.3.439t.092.189a.892.892 0 0 1 .166.644.705.705 0 0 1-.244.371 1.165 1.165 0 0 1-.381.166 1.467 1.467 0 0 1-.283.049h-2.652a2.181 2.181 0 0 1-.43-.039 1.98 1.98 0 0 1-.43-.1 1.941 1.941 0 0 1-.488-.254 3.683 3.683 0 0 1-.752-.664q-.361-.41-.713-.8a5.121 5.121 0 0 0-.645-.615.624.624 0 0 0-.566-.166.738.738 0 0 0-.439.4 2.443 2.443 0 0 0-.205.615 6.348 6.348 0 0 0-.078.84 1.008 1.008 0 0 1-.02.2 2.108 2.108 0 0 1-.049.166.579.579 0 0 1-.088.166.567.567 0 0 1-.166.146.679.679 0 0 1-.166.068l-.2.039H9.785z"></path></svg>';
$svgSocialFb = '<svg viewBox="0 0 10 21" xmlns="http://www.w3.org/2000/svg"><path d="M7.441 4.059a1.1 1.1 0 0 0-.479.107 1.188 1.188 0 0 0-.381.283 1.271 1.271 0 0 0-.244.42 1.462 1.462 0 0 0-.088.5v1.17h3.692l-.605 3.711H6.25v10H2.5v-10H0V6.539h2.5V4.625a7.461 7.461 0 0 1 .205-1.572A3.289 3.289 0 0 1 3.379 1.7a3.6 3.6 0 0 1 1.357-1A6.143 6.143 0 0 1 6.973.25H10v3.809H7.441z"></path></svg>';
$svgSocialTw = '<svg viewBox="0 0 20 17" xmlns="http://www.w3.org/2000/svg"><path d="M20 2.059a5.24 5.24 0 0 1-.479.693q-.263.322-.521.576a4.9 4.9 0 0 1-.508.479 5.189 5.189 0 0 1-.469.342V4.3a11.525 11.525 0 0 1-.757 4.7 11.663 11.663 0 0 1-2.422 3.838 11.484 11.484 0 0 1-8.379 3.535 12.64 12.64 0 0 1-1.729-.117 12.067 12.067 0 0 1-1.67-.352 11.718 11.718 0 0 1-1.582-.576A14.5 14.5 0 0 1 0 14.559a6.228 6.228 0 0 0 1.992.029 7.9 7.9 0 0 0 1.68-.439 6.4 6.4 0 0 0 1.27-.654 4.16 4.16 0 0 0 .781-.654 3.525 3.525 0 0 1-1.348-.264 4.578 4.578 0 0 1-1.152-.677 4.332 4.332 0 0 1-.83-.918 2.052 2.052 0 0 1-.361-.957q.136.02.352.039t.469.02a2.829 2.829 0 0 0 .469-.039 1.5 1.5 0 0 0 .428-.135 4.45 4.45 0 0 1-1.572-.723 4.381 4.381 0 0 1-.986-1.016 4.015 4.015 0 0 1-.5-1.162 4.152 4.152 0 0 1-.126-1.142 1.211 1.211 0 0 0 .381.254 2.72 2.72 0 0 0 .479.156 4.362 4.362 0 0 0 .5.049 2.8 2.8 0 0 0 .42-.01 3.656 3.656 0 0 1-.969-.916 4.08 4.08 0 0 1-.654-1.33 4.333 4.333 0 0 1-.157-1.552A3.858 3.858 0 0 1 1.094.867a9.426 9.426 0 0 0 1.787 1.778 11.944 11.944 0 0 0 2.2 1.328 12.506 12.506 0 0 0 2.383.85 11.6 11.6 0 0 0 2.383.342q-.023-.118-.047-.226c-.008-.071-.022-.146-.034-.224s0-.156-.01-.234-.01-.156-.01-.234a4.047 4.047 0 0 1 .322-1.611 3.941 3.941 0 0 1 .889-1.3 4.166 4.166 0 0 1 1.318-.889 4 4 0 0 1 1.592-.322 4.233 4.233 0 0 1 .869.088 3.532 3.532 0 0 1 .791.264 4.032 4.032 0 0 1 .713.391 5.447 5.447 0 0 1 .635.508 2.441 2.441 0 0 0 .6-.088 7.388 7.388 0 0 0 .713-.225q.352-.136.693-.293a4.693 4.693 0 0 0 .553-.293 2.609 2.609 0 0 1-.273.654 4.876 4.876 0 0 1-.449.654 4.663 4.663 0 0 1-.5.566 2.087 2.087 0 0 1-.5.371 6.55 6.55 0 0 0 .7-.117q.351-.078.664-.176t.547-.2a3.406 3.406 0 0 0 .377-.17z"></path></svg>';
$preloader = '<div class="preloader-wrapper big active"><div class="spinner-layer"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
?>

<?php if (!empty($arResult['OPTIONS'])): ?>

<div class="rstuning__overlay js-rstuning__main-overlay<?=($arResult['COOKIE_OPEN'] == 'Y' ? ' open' : '')?>"></div>
<div id="rstuning" class="rstuning <?=(!empty($arResult['TABS']) && count($arResult['TABS']['ITEMS']) > 1 ? 'mod-tabs' : '')?> <?=($arResult['COOKIE_OPEN'] == 'Y' ? 'open' : 'closed')?> js-rstuning" <?
    ?>data-reload="N" <?
    ?>data-fromSession="<?=$arResult['FROM_SESSION']?>" <?
    ?>data-siteid="<?=SITE_ID?>" <?
    ?>data-cookieopen="<?=$arResult['COOKIE_OPEN']?>" <?
    ?>data-firsttabid="<?=$arResult['TABS']['FIRST_TAB_ID']?>" <?
    ?>>
    <form class="rstuning__form rstuning__body" action="<?=$arResult['FORM_ACTION']?>" method="POST" enctype="multipart/form-data" id="rstuning-form">
    <input type="hidden" name="rstuning_ajax" value="Y">
    <input type="hidden" name="site_id" value="<?=SITE_ID?>">
    <div class="rstuning__body-in js-rstuning__body-in">

        <div class="rstuning__buttons">
            <a class="rstuning__buttons-open" href="#">
                <?=$svgSettings?>
                <?=$svgClose?>
                <div class="rstuning__buttons-open__desc">
                    <span class="rstuning__buttons-open__desc__show"><?=Loc::getMessage('RS.TUNING.OPEN_BUTTON_DESCR.SHOW')?></span>
                    <span class="rstuning__buttons-open__desc__hide"><?=Loc::getMessage('RS.TUNING.OPEN_BUTTON_DESCR.HIDE')?></span>
                </div>
            </a>
        </div>

        <div class="rstuning__loader"><?=$preloader?></div>

        <?php if(!empty($arResult['TABS']) && count($arResult['TABS']['ITEMS']) > 1): ?>
        <div class="rstuning__sidebar-overlay js-rstuning__sidebar-overlay"></div>
        <div class="rstuning__sidebar">
            <div class="rstuning__sidebar-header rstuning__block-header"><span>
              <?=$svgSettings?>
              <a class="rstuning__sidebar-back js-tuning__sidebar-close" href="#"><?=$svgArrowBack?></a>
            </span></div>

            <div class="rstuning__scroll">

                <?php if (!empty($arResult['TABS']['ITEMS'])): ?>
                    <div class="rstuning__tabs-nav">
                    <?php foreach ($arResult['TABS']['ITEMS'] as $tabId => $arTab): ?>
                        <a class="<?=($arResult['TABS']['FIRST_TAB_ID'] == $tabId ? 'active' : '')?>" href="#<?=$tabId?>" data-tabid="<?=$tabId?>" data-name="<?=$arTab['NAME']?>"><?=$arTab['NAME']?><?=$svgArrow?></a>
                    <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <div class="rstuning__sidebar-menu rstuning__sidebar-menu-default">
                    <a class="js-tuning-default-settings" href="#"><?=Loc::getMessage('RS.TUNING.BUTTON.DEFAULT_SETTINGS')?><?=$svgDefaultSettings?></a>
                </div>

                <div class="rstuning__sidebar-menu rstuning__sidebar-menu-contacts">
                    <span><?=Loc::getMessage('RS.TUNING.SOCIAL.DEVELOPER')?></span>
                    <span><?=Loc::getMessage('RS.TUNING.SOCIAL.PHONE')?></span>
                    <span><?=Loc::getMessage('RS.TUNING.SOCIAL.EMAIL')?></span>
                    <span class="rstuning__social">
                      <a ref="nofollow" href="https://vk.com/redsignru" target="_blank"><?=$svgSocialVk?></a>
                      <a ref="nofollow" href="https://www.facebook.com/redsignru/" target="_blank"><?=$svgSocialFb?></a>
                      <a ref="nofollow" href="https://twitter.com/redsignru" target="_blank"><?=$svgSocialTw?></a>
                    </span>
                </div>
                
            </div>
        </div>
        <?php endif; ?>

        <div class="rstuning__content">

            <div class="rstuning__content-header rstuning__block-header">
                <?php if (!empty($arResult['TABS']['ITEMS']) && count($arResult['TABS']['ITEMS']) > 1): ?>
                <span><?=$iconMenu?><span class="js-content-title"><?=$arResult['TABS']['ITEMS'][$arResult['TABS']['FIRST_TAB_ID']]['NAME']?></span><?=$svgClose?></span>
                <?php else: ?>
                <span><?=$iconMenu?><span class="js-content-title"><?=Loc::getMessage('RS.TUNING.OPEN_BUTTON_DESCR.SHOW')?></span><?=$svgClose?></span>
                <?php endif; ?>
            </div>

            <div class="rstuning__scroll mod-margin mod-padding">
            <?php if (!empty($arResult['TABS'])): ?>
                <div class="rstuning__tabs-content">
                <?php foreach ($arResult['TABS']['ITEMS'] as $tabId => $arTab): ?>
                    <div class="rstuning__tab-pane <?=($arResult['TABS']['FIRST_TAB_ID'] == $tabId ? 'active' : '')?>" data-tabid="<?=$tabId?>">
                        <div class="rstuning-row">
                        <?php if (!empty($arTab['OPTIONS'])): ?>
                            <?php foreach ($arTab['OPTIONS'] as $optionId): ?>
                                <?php if (!empty($arResult['OPTIONS'][$optionId])): ?>
                                    <?=$arResult['OPTIONS'][$optionId]['DISPLAY_HTML'];?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="rstuning-row">
                <?php if (!empty($arResult['OPTIONS'])): ?>
                    <?php foreach ($arResult['OPTIONS'] as $arOption): ?>
                            <?=$arOption['DISPLAY_HTML'];?>
                    <?php endforeach; ?>
                <?php endif; ?>
                </div>
            <?php endif; ?>
            </div>

            <div class="rstuning__content-footer">
                <div class="rstuning__content-footer-default">
                    <a class="js-tuning-default-settings" href="#"><?=Loc::getMessage('RS.TUNING.BUTTON.DEFAULT_SETTINGS')?><?=$svgDefaultSettings?></a>
                </div>
            </div>

        </div>

    </div>
    </form>
</div>

<div id="rstuning_styles"></div>
<script>
var rsTuning = new RS.Tuning(),
rsTuningComponent = new RS.TuningComponent();
rsTuning.setColorMacrosContent("<?=CUtil::JSEscape($arResult['FILE_COLOR_MACROS_CONTENT'])?>");
</script>

<?php endif; ?>
