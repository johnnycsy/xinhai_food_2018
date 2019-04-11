<?php
/**
 * Created by PhpStorm.
 * User: johnny
 * Date: 2018/9/25
 * Time: 21:47
 */
include_once dirname(dirname(__FILE__)) . "/common/header.php";
include_once dirname(dirname(__FILE__)) . "/common/left_main.php";
?>

<table class="table table-hover fe_maintb">
    <thead class="thead-dark fe_tbtop">
    <tr>
        <th scope="col" width="100px">序号</th>
        <th scope="col">图片</th>
        <th scope="col">小菜名称</th>
        <th scope="col">销售价格</th>
        <th scope="col" width="100px">操作</th>
    </tr>
    </thead>
    <tbody class="fe_main">
    <!--
       <tr>
            <th scope="row">1</th>
            <td><img src="http://yhj.image.qiniu.xinhaiip.cn/favicon.ico" class="img-thumbnail"></td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>编辑 | 删除</td>
        </tr>
    -->
    </tbody>
</table>
<!--
<div class="fepage text-center">
    <nav aria-label="Page ">
        <ul class="pagination">

        </ul>
    </nav>
</div>
-->
<div class="fe_next">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link"
                   href="food_edit.php?navname=foodedite&page=<?php echo isset($_GET["page"]) ? ((int)($_GET["page"]) > 1 ? (int)($_GET["page"]) - 1 : 1) : 1; ?>">上一页</a>
            </li>
            <!--        <li class="page-item"><a class="page-link" href="#">1</a></li>-->
            <!--        <li class="page-item"><a class="page-link" href="#">2</a></li>-->
            <!--        <li class="page-item"><a class="page-link" href="#">3</a></li>-->
            <a class="page-link"
               href="food_edit.php?navname=foodedite&page=<?php echo isset($_GET["page"]) ? ((int)($_GET["page"]) >= 1 ? (int)($_GET["page"]) + 1 : 2) : 2; ?>">下一页</a>

        </ul>
    </nav>
</div>

<script>
    var page = '<?php echo isset($_GET["page"]) ? trim($_GET["page"]) : 1; ?>';
</script>
<?php
include_once dirname(dirname(__FILE__)) . "/common/footer.php";
?>
<script src="<?php echo DF_JS . "food_edit.js"; ?>"></script>
