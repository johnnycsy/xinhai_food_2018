<?php
/**
 * @Created by PhpStorm PHP Version 7.2.2
 * @Project : 通用形类
 * @User : johnny（应汉炯）
 * @Date : 2019/2/18
 * @Time : 10:36
 * @Server：服务器信息
 * @Language  PHP
 * =============================================================
 * @Versions : 1.0.0
 * =============================================================
 * 说明：常用类
 * =============================================================
 */
include_once dirname(dirname(__FILE__)) . "/common/header.php";
include_once dirname(dirname(__FILE__)) . "/common/left_main.php";
?>

    <div class="od_top">
        <div class="od_print">打印当前订单</div>
    </div>

    <div class="foodmenu">
        <ul class="food_table_print">
            <li></li>
        </ul>
    </div>

<?php
include_once dirname(dirname(__FILE__)) . "/common/footer.php";
?>
<script src="<?php echo DF_JS . 'food_today.js?'.date("i"); ?>"></script>
