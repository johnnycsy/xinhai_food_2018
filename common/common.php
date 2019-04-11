<?php
/**
 * Created by PhpStorm.
 * User: johnny
 * Date: 2018/9/23
 * Time: 14:03
 */
define("DF_CSS", "./css/");
define("DF_CSS_LIB", "./lib/css/");
define("DF_FONTS", "./lib/fonts/");
define("DF_JS", "./js/");
define("DF_JS_LIB", "./lib/js/");
//KEY值生成 接口信息
$appid = str_pad(mt_rand(0, 999999999999), 12, "0", STR_PAD_BOTH);
$redirect_url = "http://www.xinhai.com/foodwww/";
$apiKey = md5(md5(md5($redirect_url . $appid)));
//define("LINK_API_SRC", "http://" . $_SERVER["HTTP_HOST"] . "/xh_food_order/on-line/api/back_api.php");
define("LINK_API_SRC", "http://wcphp172.xinhaimobile.cn/xh_food_order/on-line/api/back_api.php"); //临时更改
//参数图片
define("DF_IMAGE_BOOTSTRAP", "data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1660bbf6825%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1660bbf6825%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2274.4296875%22%20y%3D%22104.5%22%3E200x200%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E");
define("DF_IMAGE_LINK", "http://yhj.image.qiniu.xinhaiip.cn/");
//导航链接
define("LINK_QINIU_TOKEN", "http://wcphp172.xinhaimobile.cn/api/qiniu/");
define("LINK_NAV_SYSTEM", "./home.php");
define("LINK_NAV_FOODCLASS", "./food_class.php?navname=foodclass");
define("LINK_NAV_FOODNEW", "./food_new.php?navname=foodnew");
define("LINK_NAV_FOODEDIT", "./food_edit.php?navname=foodedite");
define("LINK_NAV_DININGTABLE", "./dining_table.php?navname=foodtable");
define("LINK_NAV_ORDERDAY", "./order_day.php?navname=orderday");
define("LINK_NAV_YESTERDAY", "./order_yester.php?navname=yesterday");
define("LINK_NAV_MONTH", "./order_month.php?navname=ordermonth");
define("LINK_NAV_YEADORDER", "./order_year.php?navname=orderyear");
define("LINK_NAV_FOODTODAY", "./food_today.php?navname=foodtoday");
define("LINK_NAV_FOODYESTERDAY", "./food_yesterday.php?navname=foodyesterday");
define("LINK_NAV_FOODUSERDESK", "./user_desk.php?navname=userdesk");

//导航默认颜色
$globalNav = isset($_GET["navname"]) ? trim($_GET["navname"]) : "";
$foodTodayOrder = "";
$foodYesTerDayOrder = "";
$foodMonthOrder = "";
$foodYearOrder = "";
$foodClass = "";
$foodNew = "";
$foodEdite = "";
$foodDesk = "";
$foodHome = "";
$userdesk = "";
switch ($globalNav) {
    case "foodclass":
        $foodClass = "active";
        break;
    case "foodnew":
        $foodNew = "active";
        break;
    case "foodedite":
        $foodEdite = "active";
        break;
    case "foodtable":
        $foodDesk = "active";
        break;
    case "orderday":
        $foodTodayOrder = "active";
        break;
    case "yesterday":
        $foodYesTerDayOrder = "active";
        break;
    case "ordermonth":
        $foodMonthOrder = "active";
        break;
    case "orderyear":
        $foodYearOrder = "active";
        break;
    case "foodtoday":
        $foodtoday = "active";
        break;
    case "foodyesterday":
        $foodyesterday = "active";
        break;
    case "userdesk":
        $userdesk = "active";
        break;
    default:
        $foodHome = "active";
        break;
}