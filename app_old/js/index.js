function getIndexPage() {
    var user_id = false,//用户ID
        wechatLogin = false, //登录状态
        wechat_id = null, //用户ID
        desk_id = false,//餐桌ID
        desk_name = false;  //餐桌名称

    /*点击购物车事件*/
    $("#food_goods").on("click", ".pro_lp_but", function () {
        if (wechatLogin === false) {
            gs.getNotification("温馨提示", "登录失败", "你当前是未登录状态，请登录后操作");
            return false;
        }
        // console.log(desk_id);
        if (desk_id === false || desk_id == "" || desk_id == null || !desk_id) {
            gs.getNotification("温馨提示", "加购失败", "请在我的个人中心选择餐桌");
            return false;
        }
        let _this = $(this),
            id = _this.attr("data-id"),
            postdata = {
                "appid": appid,
                "ms": ms,
                "appkey": appkey,
                "openid": localStorage.openid,
                "unionid": localStorage.unionid,
                "operation": "InsertCartAddNumber",
                "food_id": id,
                "user_id": user_id,
                "desk_id": desk_id,
            };
        gs.getPreloaderShow();
        app.request({
            url: httpApi,
            async: true,
            method: "POST",
            // dataType: "JSON",
            timeout: 3000,
            data: postdata,
            success: function (data, status, xhr) {
                console.log(data);
                let rs = gs.getJson(data);
                if (rs.code === 0) {
                    // getGoods(rs.data.goods);
                    // getGoodsClass(rs.data.goodsClass);
                    // getUser(rs.data.user[0]);
                } else {
                    gs.getNotification("温馨提示", "获取数据失败", "当前数据获取为空");
                    return false;
                }
                gs.getPreloaderHide();
            }, error: function (xhr, status) {
                gs.getNotification("温馨提示", "获取数据失败", status);
                gs.getPreloaderHide();
            }
        });

    });

    /*选择加入餐桌*/
    var descData = [], descVal = [];
    var pickerDevice = app.picker.create({
        inputEl: '.food_desk_add',
        rotateEffect: true,
        renderToolbar: function () {
            return '<div class="toolbar">' +
                '<div class="toolbar-inner">' +
                '<div class="left">' +
                '<a href="#" class="link toolbar-randomize-link"></a>' +
                '</div>' +
                '<div class="right">' +
                '<a href="#" class="link sheet-close popover-close desc_select">确认</a>' +
                '</div>' +
                '</div>' +
                '</div>';
        },
        cols: [
            {
                textAlign: 'center',
                values: descVal,  //目标ID
                displayValues: descData,  //显示参数
                onChange: function (picker, country) {
                    let targetVal = picker.cols[0],
                        value = targetVal.value,
                        showv = targetVal.displayValue;
                    console.log(value)
                    console.log(showv)
                    $(".food_desk_add").attr("data-id", value)
                    $(".food_desk_add").attr("data-name", showv)
                },
            }
        ],
    });
    const pageDescAll = function () {
        let postData = {
            "appid": appid,
            "ms": ms,
            "appkey": appkey,
            "openid": localStorage.openid,
            "unionid": localStorage.unionid,
            "operation": "QueryDescAll",
        };
        app.request.post(httpApi, postData, function (data) {
            let obj = JSON.parse(data);
            console.log(obj);
            if (obj.code === 0) {
                for (let i = 0; i < obj.data.length; i++) {
                    let rs = obj.data[i];
                    // descData[i] = rs.fd_name;
                    // descVal[i] = rs.id;
                    descData.push(rs.fd_name);
                    descVal.push(rs.id);
                }
                // console.error(descData)
                // console.error(descVal)
                $(".food_desk_add").show();
            } else {
                gs.getNotification("温馨提示", "操作失败", "获取数据失败：" + obj.msg);
            }
        });
    };
    $("body").on("click", ".desc_select", function () {
        let target = $(".food_desk_add").attr("data-id"),
            names = $(".food_desk_add").attr("data-name"),
            postData = {
                "appid": appid,
                "ms": ms,
                "appkey": appkey,
                "openid": localStorage.openid,
                "unionid": localStorage.unionid,
                "operation": "AddDeskMy",
                "desk_id": target,
                "user_id": user_id,
            };
        console.log(postData);
        app.request.post(httpApi, postData, function (data) {
            console.log(data);
            let obj = JSON.parse(data);
            if (obj.code === 0) {
                desk_id = target;
                $(".desk_name").html(names);
                $(".food_desk_add").hide();
            } else {
                gs.getNotification("温馨提示", "操作失败", "获取数据失败：" + obj.msg);
            }
        });
    });

    /*菜品信息*/
    const getGoods = function (obj) {
        // console.log(obj)
        let rsHtml = "", target_id = [];
        for (let i = 0; i < obj.length; i++) {
            let rs = obj[i];
            if (target_id.indexOf(rs.id) < 0) {
                target_id.push(rs.id);
                rsHtml += '<div class="col pro_list_li margin-bottom food_class_' + rs.fm_class + '">' +
                    '<ul>' +
                    '<li class="pro_img"><img src="' + qiniu_http + rs.fm_pic + qiniu_imagelim + '"></li>' +
                    '<li>' +
                    '<div class="block margin-top no-margin-bottom">' + rs.fm_name + '</div>' +
                    '</li>' +
                    '<li>' +
                    '<div class="pro_list_padding text-color-red">' +
                    '<div class="pro_lp">' +
                    '<span>￥</span>' +
                    '<h2 class="no-margin">' + rs.fm_price + '</h2>' +
                    '</div>' +
                    '<div class="f7-icons text-color-red pro_lp_but"' +
                    'data-img="' + rs.fm_pic + '" ' +
                    'data-price="' + rs.fm_price + '" ' +
                    'data-id="' + rs.id + '">add_round_fill</div>' +
                    '</div>' +
                    '</li>' +
                    '</ul>' +
                    '</div>';
            }
        }
        $("#food_goods").html(rsHtml);
    };
    /*商品分类*/
    this.getGoodsClass = function (obj) {
        let rsHtml = '<li><a class="list-button item-link popover-close" href="#" data-id="0">所有菜品</a></li>';
        for (let i = 0; i < obj.length; i++) {
            let rs = obj[i];
            rsHtml += '<li><a class="list-button item-link popover-close" href="#" data-id="' + rs.id + '">' + rs.fc_name + '</a></li>';
        }
        $("#food_class").html(rsHtml);
    };
    /*用户信息*/
    this.getWechat = function (obj) {
        // console.log(obj)
        if (!obj) {
            setTimeout(function () {
                gs.getNotification("温馨提示", "登录失败", "你当前是未登录状态，请登录后操作");
            }, 500)
            return false;
        }

        let sex = "";
        if (obj.sex == "1") {
            sex = "男";
        } else {
            sex = "女";
        }
        wechatLogin = true;
        wechat_id = obj[0].wechat_id;
        $(".wechat_icon").css("background-image", "url(" + obj.headimgurl + ")");
        $(".wechat_name").html(obj.nickname);
        $(".wechat_area").html(obj.province);
        $(".wechat_sex").html(sex);
        $(".wechat_address").html(obj.country + " " + obj.province + " " + obj.city);
    };

    /*分类显示点击事件*/
    $("#food_class").on("click", "a", function () {
        let class_id = $(this).attr("data-id");
        // console.log(class_id)
        if (class_id == "0") {
            $(".pro_list_li").show();
        } else {
            $(".pro_list_li").hide();
            $(".food_class_" + class_id).show();
        }
        $(".pro_show_name").html($(this).html());
    });

    /*初始化页面数据*/
    this.getPageInitializedData = function () {
        let postData = {
            "appid": appid,
            "ms": ms,
            "appkey": appkey,
            "openid": localStorage.openid,
            "unionid": localStorage.unionid,
            "operation": "QueryUserLogin",
        };
        gs.getPreloaderShow();
        app.request({
            url: httpApi,
            async: true,
            method: "POST",
            dataType: "JSON",
            timeout: 6000,
            data: postData,
            success: function (data, status, xhr) {
                // console.log(data)
                let rs = gs.getJson(data);
                console.log(rs)
                if (rs.code === 0) {
                    getGoods(rs.data.goods);
                    getGoodsClass(rs.data.goodsClass);
                    getWechat(rs.data.wechat);
                    desk_id = rs.data.desk.id; //参桌ID
                    desk_name = rs.data.desk.fd_name; //参桌名称
                    user_id = rs.data.user.id; //用户ID
                    console.log(desk_id)
                    if (desk_id == null || desk_id == "") {
                        pageDescAll();
                    }
                    $(".desk_name").html(desk_name);
                } else {
                    gs.getNotification("温馨提示", "获取数据失败", "当前数据获取为空");
                    return false;
                }
                gs.getPreloaderHide();
            }, error: function (xhr, status) {
                gs.getNotification("温馨提示", "获取数据失败", status);
                gs.getPreloaderHide();
            }
        });
    };

    this.getPageInitializedData();

    /*点击查询信息*/
    $(".food_day").click(function () {
        console.log("=======food_day")
    });
    $(".food_month").click(function () {
        console.log("=======food_month")
    });

}