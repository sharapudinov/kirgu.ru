<?php
/**
 * Created by PhpStorm.
 * User: shara
 * Date: 03.09.2018
 * Time: 16:09
 */

function test_dump($arg){
    global $USER;
    if($USER->IsAdmin()){
        echo "<pre>";
        var_dump($arg);
        echo "</pre>";
    }
}
class Vitrina
{

    private static $instance;

    private $vitrina;

    private function __construct()
    {

        $filter = [
            'UF_VITRINA' => '1'
        ];
        $select = [
            'ID'

        ];

        $this->vitrina = array_map(function ($item) {
            return $item['ID'];
        },
            \Bitrix\Catalog\StoreTable::getList(
                [
                    'filter' => $filter,
                    'select' => $select
                ]
            )->fetchAll()
        );
    }

    public static function getInstance()
    {
        if (!is_set(self::$instance)) self::$instance = new Vitrina();
        return self::$instance;
    }

    public function isVitrina($store_id)
    {
        return in_array($store_id, self::getInstance()->vitrina);
    }
}
class StoreAmount
{

    private $amount;

    public function __construct($elementId)
    {

        $filter = [
            'PRODUCT_ID' => $elementId,
            '>AMOUNT' => '0'
        ];
        $select = [
            '*'
        ];

        $this->amount = \Bitrix\Catalog\StoreProductTable::getList(
            [
                'filter' => $filter,
                'select' => $select
            ]
        )->fetchAll();
    }



    public function isVitrina()
    {
        foreach ($this->amount as $store_amount) {
            if ($store_amount['AMOUNT'] > 2 || !Vitrina::getInstance()->isVitrina($store_amount['STORE_ID']) && $store_amount['AMOUNT'] == 2)
                return false;
        }
        return count($this->amount)>0;
    }
}

class IblockSection {
    public static function wantCheaperPermittedForParent($section_id){

    }
}
