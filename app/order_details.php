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
    <link rel="stylesheet" href="css/framework7-icons.css">
    <link rel="stylesheet" href="fonts/iconfont.css">
    <link rel="stylesheet" href="css/my-app.css?<?php echo date("H"); ?>">
</head>
<body>

<div id="app">
    <div class="statusbar"></div>

    <div class="view view-main">
        <div data-name="order_details" class="page bg-color-white">

            <div class="toolbar tabbar">
                <div class="toolbar-inner">
                    <a href="#" class="tab-link tab-link-active f7-icons back" data-force="true" data-ignore-cache="true">chevron_left</a>
                </div>
            </div>

            <div class="page-content no-padding-top">

                <div class="block no-margin padding">
                    <ul class="od_ul">
                        <li><span>桌号：</span><span class="od_desk"></span></li>
                        <li><span>订单号：</span><span class="od_orderno"></span></li>
                        <li><span>提交时间：</span><span class="od_times"></span></li>
                    </ul>
                </div>

                <div class="data-table">
                    <table>
                        <thead>
                        <tr class="bg-color-gray">
                            <th class="label-cell text-color-white text-align-center">菜品数量：<span class="sum_num"></span>
                            </th>
                            <th class="numeric-cell text-color-white text-align-center">小菜数量：<span
                                        class="sum_number"></span></th>
                            <th class="numeric-cell text-color-white text-align-center">金额总计：<span
                                        class="sum_price"></span></th>
                        </tr>
                        </thead>
                    </table>
                </div>

                <table class="order_list">
                    <!--
                                        <tr>
                                            <td class="label-cell order_img"><img src=""></td>
                                            <td class="numeric-cell text-align-left">
                                                <h2 class="no-padding no-margin">productname</h2>
                                                <div class="text-color-red order_price no-margin no-padding">
                                                    <h6 class="no-padding no-margin">￥</h6>
                                                    <h2 class="no-padding no-margin">0.00</h2>
                                                </div>
                                            </td>
                                            <td class="numeric-cell text-align-right">x 1111</td>
                                        </tr>
                    -->
                </table>


            </div>

        </div>
    </div>
</div>

<script type="text/javascript" src="lib/js/framework7.min.js"></script>
<script type="text/javascript" src="js/scirpt.js?<?php echo date("H"); ?>"></script>
<script type="text/javascript" src="js/my-app.js?<?php echo date("H"); ?>"></script>

</body>
</html>
