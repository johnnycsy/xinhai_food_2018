<?php
/**
 * Created by PhpStorm.
 * User: johnny
 * Date: 2018/10/15
 * Time: 22:26
 */
include_once dirname(dirname(__FILE__)) . "/manual/ForntManual.php";

class ForntControl extends ForntManual
{


    public function __construct()
    {
        ForntManual::__construct();
    }

    /**
     * @Purpose：获取商品信息，商品分类
     * @Method Name：getCommodityInformation($post)
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    public function getQueryUserLogin()
    {
        $openid = isset($_POST["openid"]) ? trim($_POST["openid"]) : null;
        $unionid = isset($_POST["unionid"]) ? trim($_POST["unionid"]) : null;
        //商品分类
        $goodsClass = $this->getCommodityICassification();
        //所有正常商品
        $goodsAll = $this->getCommodityIInformation();

        if ($openid == "") {
            $wechat = "";
        } else {
            $wechat = $this->getWeChatInfo($openid, $unionid);  //查询微信信息，并进行同步
        }

        //用户帐号信息获取
        if ($wechat == "") {
            $user = "";
        } else {
            $user = $this->getUserQuery($wechat[0]["wechat_id"]);
        }

        //查询餐桌信息
        $desk = "";
        if ($user != "") {
            if (!empty($user["desk_id"])) {
                $desk = $this->getQueryDesk($user["desk_id"]);
                //查询桌长信息
                $deskRankName = $this->getQueryDeskUserName($user["desk_id"]);
            }
        }


        $cart = [];
        if (isset($desk["id"])) {
            $cart = $this->getQueryCartServer($user["id"], $desk["id"]);
        }
        $arr = array(
            "goodsClass" => $goodsClass,
            "goods" => $goodsAll,
            "wechat" => $wechat,
            "user" => $user,
            "desk" => $desk,
            "cart" => $cart,
            "deskRank" => $deskRankName,
        );
        return $this->getReturnJson(0, $arr);
    }

    /**
     * @Purpose：微信用户信息查询接口
     * @Method Name：getWeChatInfo($post)
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    private function getWeChatInfo($openid, $unionid)
    {
        $postdata = array(
            "request" => "820006",
            "openid" => $openid,
            "unionid" => $unionid,
            "goal" => "ixh2018",
        );
        $rs = $this->getPost($postdata, $this->wechatApi);
        $rs = json_decode($rs, true);
        if ($rs["code"] == "0") {
            $rs = $rs["data"][0];
            $user_id = $this->getQueryWechat($rs["openid"]);  //查询用户
            /*
            if ($user_id > 0) {
                $this->getWechatUpdateData($rs);  //更新微信用户
            } else {
                $user_id = $this->getWechatInsertData($rs);  //创建用户信息
            }
            */
            $this->getWechatUpdateData($rs);  //更新微信用户
            $user_id = $this->getWechatInsertData($rs);  //创建用户信息
            array_push($rs, ["wechat_id" => $user_id]);
        }
        return $rs;  //返回微信信息 和 微信ID
    }

    /**
     * @Purpose：加入购物车
     * @Method Name：getInsertCartAddNumber()
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    public function getInsertCartAddNumber()
    {
        $food_id = isset($_POST["food_id"]) ? trim($_POST["food_id"]) : "";  //菜品ID
        $user_id = isset($_POST["user_id"]) ? trim($_POST["user_id"]) : "";  //用户ID
        $food_number = isset($_POST["food_number"]) ? trim($_POST["food_number"]) : 1;
        $desk_id = isset($_POST["desk_id"]) ? trim($_POST["desk_id"]) : "";  //桌号ID

        if ($desk_id == "") {
            return $this->getReturnJson(4000, mb_strtoupper("no add desk number"));
        }

        if ($food_id == "" || $user_id == "" || $food_number == "") {
            return $this->getReturnJson(4000, mb_strtoupper("data cannot be empty"));
        }

        $quseryCart = $this->getCartQueryNumber($food_id, $desk_id);
        if ($quseryCart > 0) {
            $rs = $this->getCartUpdateNumber($food_id, $desk_id, $food_number);
        } else {
            $rs = $this->getCartAddNumber($food_id, $user_id, $food_number, $desk_id);
        }

        $end = $this->getQueryCartServer($user_id, $desk_id); //查询购物车信息

        return $this->getReturnJson(0, $end);
    }

    /**
     * @Purpose：查询所有桌号
     * @Method Name：getQueryDescAll()
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    public function getQueryDescAll()
    {
        $obj = $this->getQueryDescAllSever();
        return $this->getReturnJson(0, $obj);
    }

    /**
     * @Purpose：加入餐桌
     * @Method Name：AddDeskMy()
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    public function getAddDeskMy()
    {
        $desk_id = isset($_POST["desk_id"]) ? trim($_POST["desk_id"]) : "";
        $user_id = isset($_POST["user_id"]) ? trim($_POST["user_id"]) : "";
        if ($desk_id == "" || $user_id == "") {
            return $this->getReturnJson(4000, mb_strtoupper("not user data"));
        }
        $obj = $this->getAddDeskMyServer($desk_id, $user_id);
        return $this->getReturnJson(0, $obj);
    }

    /**
     * @Purpose：提交订单事件
     * @Method Name：getConfirmOrder()
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    public function getConfirmOrder()
    {
        $desk_id = isset($_POST["desk_id"]) ? trim($_POST["desk_id"]) : "";
        $user_id = isset($_POST["user_id"]) ? trim($_POST["user_id"]) : "";
        if ($desk_id == "" || $user_id == "") {
            return $this->getReturnJson(4000, mb_strtoupper("error data"));
        }
        $obj = $this->getConfirmOrderServer($desk_id, $user_id);
        return $this->getReturnJson(0, $obj);
    }

    /**
     * @Purpose：查询订单详情
     * @Method Name：getQueryOrderDetails()
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    public function getQueryOrderDetails()
    {
        $desk_id = isset($_POST["desk_id"]) ? trim($_POST["desk_id"]) : "";
        $user_id = isset($_POST["user_id"]) ? trim($_POST["user_id"]) : "";
        $order_id = isset($_POST["order_id"]) ? trim($_POST["order_id"]) : "";
        $order_code = isset($_POST["order_code"]) ? trim($_POST["order_code"]) : "";
        if ($desk_id == "" || $user_id == "") {
            return $this->getReturnJson(4000, mb_strtoupper("error data"));
        }
        if ($order_id == "" and $order_code == "") {
            return $this->getReturnJson(4000, mb_strtoupper("order id or order code not is empty"));
        }
        $obj = $this->getQueryOrderDetailsServer($desk_id, $user_id, $order_id, $order_code);
        return $this->getReturnJson(0, $obj);
    }

    /**
     * @Purpose：按时间查询订单信息
     * @Method Name：getQueryOrderTimeList()
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    public function getQueryOrderTimeList()
    {
        $user_id = isset($_POST["user_id"]) ? trim($_POST["user_id"]) : "";
        $desk_id = isset($_POST["desk_id"]) ? trim($_POST["desk_id"]) : "";
        $time = isset($_POST["time"]) ? trim($_POST["time"]) : "";
        if ($user_id == "" || $desk_id == "") {
            return $this->getReturnJson(4000, mb_strtoupper("error data"));
        }
        /*查询数据*/
        $obj = $this->getQueryOrderTimeListServer($user_id, $desk_id, $time);
        return $this->getReturnJson(0, $obj);
    }

    /**
     * @Purpose：按月查询所有帐单信息
     * @Method Name：getYeaderOrderPrice()
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    public function getYeaderOrderPrice()
    {
        $user_id = isset($_POST["user_id"]) ? trim($_POST["user_id"]) : "";
        $desk_id = isset($_POST["desk_id"]) ? trim($_POST["desk_id"]) : "";
        $time = isset($_POST["time"]) ? trim($_POST["time"]) : "";
        if ($user_id == "" || $desk_id == "" || $time == "") {
            return $this->getReturnJson(4000, mb_strtoupper("user or desk or time  data error"));
        }
        $obj = $this->getYeaderOrderPriceServer($desk_id, $time);
        return $this->getReturnJson(0, $obj);
    }

}