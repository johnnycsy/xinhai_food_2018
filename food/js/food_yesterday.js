var getFoodYesTerDayPage = function () {

    /*打印事件*/
    $(".od_print").click(function () {
        $(".foodmenu").printArea();
    });

    /*菜品分类显示*/
    var pageDataShow = function (obj) {
        console.log(obj);
        var i, rsHtml = "", classArr = [];
        for (i = 0; i < obj.length; i++) {
            var rs = obj[i];
            if (classArr.indexOf(rs.foodClass) < 0) {
                classArr.push(rs.foodClass);
                rsHtml += '<li style="width: 100%;background: #D9D9D9;">' + rs.foodClass + '</li>' +
                    '<li><span>' + rs.foodName + '</span><span>(' + rs.foodSum + ')</span><span style="font-weight: bold;color: red;">' + rs.deskAll + '</span></li>';
            } else {
                rsHtml += '<li><span>' + rs.foodName + '</span><span>(' + rs.foodSum + ')</span><span style="font-weight: bold;color: red;">' + rs.deskAll + '</span></li>';
            }
        }
        $(".food_table_print").html(rsHtml);
    };

    /*获取数据*/
    var data = {
        "appid": appid,
        "apikey": apikey,
        "operation": "QueryFoodPointsMenu",
        "qtime": "yesterday",
    }, pageObj = xh.getPost(data);
    // console.log(pageObj)
    if (pageObj.code == 0) {
        pageDataShow(pageObj.data);
    } else {
        xh.getToast("数据获取失败");
    }

};

window.onload = function () {
    getFoodYesTerDayPage();
};