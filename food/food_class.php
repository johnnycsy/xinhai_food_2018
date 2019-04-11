<?php
/**
 * Created by PhpStorm.
 * User: johnny
 * Date: 2018/9/23
 * Time: 15:24
 */
include_once dirname(dirname(__FILE__)) . "/common/header.php";
include_once dirname(dirname(__FILE__)) . "/common/left_main.php";
?>


<div class="container">
    <div class="row">
        <div class="col-sm">
            <div class="form-group">
                <label for="exampleInputEmail1">菜品分类名称</label>
                <input type="email" class="form-control" id="foodclassname" placeholder="请输入菜品名称">
                <small id="emailHelp" class="form-text text-muted">菜品分类名称，不能多于30个字</small>
            </div>
            <div class="text-right">
                <button type="button" class="btn btn-primary foodclassaddbut">确认添加分类</button>
            </div>
        </div>
        <div class="col-sm border">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">菜品分类<span style="margin-left: 1rem;color: rgba(0,0,0,0.3);">双击名称可进行修改</span></th>
                    <th scope="col" class="text-center w-25">显示顺序</th>
                </tr>
                </thead>
                <tbody class="foodclass_addnewname">
                <!--
                <tr>
                    <th scope="row">这是小菜名称</th>
                    <td class="text-center"><input class="w-50 text-center"></td>
                </tr>
                -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include_once dirname(dirname(__FILE__)) . "/common/footer.php";
?>
<script src="<?php echo DF_JS . 'food_class.js'; ?>"></script>
