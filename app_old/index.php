<?php
include_once "header.php";
/*用户授权后数据*/
$openid = isset($_GET["openid"]) ? trim($_GET["openid"]) : null;
$unionid = isset($_GET["unionid"]) ? trim($_GET["unionid"]) : null;
if ($openid != "") echo "<script>localStorage.openid='" . $openid . "';localStorage.unionid='" . $unionid . "'</script>";
?>

<div id="app">
    <div class="statusbar"></div>

    <div class="view view-main">
        <div data-name="index" class="page">

            <!--NAVBAR-->
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="left">
                        <a class="link panel-open navbar_right" data-panel="left">
                            <div class="head_protrait wechat_icon"></div>
                        </a>
                    </div>
                    <div class="title">
                        <a class="link popover-open" href="#" data-popover=".popover-links">
                            <i class="f7-icons link_pro_right">sort</i>
                            <span class="pro_show_name">所有菜品</span>
                        </a>
                    </div>
                    <div class="right panel-open" data-panel="right">
                        <i class="iconfont navbar_right icon-airudiantubiaohuizhi-zhuanqu_meishicaipu"></i>
                    </div>
                </div>
            </div>

            <!--CLASS-->
            <div class="popover popover-links">
                <div class="popover-inner">
                    <div class="list">
                        <ul id="food_class">
                            <!--
                                                        <li><a class="list-button item-link popover-close" href="#" data-id="0">所有菜品</a></li>
                                                        <li><a class="list-button item-link popover-close" href="#">Link 2</a></li>
                                                        <li><a class="list-button item-link popover-close" href="#">Link 3</a></li>
                                                        <li><a class="list-button item-link popover-close" href="#">Link 4</a></li>
                            -->
                        </ul>
                    </div>
                </div>
            </div>

            <!--LEFT-->
            <div class="panel panel-left panel-cover bg-color-gray color-theme-white color-white side_box_main side_relative">
                <!--头像-->
                <div class="text-color-white">
                    <div class="navbar bg-color-gray">
                        <div class="navbar-inner">
                            <div class="left">
                                <div class="head_protrait bg-color-white wechat_icon"></div>
                                <div class="user_name wechat_name">微信呢称</div>
                            </div>
                            <div class="right">
                                <i class="panel-close icon f7-icons">close_round</i>
                            </div>
                        </div>
                    </div>
                </div>
                <!--列表信息-->
                <div class="list no-margin">
                    <ul>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-f7"></i></div>
                                <div class="item-inner font_size12">
                                    <div class="item-title">城市</div>
                                    <div class="item-after wechat_area"></div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-f7"></i></div>
                                <div class="item-inner font_size12">
                                    <div class="item-title">性别</div>
                                    <div class="item-after wechat_sex"></div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-f7"></i></div>
                                <div class="item-inner font_size12">
                                    <div class="item-title">地址</div>
                                    <div class="item-after wechat_address"></div>
                                </div>
                            </div>
                        </li>
                        <li class="panel-close food_day">
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-f7"></i></div>
                                <div class="item-inner font_size12">
                                    <div class="item-title">今日订单</div>
                                    <div class="item-after f7-icons iconfize">chevron_right</div>
                                </div>
                            </div>
                        </li>
                        <li class="panel-close food_month">
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-f7"></i></div>
                                <div class="item-inner font_size12">
                                    <div class="item-title">本月订单</div>
                                    <div class="item-after f7-icons iconfize">chevron_right</div>
                                </div>
                            </div>
                        </li>
                        <li class="">
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-f7"></i></div>
                                <div class="item-inner font_size12">
                                    <div class="item-title">我的餐桌</div>
                                    <div class="item-after"><span class="badge color-blue desk_name">未入桌</span></div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <!--底部信息-->
                <div class="left_bottom text-align-center"> 新海集团·商务智能部</div>
            </div>

            <!--RIGHT-->
            <div class="panel panel-right panel-cover bg-color-orange side_box_main">
                这边是购物车
            </div>

            <!--PAGE CONTENT-->
            <div class="page-content bg-color-white">
                <!--START-->
                <div class="block margin-top margin-bottom pro_list">
                    <div class="row flex-lg-wrap" id="food_goods">
                        <!--list start-->
                        <!--
                                                <div class="col pro_list_li margin-bottom">
                                                    <ul>
                                                        <li class="pro_img"><img src=""></li>
                                                        <li>
                                                            <div class="block margin-top no-margin-bottom">菜名</div>
                                                        </li>
                                                        <li>
                                                            <div class="pro_list_padding text-color-red">
                                                                <div class="pro_lp">
                                                                    <span>￥</span>
                                                                    <h2 class="no-margin">88.00</h2>
                                                                </div>
                                                                <div class="f7-icons text-color-red pro_lp_but">add_round_fill</div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                        -->
                        <!--list end-->
                    </div>
                </div>

                <!--fab but add desk-->
                <div class="fab fab-left-bottom color-orange food_desk_add">
                    <a href="#">
                        <i class="iconfont icon-TIFFANYSROOM_huaban"></i>
                    </a>
                </div>
                <!--END-->
            </div>

        </div>
    </div>
</div>

<?php include_once "footer.php"; ?>
