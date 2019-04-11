$(function () {

    /*新增数据事件*/
    $(".dt_addnewbut").click(function () {
        let lengths = Number($(".dt_val tr").length) + 1;
        newVal = '<tr>' +
            '<th scope="row">' + lengths + '</th>' +
            '<td>' +
            '<input style="display: none;" class="form-control" id="tablecode" readonly value="' + xh.getRandomNum(0, 999999) + "" + lengths + '">' +
            '<input class="form-control" id="table_name" placeholder="桌号名称"></td>' +
            '<td class="diningflex">' +
            '<button type="button" class="btn btn-primary food_cancel_but">取消</button>' +
            '<button type="button" class="btn btn-primary fooddtnewinsertbut">添加</button>' +
            '</td>' +
            '</tr>';
        $(".dt_val").append(newVal);
        $(this).hide();
    });

    /*取消新增数据样式*/
    $(".dt_val").on("click", ".food_cancel_but", function () {
        let target = $(this).closest("tr");
        target.remove();
        $(".dt_addnewbut").show();
    });

    //保存数据
    $(".dt_val").on("click", ".fooddtnewinsertbut", function () {
        let postdata = {
            "appid": appid,
            "apikey": apikey,
            "operation": "foodTableInsertNew",
            "fd_code": $("#tablecode").val(),
            "fd_name": $("#table_name").val(),
            "fd_order": "0",
            "state": "0",
        }, rs = xh.getPost(postdata);
        console.log(rs);
        console.log(postdata);
        if (rs.code === 0) {
            window.location.reload();
        } else {
            xh.getToast("Error：" + rs.data);
        }
    })

});

//数据初始化
var pageInitData = function () {
    let rsHtml = "", stData = "", stNum = 1,
        postData = {
            "appid": appid,
            "apikey": apikey,
            "operation": "QueryTableAllList",
        }, rs = xh.getPost(postData);
    console.log(rs);
    if (rs.code === 0) {
        stData = rs.data;
        for (let i = 0; i < stData.length; i++) {
            let obj = stData[i];
            rsHtml += '<tr>' +
                '<th scope="row">' + (stNum++) + '</th>' +
                '<td class="text-left">' + obj.fd_name + '</td>' +
                '<td><span data-id="' + obj.id + '">修改</span> | <span data-dataid="' + obj.id + '">删除</span></td>' +
                '</tr>';
        }
        $(".dt_val").html(rsHtml);
    } else {
        xh.getToast("Error " + rs.data);
    }
};

$(".dt_val").on("click", "span", function () {
    var _this = $(this),
        id = _this.attr("data-id"),
        deleteid = _this.attr("data-dataid");
    console.log(id)
    console.log(deleteid)
    if (typeof id != "undefined") {
        xh.getToast("此功能未开放")
    }
    if (typeof deleteid != undefined) {
        xh.getToast("此功能未开放")
    }
});

window.onload = function () {
    pageInitData();
};