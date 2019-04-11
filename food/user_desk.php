<?php
/**
 * Created by PhpStorm.
 * User: johnny - 应汉炯 - QQ：271802190
 * Date: 2019/2/20
 * Time: 20:32
 *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *
 * @Purpose：错误码设定
 * @Method Name：setConn()
 * @Param：
 * @Author：johnny
 * @Return：返回正常链接状态
 */
include_once dirname(dirname(__FILE__)) . "/common/header.php";
include_once dirname(dirname(__FILE__)) . "/common/left_main.php";
?>

<div class="ud-main">
    <div class="ud-list">
        <div>桌号：</div>
        <div><span>姓名</span><span>桌长</span></div>
        <div><span>姓名</span><span>桌长</span></div>
        <div><span>姓名</span><span>桌长</span></div>
        <div><span>姓名</span><span>桌长</span></div>
        <div><span>姓名</span><span>桌长</span></div>
        <div><span>姓名</span><span>桌长</span></div>
    </div>
</div>

<?php
include_once dirname(dirname(__FILE__)) . "/common/footer.php";
?>
<script src="<?php echo DF_JS . "user_desk.js"; ?>"></script>