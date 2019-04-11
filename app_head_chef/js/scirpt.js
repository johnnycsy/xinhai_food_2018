var getScript = function () {
    var user_id = false,//用户ID
        wechatLogin = false, //登录状态
        wechat_id = null, //用户ID
        desk_id = false,//餐桌ID
        desk_rank = false,//是否为桌长
        desk_name = false;  //餐桌名称
    /*加购事件*/
    getCartShow = function (obj) {
        var objData = obj,
            sumPrice = 0,
            sumNum = 0,
            fcArr = {},
            foodArr = {},
            cartHtml = "";
        // if (objData.length <= 0) {
        $("#my_lefit span").hide();
        // }
        for (var i = 0; i < objData.length; i++) {
            var rs = objData[i],
                cartNumber = Number(rs.cartNumber);
            sumPrice += Number(rs.foodPrice) * cartNumber;
            sumNum += cartNumber;
            /*food_class_id_   分类菜口ID*/
            fcArr[rs.foodClass] = fcArr[rs.foodClass] + cartNumber || cartNumber;
            // console.log(fcArr[rs.foodClass])
            $(".food_class_id_" + rs.foodClass + " span").html(fcArr[rs.foodClass]).show(); //购物车分类菜品
            foodArr[rs.foodId] = foodArr[rs.foodId] + cartNumber || cartNumber;
            $(".food_input_id_" + rs.foodId).val(foodArr[rs.foodId]);
            /*CART LIST DATA*/
            cartHtml += '<tr>' +
                '<td class="label-cell">' + rs.foodName + '</td>' +
                '<td class="numeric-cell text-color-red">￥' + rs.foodPrice + '</td>' +
                '<td class="numeric-cell">' +
                '<div class="my_number">' +
                '<div class="my_minus iconfont icon-minus-circle"></div>' +
                '<input class="my_numbers food_input_id_' + rs.foodId + '" data-id="' + rs.foodId + '" value="' + rs.cartNumber + '" readonly="readonly">' +
                '<div class="my_plus iconfont icon-plus-circle"></div>' +
                '</div>' +
                '</td>' +
                '</tr>';
        }
        // console.log(foodArr)
        $("#cart_list").html(cartHtml);
        $(".cart_sum_price").html(sumPrice.toFixed(2));
        $(".my_cart").html(sumNum);
    };
    getCartAddNew = function (id, number) {
        var postdata = {
            "appid": appid,
            "ms": ms,
            "appkey": appkey,
            "openid": localStorage.openid,
            "unionid": localStorage.unionid,
            "operation": "InsertCartAddNumber",
            "food_id": id,
            "food_number": number,
            "user_id": user_id,
            "desk_id": desk_id,
        };
        app.request.post(httpApi, postdata, function (data) {
            var obj = JSON.parse(data);
            // console.log(obj);
            if (obj.code === 0) {
                getCartShow(obj.data);
            } else {
                getToast("购物车信息无法读取");
            }
        });
    };  //小菜ID，数量
    /*弹出提示*/
    getToast = function (text = "", time = 2000, position = "top") {
        var toast = app.toast.create({
            text: text,
            position: position,
            closeTimeout: time,
        });
        toast.open();
    };
    /*数量点击*/
    getMyNumber = function () {
        /*减*/
        $(".my_right").on("click", ".my_minus", function () {
            if (desk_id === false) {
                getToast("请选择餐桌号，再进行点餐！");
                return false;
            }
            var input = $(this).next("input"),
                num = Number(input.val()),
                id = input.attr("data-id"),
                numbers = num - 1;
            if (num > 0) {
                input.val(numbers);
                getCartAddNew(id, numbers); //菜口加购
            }
        });
        /*加*/
        $(".my_right").on("click", ".my_plus", function () {
            if (desk_id === false) {
                getToast("请选择餐桌号，再进行点餐！");
                return false;
            }
            var input = $(this).prev("input"),
                num = Number(input.val()),
                id = input.attr("data-id"),
                numbers = num + 1;
            input.val(numbers);
            getCartAddNew(id, numbers); //菜品加购
        });
        /*============================================购物车加减*/
        /*减*/
        $("#cart_list").on("click", ".my_minus", function () {
            if (desk_id === false) {
                getToast("请选择餐桌号，再进行点餐！");
                return false;
            }
            var input = $(this).next("input"),
                num = Number(input.val()),
                id = input.attr("data-id"),
                numbers = num - 1;
            if (num > 0) {
                input.val(numbers);
                getCartAddNew(id, numbers); //菜口加购
            }
        });
        /*加*/
        $("#cart_list").on("click", ".my_plus", function () {
            if (desk_id === false) {
                getToast("请选择餐桌号，再进行点餐！");
                return false;
            }
            var input = $(this).prev("input"),
                num = Number(input.val()),
                id = input.attr("data-id"),
                numbers = num + 1;
            input.val(numbers);
            getCartAddNew(id, numbers); //菜品加购
        });
    };
    /*按小菜分类显示*/
    $("#app").on("click", "#my_lefit li", function () {
        var foodClassId = $(this).attr("data-food_class");
        $(".my_select").removeClass("my_select");
        $(this).addClass("my_select");
        if (foodClassId == "0") {
            $("#my_right li").show();
        } else {
            $("#my_right li").hide();
            $(".food_class_" + foodClassId).show();
        }
    });
    /*提交订单*/
    $("#app").on("click", ".my_submit", function () {
        if (desk_id === false) {
            getToast("请先选择您的餐桌号！");
            return false;
        }
        // if (desk_rank == false || desk_rank == "0") {
        //     getToast("您不是桌长，请联系桌长进行订单确认");
        //     return false;
        // }
        var postData = {
            "appid": appid,
            "ms": ms,
            "appkey": appkey,
            "openid": localStorage.openid,
            "unionid": localStorage.unionid,
            "desk_id": desk_id,
            "user_id": user_id,
            "operation": "ConfirmOrder",
        };
        app.request.post(httpApi, postData, function (data) {
            var obj = JSON.parse(data);
            // console.log(obj)
            if (obj.code === 0) {
                // console.log(obj.data)
                if (obj.data === 0) {
                    getToast("请先挑选小菜，再进行提交", 2000, "center");
                    return false;
                }
                //跳转到详情页，并进行查询当天订单
                app.router.navigate("/details/" + obj.data);
                getPageInitializedData();  //初始化数据
            } else {
                getToast("订单提交失败" + obj.msg);
            }
        });
    });
    /*初始化，分解不同的信息*/
    getGoods = function (obj) {  //分解小菜列表信息
        var rsHtml = "";
        if (obj.length > 0) {
            for (var i = 0; i < obj.length; i++) {
                var rs = obj[i];
                rsHtml += '<li class="food_class_' + rs.fm_class + '">' +
                    '<div class="my_img"><img src="' + qiniu_http + rs.fm_pic + qiniu_imagelim + '"></div>' +
                    '<div class="my_val">' +
                    '<div class="my_title">' + rs.fm_name + '</div>' +
                    '<div class="my_price">￥<span>' + rs.fm_price + '</span></div>' +
                    '<div class="my_number">' +
                    '<div class="my_minus iconfont icon-minus-circle"></div>' +
                    '<input class="my_numbers food_input_id_' + rs.id + '" value="0" data-id="' + rs.id + '" readonly="readonly">' +
                    '<div class="my_plus iconfont icon-plus-circle"></div>' +
                    '</div>' +
                    '</div>' +
                    '</li>';
            }
            $("#my_right").html(rsHtml);
            getMyNumber();
        } else {
            getToast("暂无销售菜品");
        }
    };

    getGoodsClass = function (obj) {  //分解小菜分类信息
        var rsHtml = '<li class="my_select" data-food_class="0">所有小菜</li>';
        if (obj.length > 0) {
            for (var i = 0; i < obj.length; i++) {
                var rs = obj[i];
                rsHtml += '<li data-food_class="' + rs.id + '" class="food_class_id_' + rs.id + '">' + rs.fc_name + '' +
                    '<span class="badge color-red">0</span></li>';
            }
        }
        $("#my_lefit").html(rsHtml);
    };

    getWechat = function (obj) {   //用户登录后信息分解
        if (!obj) {
            getToast("<p>登录失败<br/>你当前是未登录状态，请登录后操作</p>", 6000);
            return false;
        }
        var sex = "";
        if (obj.sex == "1") {
            sex = "男";
        } else {
            sex = "女";
        }
        wechatLogin = true;
        wechat_id = obj[0].wechat_id;
        $(".my_header").attr("src", obj.headimgurl);
        $(".my_name").html(obj.nickname);
        // $(".wechat_area").html(obj.province);
        // $(".wechat_sex").html(sex);
        // $(".wechat_address").html(obj.country + " " + obj.province + " " + obj.city);
    };

    /*当未加入桌号时，需要进行查询桌号*/
    getDeskAll = function () {
        var postData = {
            "appid": appid,
            "ms": ms,
            "appkey": appkey,
            "openid": localStorage.openid,
            "unionid": localStorage.unionid,
            "operation": "QueryDescAll",
        };
        app.request.post(httpApi, postData, function (data) {
            var obj = JSON.parse(data),
                rsHtml = '<div class="list"><ul>';
            // console.log(obj.data.length);
            for (var i = 0; i < obj.data.length; i++) {
                var rs = obj.data[i];
                rsHtml += '<li><a class="my_select_desk list-button item-link popover-close" href="#" data-id="' + rs.id + '">' + rs.fd_name + '</a></li>';
            }
            rsHtml += '</ul></div>';
            //执行打开
            var openPopover = app.popover.create({
                targetEl: '.my_add_desk',
                content: '<div class="popover">' +
                    '<div class="popover-inner desc_list_db">' + rsHtml + '</div>' +
                    '</div>',
                on: {
                    open: function (popover) {
                        // console.log('Popover open');
                    },
                    opened: function (popover) {
                        // console.log('Popover opened');
                    },
                }
            });
            openPopover.open();
        });
    };
    $("#app").on("click", ".my_add_desk", function () {
        // if (desk_id === false) {
        getDeskAll();
        // }
    });

    $("#app").on("click", ".my_select_desk", function () {
        var target = $(this).attr("data-id"), deskName = $(this).html(),
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
        // console.log(user_id)
        if (typeof user_id == "undefined") {
            getToast("<p>未登录，请先登录</p>");
            return false;
        }
        app.request.post(httpApi, postData, function (data) {
            // console.log(data);
            let obj = JSON.parse(data);
            if (obj.code === 0) {
                desk_id = target;
                // console.log(deskName)
                $(".desk_name").html(deskName);  //赋值桌号
                $(".my_add_desk").html(deskName);  //赋值桌号
                window.location.reload();
            } else {
                getToast("<p>加入餐桌失败：" + obj.code + "</p>");
            }
        });
    });

    /*初始化页面数据*/
    getPageInitializedData = function () {
        var postData = {
            "appid": appid,
            "ms": ms,
            "appkey": appkey,
            "openid": localStorage.openid,
            "unionid": localStorage.unionid,
            "operation": "QueryUserLogin",
        };
        app.preloader.show();
        app.request({
            url: httpApi,
            async: true,
            method: "POST",
            dataType: "JSON",
            timeout: 6000,
            data: postData,
            success: function (data, status, xhr) {
                // console.log(data)
                let rs = JSON.parse(data);
                // console.log(rs)
                if (rs.code === 0) {
                    getGoods(rs.data.goods);  //菜品信息
                    getGoodsClass(rs.data.goodsClass); //菜品分类
                    getWechat(rs.data.wechat); //分解用户信息
                    user_id = rs.data.user.id; //用户ID
                    // console.error(rs.data.desk.id)
                    //延时显示菜口数量
                    setTimeout(function () {
                        getCartShow(rs.data.cart);
                    }, 500);
                    if (rs.data.desk.id) {
                        // console.log(rs.data.desk.id);
                        desk_id = rs.data.desk.id; //参桌ID
                        desk_name = rs.data.desk.fd_name; //参桌名称
                        desk_rank = rs.data.user.desk_rank; //是否为桌长
                        // console.log(desk_rank)
                        $(".desk_name").html(desk_name);  //赋值桌号
                        $(".my_add_desk").html(desk_name);  //赋值桌号
                    }
                    if (rs.data.deskRank) {
                        $(".desk_rankname").html(rs.data.deskRank.username);
                    }
                    // app.preloader.hide();
                } else {
                    getToast("用户登录失败，请重新登录");
                    return false;
                }
                app.preloader.hide();
            }, error: function (xhr, status) {
                getToast("温馨提示：获取数据失败");
                app.preloader.hide();
            }
        });
        /*=======================================搜索===========*/
        var searchbar = app.searchbar.create({
            el: '.searchbar',
            searchContainer: '.list',
            searchIn: '.item-title',
            on: {
                search(sb, query, previousQuery) {
                    // console.log(query);
                    getSearchAllDataShow(query)
                }
            }
        });
    };

    /*搜索信息查看*/
    getSearchAllDataShow = function (targetVal) {
        var target = $("#my_right li"),
            rsVal = $("#my_right .my_title");
        for (var i = 0; i < target.length; i++) {
            var rs = rsVal[i],
                obj = target[i];
            // console.log(rs.innerHTML.indexOf(targetVal))
            if (rs.innerHTML.indexOf(targetVal) < 0) {
                obj.style.display = "none";
            } else {
                obj.style.display = "flex";
            }
        }
    };

    /*==========price_statistics.php========================================================*/
    /*获取订单信息，并进行分解*/
    getOrderDetailsShow = function (order_id, order_code) {
        var postData = {
            "appid": appid,
            "ms": ms,
            "appkey": appkey,
            "openid": localStorage.openid,
            "unionid": localStorage.unionid,
            "operation": "QueryOrderDetails",
            "user_id": user_id,
            "desk_id": desk_id,
            "order_id": order_id,
            "order_code": order_code,
        };
        app.request.post(httpApi, postData, function (data) {
            var obj = JSON.parse(data);
            // console.log(obj);
            if (obj.code === 0) {
                var deskName = "",
                    orderTime = "",
                    orderCode = "",
                    rsHtml = "",
                    sum_number = 0, sum_price = 0;
                for (var i = 0; i < obj.data.length; i++) {
                    var rs = obj.data[i];
                    deskName = rs.deskName;
                    orderTime = rs.orderTime;
                    orderCode = rs.orderCode;
                    rsHtml += '<tr>' +
                        '<td class="label-cell order_img"><img src="' + qiniu_http + rs.imgSrc + qiniu_imagelim + '"></td>' +
                        '<td class="numeric-cell text-align-left">' +
                        '<h2 class="no-padding no-margin">' + rs.productName + '</h2>' +
                        '<div class="text-color-red order_price no-margin no-padding">' +
                        '<h6 class="no-padding no-margin">￥</h6>' +
                        '<h2 class="no-padding no-margin">' + rs.orderPrice + '</h2>' +
                        '</div>' +
                        '</td>' +
                        '<td class="numeric-cell text-align-right">x ' + rs.orderNumber + '</td>' +
                        '</tr>';
                    sum_number += Number(rs.orderNumber);
                    sum_price += Number(rs.orderNumber) * Number(rs.orderPrice);
                }
                $(".sum_num").html(obj.data.length);
                $('.sum_number').html(sum_number);
                $(".sum_price").html(sum_price);
                $(".od_desk").html(deskName);
                $(".od_orderno").html(orderCode);
                $(".od_times").html(orderTime);
                $(".order_list").html(rsHtml);
            } else {
                getToast("订单信息获取失败：" + obj.msg);
            }
        });
    };

    /*==========order.php========================================================*/
    /*获取历史订单 或 今日订单*/
    getOrderTimeList = function (times = null) {
        if (desk_id === false) {
            getToast("请选择餐桌号，再进行点餐！");
            return false;
        }
        var postData = {
            "appid": appid,
            "ms": ms,
            "appkey": appkey,
            "openid": localStorage.openid,
            "unionid": localStorage.unionid,
            "operation": "QueryOrderTimeList",
            "user_id": user_id,
            "desk_id": desk_id,
            "time": times
        };
        app.request.post(httpApi, postData, function (data) {
            // console.log(data)
            var obj = JSON.parse(data);
            // console.log(obj)
            if (obj.code === 0) {
                var rsHtml = "";
                if (obj.data.length <= 0) {
                    $(".myorder_list").html("<p class='text-align-center'>您当前还没有点菜，<a class='back'>返回</a>继续点菜</p>");
                    return false;
                }
                for (var i = 0; i < obj.data.length; i++) {
                    var rs = obj.data[i];
                    rsHtml += '<div class="card">' +
                        '<div class="card-content card-content-padding">' +
                        '<div>桌号：' + rs.deskName + '</div>' +
                        '<div>订单号：' + rs.orderCode + '</div>' +
                        '<div>' +
                        '<span>菜品数量：' + rs.proNum + '</span>' +
                        '<span>金额总计：' + rs.sumPrice + '</span>' +
                        '</div>' +
                        '</div>' +
                        '<div class="card-header">' +
                        '<div>' + rs.orderTime + '</div>' +
                        '<div class="text-align-right"><a href="/details/' + rs.orderId + '" class="col button button-fill">查看详情</a></div>' +
                        '</div>' +
                        '</div>';
                }
                $(".myorder_list").html(rsHtml);
            } else {
                getToast("订单信息获取失败：" + obj.msg);
            }
        })
    };

    /*==========price_statistics.php========================================================*/
    getYeaderOrderPrice = function (times) {
        if (desk_id === false) {
            getToast("请选择餐桌号，再进行点餐！");
            return false;
        }
        var postData = {
            "appid": appid,
            "ms": ms,
            "appkey": appkey,
            "openid": localStorage.openid,
            "unionid": localStorage.unionid,
            "operation": "YeaderOrderPrice",
            "user_id": user_id,
            "desk_id": desk_id,
            "time": times
        };
        app.request.post(httpApi, postData, function (data) {
            // console.log(postData)
            var obj = JSON.parse(data);
            // console.log(obj)
            if (obj.code === 0) {
                // console.log(obj)
                var rsHtml = "", sumPrice = 0;
                for (var i = 0; i < obj.data.length; i++) {
                    var rs = obj.data[i],
                        times = rs.orderTime.split(" ");
                    sumPrice += Number(rs.sumPrice);
                    '<div class="text-align-right">￥' + rs.sumPrice + '</div>' +
                    '</li>';
                }
                $(".price_list").html(rsHtml);
                rsHtml += '<li>' +
                    '<div>' + times[0] + '</div>' +
                    $(".price_sum").html(sumPrice.toFixed(2));
            } else {
                getToast("数据获取失败：" + obj.code);
            }
        });
    };

    $("#app").on("click", ".price_target_time a", function () {
        var target = $(this).html();
        // console.log(target)
        $(".price_times").html(target);
        getYeaderOrderPrice(target);
    });

};







