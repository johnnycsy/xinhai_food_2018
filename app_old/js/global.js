var GlobalFunction = function () {

    /*http post*/
    this.getPost = function (data, src = httpApi) {
        gs.getPreloaderShow();
        let rs = "";
        app.request({
            url: src,
            async: false,
            method: "POST",
            dataType: "JSON",
            timeout: 15000,
            data: data,
            success: function (data, status, xhr) {
                rs = data;
                gs.getPreloaderHide();
            }, error: function (xhr, status) {
                rs = xhr;
                gs.getPreloaderHide();
            }
        });
        return rs;
    };

    /*preloader show*/
    this.getPreloaderShow = function () {
        app.preloader.show();
    };

    /*preloader hide*/
    this.getPreloaderHide = function () {
        app.preloader.hide();
    };

    /*To Json*/
    this.getJson = function (obj) {
        return eval("(" + obj + ")");
    };

    /*notification*/
    this.getNotification = function (title, subtitle, text) {
        var notificationFull = app.notification.create({
            icon: '<i class="icon f7-icons">info</i>',
            title: title,
            titleRightText: '',
            subtitle: subtitle,
            text: text,
            closeTimeout: 3000,
        });
        notificationFull.open();
    }

};

var gs = new GlobalFunction();