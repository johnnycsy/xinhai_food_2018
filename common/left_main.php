<?php
/**
 * Created by PhpStorm.
 * User: johnny
 * Date: 2018/9/23
 * Time: 14:17
 */
?>
<div class="container-fluid">
    <div class="row">

        <nav class="col-md-2 d-none d-md-block bg-light sidebar food_nav">
            <div class="sidebar-sticky">

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>系统设置</span><span class="iconfont icon-discount-coupon_icon"></span>
                </h6>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $foodHome; ?>" href="<?php echo LINK_NAV_SYSTEM; ?>">
                            <span class="iconfont icon-copy_icon"></span>
                            基本设置
                        </a>
                    </li>
                </ul>
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>分菜单</span><span class="iconfont icon-discount-coupon_icon"></span>
                </h6>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $foodtoday; ?>" href="<?php echo LINK_NAV_FOODTODAY; ?>">
                            <span class="iconfont icon-copy_icon"></span>
                            今日分菜单
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $foodyesterday; ?>" href="<?php echo LINK_NAV_FOODYESTERDAY; ?>">
                            <span class="iconfont icon-copy_icon"></span>
                            昨日分菜单
                        </a>
                    </li>
                </ul>
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>订单管理</span><span class="iconfont icon-discount-coupon_icon"></span>
                </h6>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $foodTodayOrder; ?>" href="<?php echo LINK_NAV_ORDERDAY; ?>">
                            <span class="iconfont icon-copy_icon"></span>
                            今日订单
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $foodYesTerDayOrder; ?>" href="<?php echo LINK_NAV_YESTERDAY; ?>">
                            <span class="iconfont icon-copy_icon"></span>
                            昨日订单
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $foodMonthOrder; ?>" href="<?php echo LINK_NAV_MONTH; ?>">
                            <span class="iconfont icon-calendar_icon"></span>
                            本月订单
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $foodYearOrder; ?>" href="<?php echo LINK_NAV_YEADORDER; ?>">
                            <span class="iconfont icon-bath_towel_icon"></span>
                            历史订单
                        </a>
                    </li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>菜品管理中心</span><span class="iconfont icon-discount-coupon_icon"></span>
                </h6>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $foodClass; ?>" href="<?php echo LINK_NAV_FOODCLASS; ?>">
                            <span class="iconfont icon-fruit_icon"></span>
                            菜品分类
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $foodNew; ?>" href="<?php echo LINK_NAV_FOODNEW; ?>">
                            <span class="iconfont icon-upload_icon"></span>
                            上传新菜
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $foodEdite; ?>" href="<?php echo LINK_NAV_FOODEDIT; ?>">
                            <span class="iconfont icon-pan_icon"></span>
                            编辑小菜
                        </a>
                    </li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>其它设置</span><span class="iconfont icon-discount-coupon_icon"></span>
                </h6>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $foodDesk; ?>" href="<?php echo LINK_NAV_DININGTABLE; ?>">
                            <span class="iconfont icon-transition_icon"></span>
                            餐桌管理
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $userdesk; ?>" href="<?php echo LINK_NAV_FOODUSERDESK; ?>">
                            <span class="iconfont icon-transition_icon"></span>
                            用户换桌
                        </a>
                    </li>
                </ul>

            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4" id="foodmain">


