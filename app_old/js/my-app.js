var app = new Framework7({
        root: '#app',
        name: 'XinHai DinIng Hall',
        id: 'com.xinhai.www',
        theme: "ios",
        panel: {},
        routes: [
            {
                path: '/about/',
                url: 'about.html',
                on: {
                    pageBeforeIn: function (event, page) {
                    },
                    pageAfterIn: function (event, page) {
                    },
                    pageInit: function (event, page) {
                        getIndexPage();
                    },
                    pageBeforeRemove: function (event, page) {
                    },
                }
            },
        ],
    }), $ = Dom7,
    mainView = app.views.create('.view-main'),
    qiniu_http = "http://yhj.image.qiniu.xinhaiip.cn/",
    qiniu_imagelim = "?imageslim";

window.onload = function () {
    getIndexPage();
};