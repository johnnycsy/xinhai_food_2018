$(function () {
//确认添加事件
    $(".foodclassaddbut").click(function () {
        let stVal = $("#foodclassname").val();
        if (stVal == "" || stVal == null) {
            xh.getToast("菜品名称不能为空，请仔细填写");
            return false;
        }
        xh.getLoadingShow();
        let postDB = {
            "appid": appid,
            "apikey": apikey,
            "operation": "addFoodClass",
            "classname": stVal,
        }, rs = xh.getPost(postDB);
        // console.log(rs);
        if (rs.code === 0) {
            xh.getToast("菜品分类添加成功!");
            foodClassNameShowList();
        } else {
            xh.getToast("菜品分类添加失败! " + rs.msg);
        }
    });

//    监听INPUT 更改数据事件
    $(".foodclass_addnewname").on("blur", "input", function () {
        let _this = $(this), id = _this.attr("data-id"), order = _this.attr("data-order"), targetVal = _this.val(), rs;
        if (order !== targetVal) {
            rs = getFoodClassNameOrderUpdate(id, order, targetVal);
            console.log(rs);
            if (rs.code === 0) {
                xh.getToast("顺序设定成功！");
                _this.attr("data-order", targetVal);
            } else {
                xh.getToast("顺序设定失败！")
            }
        }
    });

    /*双击修改分类名称*/
    $(".foodclass_addnewname").on("dblclick", "th", function () {
        var _this = $(this),
            id = _this.attr("data-id"),
            rsHtml = '<div class="update_class_name">' +
                '<div class="jumbotron">' +
                '<h1>修改分类名称</h1>' +
                '<p><input class="form-control update_food_class_name_input" data-id="' + id + '"></p>' +
                '<p>' +
                '<a class="btn btn-primary btn-lg food_class_but_cancel" href="#" role="button">取消操作</a> ' +
                '<a class="btn btn-primary btn-lg food_class_but_submit" href="#" role="button">确认修改</a>' +
                '</p>' +
                '</div>' +
                '</div>';
        $("#foodmain").append(rsHtml);
    });

    $("body").on("click", ".food_class_but_cancel", function () {
        $(".update_class_name").remove();
    });
    $("body").on("click", ".food_class_but_submit", function () {
        var _this = $(".update_food_class_name_input"),
            id = _this.attr("data-id"),
            classname = _this.val();
        if (id == "" || classname == "") {
            alert("参数错误");
            return false;
        }
        getFoodClassNameUpdate(id, classname);

    });


});
//更改指定分类显示顺序
var getFoodClassNameOrderUpdate = function (id, order, val) {
    let postDB = {
        "appid": appid,
        "apikey": apikey,
        "operation": "updateFoodClassNameOrderUpdate",
        "id": id,
        "orderNumber": order,
        "target": val,
    }, rs = xh.getPost(postDB);
    return rs;
};

/*修改分类名称*/
var getFoodClassNameUpdate = function (id, name) {
    var postDb = {
        "appid": appid,
        "apikey": apikey,
        "operation": "updateFoodClassNameUpdate",
        "id": id,
        "classname": name,
    }, rs = xh.getPost(postDb);
    console.log(postDb);
    console.log(rs);
    if (rs.code === 0) {
        window.location.reload();
    } else {
        alert("修改失败");
    }
};

//查询当前所有类目名称
var foodClassNameShowList = function () {
    let postDB = {
        "appid": appid,
        "apikey": apikey,
        "operation": "queryClassName",
    }, rs = xh.getPost(postDB), rsHtml = "";
    // console.log(rs);
    if (rs.code === 0) {
        (rs.data).forEach(function (obj) {
            rsHtml += '<tr>' +
                '<th scope="row" data-id="' + obj.id + '">' + obj.fc_name + '</th>' +
                '<td class="text-center">' +
                '<input class="w-50 text-center" data-id="' + obj.id + '" data-order="' + obj.fc_order + '" value="' + obj.fc_order + '">' +
                '</td>' +
                '</tr>';
        });
        $(".foodclass_addnewname").html(rsHtml);
    } else {
        xh.getToast("菜品分类；数据读取失败！")
    }
};

window.onload = function () {
    foodClassNameShowList();
};