<?php
/**
 * Created by PhpStorm.
 * User: johnny - 应汉炯 - QQ：271802190
 * Date: 2019/1/2
 * Time: 19:03
 *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *
 */
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
    <link rel="stylesheet" href="fonts/iconfont.css">
    <link rel="stylesheet" href="css/my-app.css?<?php echo date("H"); ?>">
</head>
<body>

<div id="app">
    <div class="statusbar"></div>

    <div class="view view-main">
        <div data-name="order" class="page">

            <div class="toolbar tabbar">
                <div class="toolbar-inner">
                    <a href="#" class="tab-link tab-link-active f7-icons back" data-force="true" data-ignore-cache="true">chevron_left</a>
                </div>
            </div>

            <!-- Scrollable page content -->
            <div class="page-content no-margin-top padding-top myorder_list">
                <!--
                                <div class="card">
                                    <div class="card-content card-content-padding">
                                        <div>桌号：</div>
                                        <div>订单号：</div>
                                        <div>
                                            <span>菜品数量：</span>
                                            <span>金额总计：</span>
                                        </div>
                                    </div>
                                    <div class="card-header">
                                        <div>下单时间</div>
                                        <div class="text-align-right"><button class="col button button-fill">查看详情</button></div>
                                    </div>
                                </div>
                -->
            </div>

        </div>
    </div>
</div>

<script type="text/javascript" src="lib/js/framework7.min.js"></script>
<script type="text/javascript" src="js/scirpt.js?<?php echo date("H"); ?>"></script>
<script type="text/javascript" src="js/my-app.js?<?php echo date("H"); ?>"></script>

</body>
</html>
