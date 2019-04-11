<?php
/**
 * Created by PhpStorm.
 * User: johnny - 应汉炯 - QQ：271802190
 * Date: 2018/12/31
 * Time: 13:51
 *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *
 */
include_once dirname(dirname(__FILE__)) . "/app/global.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui, viewport-fit=cover">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#2196f3">
    <link rel="icon" href="http://yhj.image.qiniu.xinhaiip.cn/favicon.ico">
    <title>新海食堂 · 微点餐</title>
    <link rel="stylesheet" href="lib/css/framework7.min.css">
    <link rel="stylesheet" href="css/framework7-icons.css">
    <link rel="stylesheet" href="fonts/iconfont.css">
    <link rel="stylesheet" href="css/my-app.css?<?php echo date("is"); ?>">
</head>
<body>

<div id="app">

    <div class="statusbar"></div>

    <div class="panel panel-left panel-reveal bg-color-black my_panel">
        <!-- panel-close -->
        <div class="my_message bg-color-white">
            <img src="" class="my_header">
            <span class="my_name">微信名称</span>
            <span class="my_close panel-close iconfont icon-guanbi"></span>
        </div>
        <div class="list links-list no-margin">
            <ul>
                <li>
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-title">我的餐桌</div>
                            <div class="item-after desk_name">未加入餐桌</div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-title">桌长</div>
                            <div class="item-after desk_rankname"></div>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="/order/<?php echo date("Y-m-d H:i:s") ?>" class="panel-close">今日订单</a>
                </li>
                <li>
                    <a href="/order/all" class="panel-close">历史订单</a>
                </li>
                <li>
                    <a href="/price/<?php echo date("Y-m"); ?>" class="panel-close">价格统计</a>
                </li>
            </ul>
        </div>
        <div class="text-color-white in_bottom_left text-align-center padding-top padding-bottom">新海·商务智能部</div>
    </div>

    <div class="view view-main">
        <div data-name="index" class="page">

            <div class="page-content">

            </div>

        </div>
    </div>
</div>

<?php echo $script; ?>
<script type="text/javascript" src="lib/js/framework7.min.js"></script>
<script type="text/javascript" src="js/scirpt.js?<?php echo date("is"); ?>"></script>
<script type="text/javascript" src="js/my-app.js?<?php echo date("is"); ?>"></script>
</body>
</html>