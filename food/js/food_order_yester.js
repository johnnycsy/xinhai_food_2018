var getFoodOrder = function () {

    var pageDataList = function (obj) {
        // console.log(obj)
        var rsHtml = "",
            orderNumber = 0,
            codeArr = [];
       /* for (var i = 0; i < obj.length; i++) {
            var rs = obj[i];
            if (codeArr.indexOf(rs.orderId) < 0) {
                if (codeArr.length <= 0) {
                    orderNumber++;
                    sumMoney = Number(Number(rs.orderNumber) * Number(rs.unitPrice));
                    rsHtml += '<div class="od_list"><span>' +
                        '<div class="od_code"><span>' + rs.deskName + '</span><em style="margin-left: 1rem;" data-orderid="' + rs.orderId + '">删除订单</em><br/><span>' + rs.update_time + '</span></div>' +
                        '<ul class="od_lul">' +
                        '<li>' +
                        '<span>' + rs.goodName + '</span>' +
                        '<span>' + rs.orderNumber + '<i> x </i>' + rs.unitPrice + '</span>' +
                        '</li>';
                } else {
                    // console.log("==================================================")
                    orderNumber++;
                    rsHtml += '<li class="od_codeend">' +
                        '<span>合计：</span>' +
                        '<span> ' + sumMoney + ' 元</span>' +
                        '</li>' +
                        '</ul></span></div>' +
                        '<div class="od_list"><span>' +
                        '<div class="od_code"><span>' + rs.deskName + '</span><em style="margin-left: 1rem;" data-orderid="' + rs.orderId + '">删除订单</em><br/><span>' + rs.update_time + '</span></div>' +
                        '<ul class="od_lul">' +
                        '<li>' +
                        '<span>' + rs.goodName + '</span>' +
                        '<span>' + rs.orderNumber + '<i> x </i>' + rs.unitPrice + '</span>' +
                        '</li>';
                    sumMoney = Number(Number(rs.orderNumber) * Number(rs.unitPrice));
                }
                codeArr.push(rs.orderId);
            } else {
                if ((obj.length - 1) == i) {
                    rsHtml += '<li class="od_codeend">' +
                        '<span>合计：</span>' +
                        '<span> ' + sumMoney + ' 元</span>' +
                        '</li>' +
                        '</ul>';
                } else {
                    sumMoney += Number(Number(rs.orderNumber) * Number(rs.unitPrice));
                    // console.log(sumMoney)
                    rsHtml += '<li>' +
                        '<span>' + rs.goodName + '</span>' +
                        '<span>' + rs.orderNumber + '<i> x </i>' + rs.unitPrice + '</span>' +
                        '</li>';
                }
            }
        }
        rsHtml += '</ul></span></div>';*/
        for (var i = 0; i < obj.length; i++) {
            orderNumber = 0;
            var rs = obj[i],
                proNumber = rs.orderNumber.split(","),
                priceArr = rs.unitPrice.split(","),
                goodArr = rs.goodName.split(",");
            rsHtml += '<div class="od_list"><span>' +
                '<div class="od_code"><span>' + rs.deskName + '</span><em style="margin-left: 1rem;" data-orderid="' + rs.orderId + '">删除订单</em><br/><span>' + rs.update_time + '</span></div>' +
                '<ul class="od_lul">';
            for (var n = 0; n < goodArr.length; n++) {
                var goods = goodArr[n], price = priceArr[n], proNum = proNumber[n];
                orderNumber += Number(price) * Number(proNum);
                rsHtml += '<li>' +
                    '<span>' + goods + '</span>' +
                    '<span>' + proNum + '<i> x </i>' + price + '</span>' +
                    '</li>';
            }

            rsHtml += '<li class="od_codeend">' +
                '<span>合计：</span>' +
                '<span> ' + orderNumber + ' 元</span>' +
                '</li>' ;
            rsHtml += '</ul></span></div>';
        }

        $(".od_main").html(rsHtml);
        $(".od_number").html("今日订单总数：" + obj.length + "单");
    };

    var data = {
        "appid": appid,
        "apikey": apikey,
        "operation": "QueryOrderYesDay",
    }, pageObj = xh.getPost(data);
    // console.log(pageObj)
    if (pageObj.code == 0) {
        pageDataList(pageObj.data);
    } else {
        xh.getToast("数据获取失败");
    }

    $(".od_main").on("click", "em", function () {
        var orderId = $(this).attr("data-orderId"),
            data = {
                "appid": appid,
                "apikey": apikey,
                "operation": "orderDelete",
                "id": orderId,
            },
            obj = xh.getPost(data);
        console.log(orderId);
        if (obj.code == 0) {
            window.location.reload();
        } else {
            xh.getToast("删除失败,请重试");
        }
    })

};

window.onload = function () {
    getFoodOrder();
};