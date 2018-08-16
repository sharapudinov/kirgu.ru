<?php
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage lists
 * @copyright 2001-2018 Bitrix
 */
namespace Bitrix\Lists\Integration\Socialnetwork;

use Bitrix\Main\Event;
use Bitrix\Main\EventResult;
use Bitrix\Socialnetwork\Item\LogIndex;

class Log
{
	const EVENT_ID_LISTS = 'lists_new_element';

	/**
	 * Returns set EVENT_ID processed by handler to generate content for full index.
	 *
	 * @param void
	 * @return array
	 */
	public static function getEventIdList()
	{
		return array(
			self::EVENT_ID_LISTS
		);
	}

	/**
	 * Returns content for LogIndex.
	 *
	 * @param Event $event Event from LogIndex::setIndex().
	 * @return EventResult
	 */
	public static function onIndexGetContent(Event $event)
	{
		global $USER_FIELD_MANAGER;

		$result = new EventResult(
			EventResult::UNDEFINED,
			array(),
			'lists'
		);

		$eventId = $event->getParameter('eventId');
		$itemId = $event->getParameter('itemId');

		if (!in_array($eventId, self::getEventIdList()))
		{
			return $result;
		}

		$content = "";
		$logItem = false;

		if (intval($itemId) > 0)
		{
			$logItem = \Bitrix\Socialnetwork\Item\Log::getById($itemId);
		}

		if ($logItem)
		{
			$logFieldList = $logItem->getFields();

			$content .= LogIndex::getUserName($logFieldList["USER_ID"])." ";

			if (!empty($logFieldList["TITLE"]))
			{
				$content .= \CTextParser::clearAllTags($logFieldList["TITLE"])." ";
			}

			if (
				!empty($logFieldList["PARAMS"])
				&& ($logEntryParams = unserialize($logFieldList["PARAMS"]))
				&& !empty($logEntryParams["ELEMENT_NAME"])
			)
			{
				$content .= \CTextParser::clearAllTags($logEntryParams["ELEMENT_NAME"]);
			}
		}

		$result = new EventResult(
			EventResult::SUCCESS,
			array(
				'content' => $content,
			),
			'lists'
		);

		return $result;
	}
}

