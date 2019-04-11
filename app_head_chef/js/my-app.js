var app = new Framework7({
        root: '#app',
        name: '新海食堂',
        id: 'com.myapp.test',
        theme: "ios",
        panel: {
            swipe: 'left',
        },
        routes: [
            {
                path: '/home/',
                url: 'home.php',
                on: {
                    pageBeforeIn: function (event, page) {
                    },
                    pageAfterIn: function (event, page) {
                    },
                    pageInit: function (event, page) {
                        getPageInitializedData();
                    },
                    pageBeforeRemove: function (event, page) {
                    },
                }
            },
            {
                path: '/details/:target',
                url: 'order_details.php',
                on: {
                    pageBeforeIn: function (event, page) {
                        var order_id = page.route.params.target;
                        // console.log(order_id)
                        getOrderDetailsShow(order_id, "");
                    },
                    pageAfterIn: function (event, page) {
                    },
                    pageInit: function (event, page) {
                    },
                    pageBeforeRemove: function (event, page) {
                    },
                }
            },
            {
                path: '/order/:time',
                url: 'order.php',
                on: {
                    pageBeforeIn: function (event, page) {
                        var time = page.route.params.time;
                        // console.log(time)
                        getOrderTimeList(time);
                    },
                    pageAfterIn: function (event, page) {
                    },
                    pageInit: function (event, page) {
                    },
                    pageBeforeRemove: function (event, page) {
                    },
                }
            },
            {
                path: '/price/:time',
                url: 'price_statistics.php',
                on: {
                    pageBeforeIn: function (event, page) {
                        var time = page.route.params.time;
                        getYeaderOrderPrice(time)
                    },
                    pageAfterIn: function (event, page) {
                    },
                    pageInit: function (event, page) {
                    },
                    pageBeforeRemove: function (event, page) {
                    },
                }
            },
        ],
    }),
    mainView = app.views.create('.view-main'),
    $ = Dom7,
    qiniu_http = "http://yhj.image.qiniu.xinhaiip.cn/",
    qiniu_imagelim = "?imageslim";

var my = new getScript();
// window.onload = function () {
//     getPageInitializedData();
// };
app.router.navigate("/home/", {
    animate: false,
});
