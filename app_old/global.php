<?php
/**
 * Created by PhpStorm.
 * User: johnny
 * Date: 2018/10/15
 * Time: 22:23
 */
include_once dirname(dirname(__FILE__)) . "/control/ForntControl.php";
$rs = new ForntControl();
//post 交互KEY
$app_key = $rs->getKeyReturn();

//全局域名配置,接口
define("HTTP_WWW", "http://192.168.1.103/");
define("HTTP_API", HTTP_WWW . "food_www2018/api/fornt_api.php");
?>