<?php
/**
 * Created by PhpStorm.
 * User: johnny - 应汉炯 - QQ：271802190
 * Date: 2018/12/31
 * Time: 15:35
 *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *
 */
include_once dirname(dirname(__FILE__)) . "/control/ForntControl.php";
$rs = new ForntControl();

//post 交互KEY
$app_key = $rs->getKeyReturn();

/*全局定义 API地址*/
define("HTTP_WWW", "http://wcphp172.xinhaimobile.cn/xh_food_order/on-line/");
define("HTTP_API", HTTP_WWW . "api/fornt_api.php");

/*GET*/
$operid = isset($_GET["openid"]) ? trim($_GET["openid"]) : "";
$unionid = isset($_GET["unionid"]) ? trim($_GET["unionid"]) : "";

/*script*/
$script = '
<script>
    var appid ="' . $app_key["appid"] . '",
        ms ="' . $app_key["ms"] . '",
        appkey ="' . $app_key["key"] . '",
        httpApi = "' . HTTP_API . '";
    localStorage.openid="' . $operid . '";
    localStorage.unionid="' . $unionid . '";
</script>
';

