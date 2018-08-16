<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
use Bitrix\Main\Localization\Loc;

Loc::loadLanguageFile(__FILE__);

return array(
	'js' => '/bitrix/js/socialnetwork/commentaux/socialnetwork.commentaux.js',
	'lang_additional' => array(
		'SONET_EXT_COMMENTAUX_CREATE_TASK_PATH' => \Bitrix\Main\Config\Option::get('socialnetwork', 'user_page', SITE_DIR.'company/personal/').'user/#user_id#/tasks/task/view/#task_id#/',
	),
	'rel' => array('render_parts')
);