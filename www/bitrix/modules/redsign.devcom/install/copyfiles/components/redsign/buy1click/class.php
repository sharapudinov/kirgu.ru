<?php
use Bitrix\Main,
    Bitrix\Main\Loader,
    Bitrix\Sale,
    Bitrix\Sale\Order,
    Bitrix\Main\Localization\Loc,
    Bitrix\Main\Config\Option,
    Bitrix\Main\Mail\Event,
    Bitrix\Main\Context,
    Bitrix\Sale\Delivery,
    Bitrix\Sale\PaySystem;

Loc::loadMessages(__FILE__);

Loader::includeModule('sale');

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class buyOneClick extends \CBitrixComponent
{

    public function onPrepareComponentParams($arParams)
    {
        global $APPLICATION,$USER;

        if ($arParams["EVENT_TYPE"] == "")
            $arParams["EVENT_TYPE"] = "REDSIGN_BUY_ONE_CLICK";

        $arParams["REQUEST_PARAM_NAME"] = "redsign_buy1click";

        if ($USER->IsAuthorized())
            $arParams["ALFA_USE_CAPTCHA"] = "N";

        return $arParams;
  }

    protected function getAllProps()
    {

        // take prop for template
        $arResult =& $this->arResult;
        $allProps = array();
        $dbPerson = CSalePersonType::GetList(array("SORT" => "ASC", "NAME" => "ASC"), array('ACTIVE' => 'Y'));

        while ($arPerson = $dbPerson->GetNext()) {

            $dbProp = CSaleOrderProps::GetList(
                array("SORT" => "ASC", "NAME" => "ASC"),
                array("PERSON_TYPE_ID" => $arPerson["ID"])
            );

            while ($arProp = $dbProp->Fetch()) {
                if ($arProp["IS_LOCATION"] == 'Y') {
                    continue;
                }

                if (in_array($arProp["ID"], $this->arParams["SHOW_FIELDS"])) {
                    $arProp["REQUIRED_FIELDS"] = "N";
                    if (in_array($arProp["ID"], $this->arParams["REQUIRED_FIELDS"])) {
                        $arProp["REQUIRED_FIELDS"] = "Y";
                    }
                    $arResult["SHOW_FIELDS"][] = $arProp;
                }
            }
        }
    }

    public function addMailTypeRedsign($eventType)
    {

        //create mail template (deprecated)
        global $DB, $DBType, $APPLICATION;

        $return = false;
        $et = new CEventType;
        $EventTypeID = $et->Add(array(
            "LID"           => "ru",
            "EVENT_NAME"    => $eventType,
            "NAME"          => Loc::getMessage("RS.BUY1CLICK.INSTALL_EVENT_TYPE_NAME"),
            "DESCRIPTION"   => Loc::getMessage("RS.BUY1CLICK.INSTALL_EVENT_TYPE_DESCRIPTION")
          )
        );

        if ($EventTypeID > 0) {

            $arSites = array();
            $rsSites = CSite::GetList($by="sort", $order="desc", array());
            while ($arSite = $rsSites->Fetch()) {
                $arSites[] = $arSite["LID"];
            }
            $arr["ACTIVE"] = "Y";
            $arr["EVENT_NAME"] = $eventType;
            $arr["LID"] = $arSites;
            $arr["EMAIL_FROM"] = "#AUTHOR_EMAIL#";
            $arr["EMAIL_TO"] = "#EMAIL_TO#";
            $arr["BCC"] = "";
            $arr["SUBJECT"] = "#THEME#";
            $arr["BODY_TYPE"] = "text";
            $arr["MESSAGE"] = Loc::getMessage("RS.BUY1CLICK.INSTALL_EVENT_TEMPLATE_BODY");

            $emess = new CEventMessage;
            $EventTemplateID = $emess->Add($arr);

            if ($EventTemplateID > 0) {
                $return = true;
            }

        } else {
            $return = false;
        }

        return $return;
    }

    protected function captchaInclude()
    {

        include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");
        $cpt = new CCaptcha();
        $captchaPass = Option::get("main", "captcha_password", "");

        if (strlen($captchaPass) <= 0) {
            $captchaPass = randString(10);
            Option::set("main", "captcha_password", $captchaPass);
        }

        $cpt->SetCodeCrypt($captchaPass);

        return htmlspecialchars( $cpt->GetCodeCrypt() );

    }


    public function getPropertyByCode($propertyCollection, $code)
    {
        foreach ($propertyCollection as $property) {
            if($property->getField('ORDER_PROPS_ID') == $code)
                return $property;
        }

    }

    protected function itemInfo($item)
    {
        global $USER;

        // fu***ng measure ratio, can't get from ::getlist
        $itemAdd = \Bitrix\Catalog\ProductTable::getCurrentRatioWithMeasure(intval($item["ID"]));
        $itemInfo["QUANTITY"] = $itemAdd[$item["ID"]]["RATIO"];
        $itemInfo["NAME"] = $item["NAME"];
        $itemInfo["PRODUCT_XML_ID"] = $item["XML_ID"];
        $itemInfo["DETAIL_PAGE_URL"] = $item["DETAIL_PAGE_URL"];
        $itemInfo["CATALOG_XML_ID"] = $item["IBLOCK_EXTERNAL_ID"];

        $arPrice = CCatalogProduct::GetOptimalPrice(
            $item["ID"],
            $itemInfo["QUANTITY"],
            $USER->GetUserGroupArray()
        );

        if (isset($arPrice['RESULT_PRICE'])) {
            //check $order->setBasket for discount
            //$itemInfo['PRICE'] = $arPrice['RESULT_PRICE']['BASE_PRICE'];
            $itemInfo['PRICE'] = $arPrice['RESULT_PRICE']['DISCOUNT_PRICE'];
            $itemInfo['CURRENCY'] = $arPrice['PRICE']['CURRENCY'];
        }

        $itemInfo['PRODUCT_PROVIDER_CLASS'] = "CCatalogProductProvider";

        return $itemInfo;
    }

    protected function addBasketItems($basket)
    {
        $orderIds = $this->request["RS_ORDER_IDS"];

        //$basket = \Bitrix\Sale\Basket::create($this->siteId);

        $idsItems = explode(",", $orderIds);
        $intIdsItems = array();

        foreach ($idsItems as $arItemStr) {

            $arItemStr = intval($arItemStr);

            if ($arItemStr < 1)
                continue;

            array_push($intIdsItems, $arItemStr);
        }

        $countIds = count($intIdsItems);

        $arSelect = Array("ID", "NAME", "xml_id", "DETAIL_PAGE_URL", "IBLOCK_EXTERNAL_ID");
        $arFilterId = array("ID"=> $intIdsItems);
        $res = CIBlockElement::GetList(Array(), $arFilterId, false, Array("nPageSize"=>$countIds), $arSelect);

        while ($ob = $res->GetNextElement()) {

            $arFields = $ob->GetFields();
            $basketItem = $basket->createItem('catalog', $arFields["ID"]);
            $fieldItem = $this->itemInfo($arFields);
            $basketItem->setFields($fieldItem);
        }

        return $basket;
    }

    private function doOrder()
    {
        global $USER;

        $arResult =& $this->arResult;
        $currencyCode = Option::get('sale', 'default_currency', 'RUB');

        //$userId = $this->arParams["USER_ORDER"];


        //if user !authorized, do anonym order
        // \Bitrix\Sale\Compatible\DiscountCompatibility::stopUsageCompatible();

        if ($USER->IsAuthorized()) {
            $userId = $USER->GetId();
            $sUserId = \Bitrix\Sale\Fuser::getId($userId);
            $order = Order::create($this->siteId, $userId);
            // $basket = Sale\Basket::create($this->siteId);
        } else {
            $order = Order::create($this->siteId, \CSaleUser::GetAnonymousUserID());
            // $basket = Sale\Basket::loadItemsForFUser(\CSaleBasket::GetBasketUserID(), $this->siteId);
        }

        $basket = Sale\Basket::create($this->siteId);
        $basket = $basket->getOrderableItems();

        $basketItems = $this->addBasketItems($basket);

        $order->setPersonTypeId($this->arParams["ALFA_SALE_PERSON"]);

        $order->setBasket($basketItems);

        /*      delivery        */

        $shipmentCollection = $order->getShipmentCollection();
        $shipment = $shipmentCollection->createItem();
        $shipmentItemCollection = $shipment->getShipmentItemCollection();
        $shipment->setField('CURRENCY', $order->getCurrency());
        foreach ($order->getBasket() as $item)
        {
            $shipmentItem = $shipmentItemCollection->createItem($item);
            $shipmentItem->setQuantity($item->getQuantity());
        }
        $arDeliveryServiceAll = Delivery\Services\Manager::getRestrictedObjectsList($shipment);
        $shipmentCollection = $shipment->getCollection();

        if (!empty($arDeliveryServiceAll)) {
            reset($arDeliveryServiceAll);
            $deliveryObj = current($arDeliveryServiceAll);

            if ($deliveryObj->isProfile()) {
                $name = $deliveryObj->getNameWithParent();
            } else {
                $name = $deliveryObj->getName();
            }

            $shipment->setFields(array(
                'DELIVERY_ID' => $deliveryObj->getId(),
                'DELIVERY_NAME' => $name,
                'CURRENCY' => $order->getCurrency()
            ));

            $shipmentCollection->calculateDelivery();
        }

        /*        /Delivery         */

        /*    Payment     */
        $arPaySystemServiceAll = array();
        $paySystemId = 1;
        $paymentCollection = $order->getPaymentCollection();

        $remainingSum = $order->getPrice() - $paymentCollection->getSum();

        if ($remainingSum > 0 || $order->getPrice() == 0)
        {
            $extPayment = $paymentCollection->createItem();
            $extPayment->setField('SUM', $remainingSum);
            $arPaySystemServices = PaySystem\Manager::getListWithRestrictions($extPayment);

            $arPaySystemServiceAll += $arPaySystemServices;

            if (array_key_exists($paySystemId, $arPaySystemServiceAll))
            {
                $arPaySystem = $arPaySystemServiceAll[$paySystemId];
            }
            else
            {
                reset($arPaySystemServiceAll);

                $arPaySystem = current($arPaySystemServiceAll);
            }

            if (!empty($arPaySystem))
            {
                $extPayment->setFields(array(
                    'PAY_SYSTEM_ID' => $arPaySystem["ID"],
                    'PAY_SYSTEM_NAME' => $arPaySystem["NAME"]
                ));
            }
            else
                $extPayment->delete();
        }


        $order->doFinalAction(true);

        $propertyCollection = $order->getPropertyCollection();

        foreach ($arResult["SHOW_FIELDS"] as $arField) {
            if (strlen(trim($this->request[$arField["CODE"]] != "")) > 0) {
                $property = $this->getPropertyByCode($propertyCollection, $arField["ID"]);
                $val = htmlspecialcharsbx(trim($this->request[$arField["CODE"]]));
                if ($property) {
                    $property->setValue($val);
                }
            }
        }

        $order->setField('CURRENCY', $currencyCode);

        $idOrder = $order->save();

        $orderId = $idOrder->getId();
        $arOrder = CSaleOrder::GetByID($orderId);
        $this->arResult["GOOD_ORDER_ID"] = $arOrder["ACCOUNT_NUMBER"];
        $this->arResult["GOOD_ORDER_TEXT"] = Loc::getMessage("SUCCESS_ORDER_ID", array("#ORDER_ID#"=>$arOrder["ACCOUNT_NUMBER"]));
    }

    public function doAction()
    {
        $arResult =& $this->arResult;

        $arEventFields = array();
        $arEventFields["C_FIELDS"]["THEME"] = Loc::getMessage("ALFA_MSG_THEME");
        $arEventFields["C_FIELDS"]["EMAIL_TO"] = trim($this->arParams["ALFA_EMAIL_TO"]);
        $arEventFields["LID"] = $this->siteId;

        foreach ($arResult["SHOW_FIELDS"] as $key => $arField) {

            $arEventFields["C_FIELDS"][$arField["EVENT_FIELD_NAME"]] = trim($this->request[$arField["CODE"]]);

            if (in_array($arField["ID"], $this->arParams["REQUIRED_FIELDS"])) {

                    if (strlen(trim($this->request[$arField["CODE"]])) <= 1) {
                        $arResult["LAST_ERROR"] = Loc::getMessage("ALFA_MSG_EMPTY_REQUIRED_FIELDS");
                    } elseif ($arField["IS_EMAIL"] == "Y") {
                            if (!filter_var(trim($this->request[$arField["CODE"]]), FILTER_VALIDATE_EMAIL))
                                $arResult["LAST_ERROR"] = Loc::getMessage("WRONG_EMAIL");
                    }

            }
        }

        if (\Bitrix\Main\ModuleManager::isModuleInstalled('sale')  && $this->request["RS_ORDER_IDS"] != "") {
            if ($arResult["LAST_ERROR"]=="") {
                $this->doOrder();
                $arResult["GOOD_SEND"] = "Y";
            }

        } else {
            if (strlen($this->request["RS_AUTHOR_ORDER_LIST"]) < 5)
                $arResult["LAST_ERROR"] = Loc::getMessage("RS.BUY1CLICK.ERROR_ITEM");

            if ($arResult["LAST_ERROR"]=="") {
                $arFilter = array("TYPE_ID" => $this->arParams["EVENT_TYPE"], "LID" => "ru");
                $rsET = CEventType::GetList($arFilter);
                if (!$arET = $rsET->Fetch()) {
                    $this->addMailTypeRedsign($this->arParams["EVENT_TYPE"]);
                }

                $arEventFields["LID"] = $this->arParams["EVENT_TYPE"];

                try {
                    $sendMess = Event::send($arEventFields);
                } catch (Exception $e) {
                    echo "ooops, some trouble ".$e->getMessage();
                }
                $arResult["GOOD_SEND"] = "Y";
            }
        }

  }

    protected function buyClickAjax()
    {
        global $APPLICATION, $USER;

        $arResult =& $this->arResult;

        $arResult["LAST_ERROR"] = "";
        $arResult["GOOD_SEND"] = "";

        if (check_bitrix_sessid() && !isset($this->request["PARAMS_HASH"]) || $arResult["PARAMS_HASH"] === $this->request["PARAMS_HASH"]) {

            if ($this->arParams["ALFA_USE_CAPTCHA"] == "Y") {

                if (strlen($this->request["captcha_word"])<1 && strlen($this->request["captcha_sid"])<1) {
                    $arResult["LAST_ERROR"] = Loc::getMessage("ALFA_MSG_CAPTCHA_EMPRTY");
                } elseif (!$APPLICATION->CaptchaCheckCode($this->request["captcha_word"], $this->request["captcha_sid"])) {
                    $arResult["LAST_ERROR"] = Loc::getMessage("ALFA_MSG_CAPTCHA_WRONG");
                }
            }

            if ($arResult["LAST_ERROR"]=="") {
                $this->doAction();
            }
            foreach($arResult["SHOW_FIELDS"] as $key => $arField) {
                $arResult["SHOW_FIELDS"][$key]["HTML_VALUE"] = $this->request[$arField["CODE"]];
            }
            foreach($arResult["SYSTEM_FIELDS"] as $key => $arField) {
                $arResult["SYSTEM_FIELDS"][$key]["HTML_VALUE"] = $this->request[$arField["CODE"]];
            }
        } else {
          $arResult["LAST_ERROR"] = Loc::GetMessage("ALFA_MSG_OLD_SESS");
        }
    }

    public function executeComponent()
    {
        global $APPLICATION,$USER;

        $arResult =& $this->arResult;

        $this->setFrameMode(false);
        $this->context = Main\Application::getInstance()->getContext();
        $this->checkSession = check_bitrix_sessid();
        $this->siteId = \Bitrix\Main\Context::getCurrent()->getSite();

        $isAjaxRequest = $this->request["redsign_buy1click"] == "Y";
        $arResult["PARAMS_HASH"] = md5(serialize($this->arParams).$this->GetTemplateName());
        $arResult["ACTION_URL"] = $APPLICATION->GetCurPage();
        $arResult["SYSTEM_FIELDS"][]["CODE"] = "RS_ORDER_IDS";
        $arResult["SYSTEM_FIELDS"][]["CODE"] = "RS_AUTHOR_ORDER_LIST";
        $this->getAllProps();

        if ($this->arParams["ALFA_USE_CAPTCHA"] == "Y")
            $arResult["CATPCHA_CODE"] = $this->captchaInclude();

        if ($isAjaxRequest)
            $this->buyClickAjax();

        $this->includeComponentTemplate();
    }
}
