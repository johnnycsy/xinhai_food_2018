class GlobalInc {

    constructor() {
    };

    //POST HTTP AJAX
    getPost(db, src = apiSrc) {
        let rs = "";
        $.ajax({
            type: 'POST',
            url: src,
            dataType: "JSON",
            async: false,
            timeout: 3000,
            data: db,
            beforeSend: function () {
                xh.getLoadingShow();
            }, success: function (obj) {
                xh.getLoadingHide();
                rs = obj;
            }, error: function (error) {
                xh.getLoadingHide();
                rs = error.responseText;
            }
        });
        return rs;
    }

    //TOP TOAST
    getToast(obj) {
        $(".food_toast .alert").html(obj);
        $(".food_toast").slideDown();
        setTimeout(function () {
            $(".food_toast").slideUp();
        }, 3000);
    }

    /*LOADING SHOW*/
    getLoadingShow() {
        $(".food_loading").css("display", "flex");
    }

    /*LOADING HIDE*/
    getLoadingHide() {
        $(".food_loading").css("display", "none");
    }

    /*本地图片浏览*/
    getObjectURL(file) {
        var url = null;
        if (window.createObjectURL != undefined) { // basic
            url = window.createObjectURL(file);
        } else if (window.URL != undefined) { // mozilla(firefox)
            url = window.URL.createObjectURL(file);
        } else if (window.webkitURL != undefined) { // webkit or chrome
            url = window.webkitURL.createObjectURL(file);
        }
        return url;
    }

    /*七牛数据获取*/
    getQiNiuToken() {
        let postDB = {
            "bucketName": "bi-yhj-word",
            "user": "应汉炯",
            "jobnumber": 820006,
            "projectname": "food2018",
        }, rs = xh.getPost(postDB, apiqiniu);
        if (rs.resultCode === 0) {
            return rs.token;
        }
    }

    /*生成随机数*/
    getRandomNum(minNum, maxNum) {
        switch (arguments.length) {
            case 1:
                return parseInt(Math.random() * minNum + 1, 10);
                break;
            case 2:
                return parseInt(Math.random() * (maxNum - minNum + 1) + minNum, 10);
                break;
            default:
                return 0;
                break;
        }
    }

}