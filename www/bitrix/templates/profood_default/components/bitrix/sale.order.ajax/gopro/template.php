<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>

<div style="border: 1px solid red; color: red; padding: 10px 14px;"><?=Loc::getMessage('OLD_TEMPLATE')?></div>
