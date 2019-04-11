$(function () {

//点击图片事件
    $(".foodnew_image").on("click", "img", function () {
        let _this = $(this), target = _this.attr("data-input");
        $("#food_xinhai_" + target).click();
    });

    for (let i = 1; i < 6; i++) {
        $("#food_xinhai_" + i).change(function () {
            var objUrl = xh.getObjectURL(this.files[0]);
            if (objUrl) {
                $(".food_xinhai_" + i).attr("src", objUrl);
            }
        });
    }

//   上传事件
    $(".foodnewaddbut").click(function () {
        let fm_name = $("#fm_name").val(),
            fm_bazaar = $("#fm_bazaar").val(),
            fm_price = $("#fm_price").val(),
            fm_class = $("#fm_class").val(), img1 = "", img2 = "", img3 = "", img4 = "", img5 = "", targetImgTF = false;
        //进行数据判断
        if (fm_class === 0 || fm_name === "" || fm_price === "") {
            xh.getToast("关键信息不能为空");
            return false;
        }
        if (isNaN(fm_price)) {
            xh.getToast("销售价格须要填写数字");
            return false;
        }
        for (let i = 1; i < 6; i++) {
            let tTF = $("#food_xinhai_" + i).val();
            if (tTF !== "") {
                targetImgTF = true;
            }
        }
        if (targetImgTF === false) {
            xh.getToast("图片至少上传一张");
            return false;
        }
        //图片上传至七牛，并进行返回
        for (let i = 1; i < 6; i++) {
            let targetImg = $("#food_xinhai_" + i).val();
            if (targetImg !== "") {
                let img = getImgPullQiNiuGo("#form" + 1);
                if (img) {
                    console.log(img);
                    switch (i) {
                        case 1:
                            img1 = img.key;
                            break;
                        case 2:
                            img2 = img.key;
                            break;
                        case 3:
                            img3 = img.key;
                            break;
                        case 4:
                            img4 = img.key;
                            break;
                        case 5:
                            img5 = img.key;
                            break;
                        default:
                            break;
                    }
                }
            }
        }
        //    进行上传保存事件
        let postDB = {
            "appid": appid,
            "apikey": apikey,
            "operation": "insertFoodNewGreens",
            "img1": img1,
            "img2": img2,
            "img3": img3,
            "img4": img4,
            "img5": img5,
            "fm_name": fm_name, //菜品名称
            "fm_bazaar": fm_bazaar, //市场价
            "fm_price": fm_price, //销售价
            "fm_class": fm_class, //所属分类
        }, rs = xh.getPost(postDB);
        console.log(rs);
        // if (rs.code == 6301) {
        //     xh.getToast("此菜已存在");
        //     return false;
        // }
        if (rs.code === 0) {
            xh.getToast("添加成功");
            xh.getLoadingShow();
            setTimeout(function () {
                window.location.href = skipHref;
            }, 2000)
        } else {
            xh.getToast("添加失败；" + rs.msg + ":" + rs.code)
        }
    })

});

//上传七牛图片
var getImgPullQiNiuGo = function (target) {
    let rs = "";
    $(target).ajaxSubmit({
        success: function (data) {
            // console.log(data);
            rs = data;
        },
        error: function (error) {
            // console.log(error);
            rs = data;
        },
        async: false,
        url: 'http://upload.qiniup.com/', /*设置post提交到的页面*/
        type: "post", /*设置表单以post方法提交*/
        dataType: "json" /*设置返回值类型为文本*/
    });
    return rs;
};

//初始化获取菜口分类
var foodClassNameShowList = function () {
    let postDB = {
        "appid": appid,
        "apikey": apikey,
        "operation": "queryClassName",
    }, rs = xh.getPost(postDB), rsHtml = '<option value="0">请选择菜品分类</option>';
    // console.log(rs);
    if (rs.code === 0) {
        (rs.data).forEach(function (obj) {
            rsHtml += '<option value="' + obj.id + '">' + obj.fc_name + '</option>';
        });
        $("#fm_class").html(rsHtml);
    } else {
        xh.getToast("菜品分类；数据读取失败！")
    }
};

var qiniuToken = "";
window.onload = function () {
    foodClassNameShowList();
    qiniuToken = xh.getQiNiuToken();
    $("input[name=token]").val(qiniuToken);
};