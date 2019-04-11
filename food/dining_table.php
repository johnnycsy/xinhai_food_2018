<?php
/**
 * Created by PhpStorm.
 * User: johnny
 * Date: 2018/10/4
 * Time: 22:21
 */
include_once dirname(dirname(__FILE__)) . "/common/header.php";
include_once dirname(dirname(__FILE__)) . "/common/left_main.php";
?>

<table class="table table-hover text-center dt_table">
    <thead>
    <tr>
        <th scope="col" style="width: 100px;">序号</th>
        <th scope="col" class="text-left">桌号</th>
        <th scope="col" style="width: 100px;">操作</th>
    </tr>
    </thead>
    <tbody class="dt_val"></tbody>
</table>

<div class="text-right">
    <a href="#" class="btn btn-primary btn-lg active dt_addnewbut" role="button" aria-pressed="true">新添餐桌</a>
</div>

<!--
<div class="dt_fixed">
    <div class="jumbotron">
        <h1 class="display-4">Hello, world!</h1>
        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
        <hr class="my-4">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
        </p>
    </div>
</div>
-->

<?php
include_once dirname(dirname(__FILE__)) . "/common/footer.php";
?>
<script src="<?php echo DF_JS . "dining_table.js"; ?>"></script>
