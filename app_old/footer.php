<script>
    var appid ="<?php echo $app_key["appid"]; ?>",
        ms ="<?php echo $app_key["ms"]; ?>",
        appkey ="<?php echo $app_key["key"]; ?>",
        httpApi = "<?php echo HTTP_API; ?>";
</script>

<script type="text/javascript" src="./lib/js/framework7.min.js"></script>
<script type="text/javascript" src="./js/global.js"></script>
<script type="text/javascript" src="./js/my-app.js?t=<?php echo date("s"); ?>"></script>
<script type="text/javascript" src="./js/index.js?t=<?php echo date("s"); ?>"></script>
</body>
</html>