var getPageUserDesk = function () {

    showDeskList = function (obj) {
        var i, rsHtml = "";
        console.log(obj)
        for (i = 0; i < obj.data.length; i++) {
            var rs = obj.data[i], desk = "";
            rsHtml += '<div class="ud-list"><div>桌号：' + rs.deskName + '</div>';
            // console.log(rsHtml)
            for (var n = 0; n < rs.deskRank.length; n++) {
                if (rs.deskRank[n] == "1") {
                    desk = "桌长";
                } else {
                    desk = "　　";
                }
                rsHtml += '<div>' +
                    '<span>' + rs.nickname[n] + '</span>' +
                    '<span>' + desk + '</span>' +
                    '<span class="remove_desk" data-userid="' + rs.userId[n] + '" data-deskid="' + rs.deskId + '" data-deskrank="' + rs.deskRank[n] + '">移除</span>' +
                    '<span class="set_desk" data-userid="' + rs.userId[n] + '" data-deskid="' + rs.deskId + '" data-deskrank="' + rs.deskRank[n] + '">设为桌长</span>' +
                    '</div>';
            }
            rsHtml += '</div>';
            // console.log(rsHtml)
        }
        // console.log(rsHtml)
        $(".ud-main").html(rsHtml);
    };

    var data = {
        "appid": appid,
        "apikey": apikey,
        "operation": "QueryUserDeskAll",
    }, pageObj = xh.getPost(data);
    // console.log(pageObj)
    showDeskList(pageObj);

    /*设置为桌长*/
    $(".ud-main").on("click", ".set_desk", function () {
        var postdata = {
            "appid": appid,
            "apikey": apikey,
            "operation": "UpdateUseDeskRand",
            "userid": $(this).attr("data-userid"),
            "deskid": $(this).attr("data-deskid"),
        }, obj = xh.getPost(postdata);
        console.log(obj)
        if (obj.code === 0) {
            window.location.reload();
        } else {
            xh.getToast("设置失败");
        }
    });

    /*移除用户*/
    $(".ud-main").on("click", ".remove_desk", function () {
        var postdata = {
            "appid": appid,
            "apikey": apikey,
            "operation": "DeleteUserDesk",
            "userid": $(this).attr("data-userid"),
            "deskid": $(this).attr("data-deskid"),
            "deskrank": $(this).attr("data-deskrank"),
        }, obj = xh.getPost(postdata);
        console.log(obj)
        if (obj.code === 0) {
            window.location.reload();
        } else {
            xh.getToast("设置失败");
        }
    });

};
window.onload = function () {
    getPageUserDesk();
};