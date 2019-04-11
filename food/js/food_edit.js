$(function () {

});

$(".fe_main").on("click", "span", function () {
    var _this = $(this),
        id = _this.attr("data-id"),
        deleid = _this.attr("data-deleid");
    if (typeof id != "undefined") {
        window.location.href = 'food_edit_start.php?navname=foodedite&id=' + id;
    }

    if (typeof deleid != "undefined") {
        // window.location.href = '';
        xh.getToast("暂未开放此功能")
    }
});

var getFoodEditInitDb = function () {
    let postDB = {
        "appid": appid,
        "apikey": apikey,
        "operation": "foodQueryAllList",
        "page": page,
    }, rs = xh.getPost(postDB), rsHtml = "", pagev, phtml = "";
    console.log(rs);
    if (rs.code === 0) {
        pagev = rs.data.pagenum;
        rs = rs.data.list;
        let id = 0, num = 0;
        if (page > 1) {
            num = (page - 1) * 10;
        }
        for (let i = 0; i < rs.length; i++) {
            let obj = rs[i];
            if (obj.id != id) {
                num++;
                rsHtml +=
                    '<tr>' +
                    '<th scope="row">' + num + '</th>' +
                    '<td><img src="' + imgLink + obj.fm_pic + '" class="img-thumbnail"></td>' +
                    '<td>' + obj.fm_name + '</td>' +
                    '<td>' + obj.fm_price + '</td>' +
                    '<td><span data-id="' + obj.id + '">编辑</span> | <span data-deleid="' + obj.id + '">删除</span></td>' +
                    '</tr>';
            }
            id = obj.id;
        }
        let pn = 0;
        for (let i = 0; i < pagev.length; i++) {
            phtml += '<li class="page-item"><a class="page-link" href="#">' + (pn++) + '</a></li>';
        }
        $(".fe_main").html(rsHtml);
        // $(".fepage .pagination").html(phtml);
    }
};

window.onload = function () {
    getFoodEditInitDb();
};