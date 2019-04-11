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
    <link rel="stylesheet" href="css/my-app.css">
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
                    <a href="/details/" class="panel-close">今日订单</a>
                </li>
                <li>
                    <a href="/order/all" class="panel-close">历史订单</a>
                </li>
                <li>
                    <a href="/price/" class="panel-close">价格统计</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="view view-main">
        <div data-name="home" class="page">

            <div class="navbar ">
                <div class="navbar-inner my_navbar">
                    <div class="left">
                        <a href="#" class="link panel-open iconfont icon-liebiaoxuanze-"></a>
                    </div>
                    <div class="title my_add_desk">加入餐桌<span class="iconfont icon-Right navbar_icon"></span></div>
                    <div class="right">
                        <a href="#" class="link iconfont icon-sousuo"></a>
                    </div>
                </div>
            </div>

            <div class="toolbar">
                <div class="toolbar-inner my_toolbar">
                    <span href="#" class="link iconfont icon-gouwuche1 my_toolbar_cart popup-open"
                          data-popup=".popup-cart">
                        <span class="badge color-red my_cart">0</span>
                    </span>
                    <dd class="my_toolbar_show">
                        <div>￥<span class="cart_sum_price">0.00</span></div>
                        <div class="my_toolbar_show_ft">总计</div>
                    </dd>
                    <a href="#" class="link my_submit">确认点菜</a>
                </div>
            </div>

            <div class="page-content">

                <div class="my_content bg-color-white">
                    <div class="my_left">
                        <ul id="my_lefit">

                            <!--
                            <li class="my_select" data-food_class="0">热卖菜品</li>
                            -->

                        </ul>
                    </div>
                    <div class="my_right">
                        <ul id="my_right">
                            <!--
                            <li>
                                <div class="my_img"></div>
                                <div class="my_val">
                                    <div class="my_title">菜名</div>
                                    <div class="my_price">￥<span>0.00</span></div>
                                    <div class="my_number">
                                        <div class="my_minus iconfont icon-minus-circle"></div>
                                        <input class="my_numbers" value="0" readonly="readonly">
                                        <div class="my_plus iconfont icon-plus-circle"></div>
                                    </div>
                                </div>
                            </li>
                            -->
                        </ul>
                    </div>
                </div>

                <div class="popup popup-cart">
                    <div class="close_cart no-margin">
                        <!--cart list-->
                        <div class="cart_list">
                            <div class="data-table">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="label-cell">已选商品</th>
                                        <th class="numeric-cell"></th>
                                        <th class="numeric-cell " width="30%">清空</th>
                                    </tr>
                                    </thead>
                                    <tbody id="cart_list">
                                    <!--
                                                                        <tr>
                                                                            <td class="label-cell">商品名称</td>
                                                                            <td class="numeric-cell text-color-red">￥0.00</td>
                                                                            <td class="numeric-cell">
                                                                                <div class="my_number">
                                                                                    <div class="my_minus iconfont icon-minus-circle"></div>
                                                                                    <input class="my_numbers" value="0" readonly="readonly">
                                                                                    <div class="my_plus iconfont icon-plus-circle"></div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                    -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--toolbar-->
                        <div class="toolbar">
                            <div class="toolbar-inner my_toolbar">
                                <span href="#" class="link iconfont icon-gouwuche1 my_toolbar_cart popup-close">
                                    <span class="badge color-red my_cart">0</span>
                                </span>
                                <dd class="my_toolbar_show">
                                    <div>￥<span class="cart_sum_price">0.00</span></div>
                                    <div class="my_toolbar_show_ft">总计</div>
                                </dd>
                                <a href="#" class="link my_submit">确认点菜</a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<?php echo $script; ?>
<script type="text/javascript" src="lib/js/framework7.min.js"></script>
<script type="text/javascript" src="js/scirpt.js"></script>
<script type="text/javascript" src="js/my-app.js"></script>
</body>
</html>
