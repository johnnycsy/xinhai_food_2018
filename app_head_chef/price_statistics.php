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
    <link rel="stylesheet" href="css/my-app.css">
</head>
<body>

<div id="app">
    <div class="statusbar"></div>

    <div class="view view-main">

        <div data-name="price_statistics" class="page bg-color-white">

            <div class="navbar">
                <div class="navbar-inner">
                    <div class="title price_title popover-open" data-popover=".popover-time">
                        <span class="price_times"><?php echo date("Y-m") ?></span>
                        <span class="f7-icons">chevron_down</span>
                    </div>
                    <div class="right">
                        <a href="#" class="link">总价：<h6>￥</h6><span class="price_sum"></span></a>
                    </div>
                </div>
            </div>

            <div class="toolbar tabbar">
                <div class="toolbar-inner">
                    <a href="#" class="tab-link tab-link-active f7-icons back" data-force="true"
                       data-ignore-cache="true">chevron_left</a>
                </div>
            </div>

            <!-- Scrollable page content -->
            <div class="page-content">

                <ul class="price_list">
                    <!--
                                        <li>
                                            <div>时间</div>
                                            <div class="text-align-right">￥0.00</div>
                                        </li>
                    -->
                </ul>

            </div>

            <div class="popover popover-time">
                <div class="popover-inner">
                    <div class="list price_target_time">
                        <ul>
                            <?php
                            $liHtml = "";
                            $end = date("m");
                            for ($i = 1; $i <= $end; $i++) {
                                $litime = date("Y-");
                                if (strlen($i) < 2) {
                                    $n = "0" . $i;
                                } else {
                                    $n = $i;
                                }
                                $liHtml .= '<li><a class="list-button item-link popover-close" href="#">' . $litime . $n . '</a></li>';
                            }
                            echo $liHtml;
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<script type="text/javascript" src="lib/js/framework7.min.js"></script>
<script type="text/javascript" src="js/scirpt.js"></script>
<script type="text/javascript" src="js/my-app.js"></script>

</body>
</html>
