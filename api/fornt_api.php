<?php
/**
 * Created by PhpStorm.
 * User: johnny
 * Date: 2018/10/11
 * Time: 21:55
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * ms ： 提交时间需要判断，如果超过非当天，就失效。
 * appid ： 随机生成数
 * key ： 加密值
 */
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include_once dirname(dirname(__FILE__)) . "/control/ForntControl.php";
$rs = new ForntControl();

$operation = isset($_POST["operation"]) ? trim($_POST["operation"]) : "";
$appid = isset($_POST["appid"]) ? trim($_POST["appid"]) : "";
$ms = isset($_POST["ms"]) ? trim($_POST["ms"]) : "";
$appkey = isset($_POST["appkey"]) ? trim($_POST["appkey"]) : "";

$date = floor((time() - strtotime($ms)) / 86400);

//取加密KEY值
$serverKey = $rs->getKey($appid);
//判断提交KEY值是否正确
if ($serverKey !== $appkey) {
    $rsJson = $rs->getReturnJson(4000, $serverKey . "==" . $appkey);
    die($rsJson);
}
//判断提交时间是否正确
if ($date > 1) {
    $rsJson = $rs->getReturnJson(4000, "TIME");
    die($rsJson);
}

/*接口调用*/
switch ($operation) {
    //获取商品分类；商品信息
    case "QueryUserLogin": //查询用户登录后所有信息
        echo $rs->getQueryUserLogin();
        break;
    case "InsertCartAddNumber":
        echo $rs->getInsertCartAddNumber(); //加入购物车
        break;
    case "QueryDescAll"://查询所有餐桌信息
        echo $rs->getQueryDescAll();
        break;
    case "AddDeskMy"://加入餐桌
        echo $rs->getAddDeskMy();
        break;
    case "ConfirmOrder": //提交订单
        echo $rs->getConfirmOrder();
        break;
    case "QueryOrderDetails": //查询订单详情
        echo $rs->getQueryOrderDetails();
        break;
    case "QueryOrderTimeList":  //按时间查询订单信息
        echo $rs->getQueryOrderTimeList();
        break;
    case "YeaderOrderPrice":  //按月查询所有帐单信息
        echo $rs->getYeaderOrderPrice();
        break;
    default:
        echo $rs->getReturnJson(4000, "Error Server");
        break;
}

