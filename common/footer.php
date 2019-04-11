<?php
/**
 * Created by PhpStorm.
 * User: johnny
 * Date: 2018/9/23
 * Time: 13:56
 */
?>

</main>
</div>
</div>

<div class="food_toast">
    <div class="alert alert-danger text-center" role="alert"></div>
</div>

<div class="food_loading">
    <div class="iconfont icon-loading_icon text-center"></div>
</div>

<!--JAVASCRIPT START-->
<script>
    var apiqiniu = "<?php echo LINK_QINIU_TOKEN; ?>",
        imgLink = "<?php echo DF_IMAGE_LINK; ?>",
        appid = "<?php echo $appid; ?>",
        apikey = "<?php echo $apiKey;  ?>",
        apiSrc = "<?php echo LINK_API_SRC; ?>";
</script>
<script src="<?php echo DF_JS_LIB . "jquery-3.3.1.min.js"; ?>"></script>
<script src="<?php echo DF_JS_LIB . "jquery.PrintArea.min.js"; ?>"></script>
<script src="<?php echo DF_JS_LIB . "jquery.form.min.js"; ?>"></script>
<!--<script src="https://cdn.jsdelivr.net/gh/jquery-form/form@4.2.2/dist/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>-->
<script src="<?php echo DF_JS_LIB . "bootstrap.min.js"; ?>"></script>
<script src="<?php echo DF_JS . "global.inc.js"; ?>"></script>
<script src="<?php echo DF_JS . "food.js"; ?>"></script>
<!--JAVASCRIPT END-->

</body>
</html>
