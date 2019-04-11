<?php
/**
 * @Created by PhpStorm PHP Version 7.2.2
 * @Project : 通用形类
 * @User : johnny（应汉炯）
 * @Date : 2019/1/21
 * @Time : 13:38
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
<table class="table">
    <thead>
    <tr>
        <th class="w-25">上传新菜信息</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>选择分类</td>
        <td>
            <select class="form-control w-50" id="fm_class">
                <option value="0">请选择菜品分类</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>菜品名称</td>
        <td><input type="email" class="form-control" id="fm_name" placeholder="填写上传菜品名称"></td>
    </tr>
    <tr>
        <td>市场价格</td>
        <td><input type="email" class="form-control w-25" id="fm_bazaar" placeholder="选填"></td>
    </tr>
    <tr>
        <td>销售价格</td>
        <td><input type="email" class="form-control w-25" id="fm_price" placeholder="市场销售价格"></td>
    </tr>
    <tr>
        <td>上传菜品图片</td>
        <td class="foodnew_image">
            <?php
            for ($i = 1; $i < 6; $i++) {
                $numval = "food_2018_" . $i . date("mdHis") . mt_rand(1000, 9999);
                echo '<img src="' . DF_IMAGE_BOOTSTRAP . '" class="img-thumbnail food_xinhai_' . $i . '"  data-input="' . $i . '">
                <form id="form' . $i . '" method="post" action="http://upload.qiniup.com/" enctype="multipart/form-data">
                    <input name="key" type="hidden" value="' . $numval . '">
                    <input name="x:<' . $numval . '>" type="hidden" value="' . $numval . '">
                    <input name="token" type="hidden" value="<upload_token>">
                    <input type="file" id="food_xinhai_' . $i . '" name="file">
                </form>';
            }
            ?>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <button type="button" class="btn btn-primary btn-lg foodnewaddbut">上传小菜</button>
        </td>
    </tr>
    </tbody>
</table>

<?php
include_once dirname(dirname(__FILE__)) . "/common/footer.php";
?>
<script>var skipHref = "<?php echo LINK_NAV_FOODEDIT; ?>", foodId = "<?php echo $_GET["id"] ?>",
        qiniu = "<?php echo DF_IMAGE_LINK;?>";</script>
<script src="<?php echo DF_JS . "food_edit_start.js"; ?>"></script>