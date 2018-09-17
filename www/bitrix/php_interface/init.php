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