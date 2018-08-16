<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$this->setFrameMode(true);

$ClientID = 'navigation_'.$arResult['NavNum'];

if (!$arResult["NavShowAlways"]) {
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

?><div class="navi clearfix"><div class="navigation"><?
	
	$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
	$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
	if($arResult["bDescPageNumbering"] === true)
	{
		// to show always first and last pages
		$arResult["nStartPage"] = $arResult["NavPageCount"];
		$arResult["nEndPage"] = 1;

		$sPrevHref = '';
		if ($arResult["NavPageNomer"] < $arResult["NavPageCount"])
		{
			$bPrevDisabled = false;
			if ($arResult["bSavePage"])
			{
				$sPrevHref = $arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]+1);
			}
			else
			{
				if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1))
				{
					$sPrevHref = $arResult["sUrlPath"].$strNavQueryStringFull;
				}
				else
				{
					$sPrevHref = $arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]+1);
				}
			}
		}
		else
		{
			$bPrevDisabled = true;
		}
		
		$sNextHref = '';
		if ($arResult["NavPageNomer"] > 1)
		{
			$bNextDisabled = false;
			$sNextHref = $arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]-1);
		}
		else
		{
			$bNextDisabled = true;
		}
		
		$sPrevHref = str_replace(array('AJAX_CALL', 'sorterchange'), 'n', $sPrevHref);
		$sNextHref = str_replace(array('AJAX_CALL', 'sorterchange'), 'n', $sNextHref);
		$arResult["sUrlPath"] = str_replace(array('AJAX_CALL', 'sorterchange'), 'n', $arResult["sUrlPath"]);
		$strNavQueryString = str_replace(array('AJAX_CALL', 'sorterchange'), 'n', $strNavQueryString);
		$strNavQueryStringFull = str_replace(array('AJAX_CALL', 'sorterchange'), 'n', $strNavQueryStringFull);

		$sPrevHref = str_replace('+', '%2B', $sPrevHref);
		$sNextHref = str_replace('+', '%2B', $sNextHref);
		$arResult["sUrlPath"] = str_replace('+', '%2B', $arResult["sUrlPath"]);
		$strNavQueryString = str_replace('+', '%2B', $strNavQueryString);
		$strNavQueryStringFull = str_replace('+', '%2B', $strNavQueryStringFull);

		if($bPrevDisabled)
		{
			?><span class="left arrow" rel="prev"><i class="icon pngicons"></i></span><?
		} else {
			?><a class="left arrow" rel="prev" href="<?=$sPrevHref;?>"><i class="icon pngicons"></i></a><?
		}
		
		$bFirst = true;
		$bPoints = false;
		do
		{
			$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;
			if ($arResult["nStartPage"] <= 2 || $arResult["NavPageCount"]-$arResult["nStartPage"] <= 1 || abs($arResult['nStartPage']-$arResult["NavPageNomer"])<=2)
			{

				if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
					?><span class="current"><?=$NavRecordGroupPrint?></span><?
				elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):
					?><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$NavRecordGroupPrint?></a><?
				else:
					?><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$NavRecordGroupPrint?></a><?
				endif;
				$bFirst = false;
				$bPoints = true;
			} else {
				if ($bPoints)
				{
					?>...<?
					$bPoints = false;
				}
			}
			$arResult["nStartPage"]--;
		} while($arResult["nStartPage"] >= $arResult["nEndPage"]);
		
		if($bNextDisabled)
		{
			?><span class="right arrow" rel="next"><i class="icon pngicons"></i></span><?
		} else {
			?><a class="right arrow" rel="next" href="<?=$sNextHref;?>"><i class="icon pngicons"></i></a><?
		}
		
	}
	else
	{
		// to show always first and last pages
		$arResult["nStartPage"] = 1;
		$arResult["nEndPage"] = $arResult["NavPageCount"];

		$sPrevHref = '';
		if ($arResult["NavPageNomer"] > 1)
		{
			$bPrevDisabled = false;
			
			if ($arResult["bSavePage"] || $arResult["NavPageNomer"] > 2)
			{
				$sPrevHref = $arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]-1);
			}
			else
			{
				$sPrevHref = $arResult["sUrlPath"].$strNavQueryStringFull;
			}
		}
		else
		{
			$bPrevDisabled = true;
		}

		$sNextHref = '';
		if ($arResult["NavPageNomer"] < $arResult["NavPageCount"])
		{
			$bNextDisabled = false;
			$sNextHref = $arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]+1);
		}
		else
		{
			$bNextDisabled = true;
		}
		
		$sPrevHref = str_replace(array('AJAX_CALL','sorterchange'),'n',$sPrevHref);
		$sNextHref = str_replace(array('AJAX_CALL','sorterchange'),'n',$sNextHref);
		$arResult["sUrlPath"] = str_replace(array('AJAX_CALL','sorterchange'),'n',$arResult["sUrlPath"]);
		$strNavQueryString = str_replace(array('AJAX_CALL','sorterchange'),'n',$strNavQueryString);
		$strNavQueryStringFull = str_replace(array('AJAX_CALL','sorterchange'),'n',$strNavQueryStringFull);
		
		if($bPrevDisabled)
		{
			?><span class="left arrow" rel="prev"><i class="icon pngicons"></i></span><?
		} else {
			?><a class="left arrow" rel="prev" href="<?=$sPrevHref;?>"><i class="icon pngicons"></i></a><?
		}
		
		$bFirst = true;
		$bPoints = false;
		do
		{
			if ($arResult["nStartPage"] <= 2 || $arResult["nEndPage"]-$arResult["nStartPage"] <= 1 || abs($arResult['nStartPage']-$arResult["NavPageNomer"])<=2)
			{

				if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
					?><span class="current"><?=$arResult["nStartPage"]?></span><?
				elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):
					?><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a><?
				else:
					?><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a><?
				endif;
				$bFirst = false;
				$bPoints = true;
			}
			else
			{
				if ($bPoints)
				{
					?>...<?
					$bPoints = false;
				}
			}
			$arResult["nStartPage"]++;
		} while($arResult["nStartPage"] <= $arResult["nEndPage"]);
	
		if($bNextDisabled)
		{
			?><span class="right arrow" rel="next"><i class="icon pngicons"></i></span><?
		} else {
			?><a class="right arrow" rel="next" href="<?=$sNextHref;?>"><i class="icon pngicons"></i></a><?
		}
	}
?></div></div>
