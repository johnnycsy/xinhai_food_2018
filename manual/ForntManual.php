<?php
/**
 * Created by PhpStorm.
 * User: johnny
 * Date: 2018/10/15
 * Time: 22:26
 */
include_once dirname(dirname(__FILE__)) . "/manual/GlobalInc.php";

class ForntManual extends GlobalInc
{
    protected function __construct()
    {
        GlobalInc::__construct();
    }

    /**
     * @Purpose：获取商商品分类
     * @Method Name：getCommodityICassification()
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    protected function getCommodityICassification()
    {
        $sql = "
SELECT * FROM 
{$this->tb_food_class} 
WHERE 
state = 0 
ORDER BY fc_order DESC 
";
        $sql = $this->setConn()->query($sql);
        $rsObj = array();
        while ($rs = $sql->fetch_assoc()) {
            $rss["id"] = $rs["id"];
            $rss["fc_name"] = $rs["fc_name"];
            $rsObj[] = $rss;
        }
        $this->setConn()->close();
        return $rsObj;
    }

    /**
     * @Purpose：获取商品信息
     * @Method Name：getCommodityIInformation()
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    protected function getCommodityIInformation()
    {
        $sql = "
SELECT
	menu.*,
	image.fm_pic 
FROM
	{$this->tb_food_menu} AS menu,
	( SELECT image.* FROM {$this->tb_food_image} AS image, {$this->tb_food_menu} AS menu WHERE image.fm_id = menu.id GROUP BY image.fm_id ) AS image 
WHERE
	menu.state = 0 
	AND image.fm_id = menu.id 
ORDER BY
	menu.update_time DESC
    ";
        $sql = $this->setConn()->query($sql);
        $obj = array();
        while ($rs = $sql->fetch_assoc()) {
            $rss["id"] = $rs["id"];
            $rss["fm_class"] = $rs["fm_class"];
            $rss["fm_name"] = $rs["fm_name"];
            $rss["fm_bazaar"] = $rs["fm_bazaar"];
            $rss["fm_price"] = $rs["fm_price"];
            $rss["fm_details"] = $rs["fm_details"];
            $rss["fm_pic"] = $rs["fm_pic"];
            $obj[] = $rss;
        }
        $this->setConn()->close();
        return $obj;
    }


    /**
     * @Purpose：保存用户信息
     * @Method Name：getWechatInsertData()
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    protected function getWechatInsertData($obj)
    {
        try {
            $openid = $obj["openid"];
            $nickname = base64_encode($obj["nickname"]);
            $sex = $obj["sex"];
            $province = $obj["province"];
            $city = $obj["city"];
            $country = $obj["country"];
            $headimgurl = $obj["headimgurl"];
            $privilege = $obj["privilege"];
            $unionid = $obj["unionid"];
            $add_time = date("Y-m-d H:i:s");
            $update_time = date("Y-m-d H:i:s");

            $con = $this->setConn();

            $sql = "select * from {$this->tb_food_wechat_user} where openid='{$openid}'";
            $sql = $con->query($sql);
            if ($sql->num_rows <= 0) {
                $sql = "INSERT INTO {$this->tb_food_wechat_user}  ( openid, nickname, sex, province, city, country, headimgurl, privilege, unionid, add_time, update_time ) 
VALUES
	('{$openid}', '{$nickname}', '{$sex}', '{$province}', '{$city}', '{$country}', '{$headimgurl}', '{$privilege}', '{$unionid}', '{$add_time}', '{$update_time}')
";
                $sql = $con->query($sql);
                if ($con->error) {
                    return $con->close();
                }
                $rs = $con->insert_id;
            } else {
                while ($st = $sql->fetch_assoc()) {
                    $rs = $st["id"];
                }
            }
            $this->getInsertUser($rs); //创建用户信息
            $con->close();
            return $rs;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @Purpose：创建帐号信息
     * @Method Name：getInsertUser()
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    protected function getInsertUser($wechat_id)
    {
        $times = date("Y-m-d H:i:s");
        $con = $this->setConn();
        $sql = "select * from {$this->tb_food_user} where wechat_id='{$wechat_id}'";
        $sql = $con->query($sql);
        if ($sql->num_rows <= 0) {
            $sql = "insert into {$this->tb_food_user} (wechat_id,add_time,update_time) values ('{$wechat_id}','{$times}','{$times}')";
            $sql = $con->query($sql);
            $rs = $con->insert_id;
        }
        $con->close();
        return $rs;
    }

    /**
     * @Purpose：微信ID查询帐号
     * @Method Name：getUserQuery()
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    protected function getUserQuery($wechat_id)
    {
        $sql = "select * from {$this->tb_food_user} where wechat_id='{$wechat_id}'";
        $con = $this->setConn();
        $sql = $con->query($sql);
        $obj = array();
        while ($rs = $sql->fetch_assoc()) {
            $obj["id"] = $rs["id"];
            $obj["username"] = $rs["username"];
            $obj["passwords"] = $rs["passwords"];
            $obj["user_name"] = $rs["user_name"];
            $obj["user_code"] = $rs["user_code"];
            $obj["desk_id"] = $rs["desk_id"];
            $obj["user_phone"] = $rs["user_phone"];
            $obj["wechat_id"] = $rs["wechat_id"];
            $obj["desk_rank"] = $rs["desk_rank"];
            $obj["add_time"] = $rs["add_time"];
            $obj["update_time"] = $rs["update_time"];
        }
        $con->close();
        return $obj;
    }

    /**
     * @Purpose：更新微信用户信息
     * @Method Name：getWechatUpdateData()
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    protected function getWechatUpdateData($obj)
    {
        $openid = $obj["openid"];
        $nickname = $obj["nickname"];
        $sex = $obj["sex"];
        $province = $obj["province"];
        $city = $obj["city"];
        $country = $obj["country"];
        $headimgurl = $obj["headimgurl"];
        $privilege = $obj["privilege"];
        $unionid = $obj["unionid"];
        $update_time = date("Y-m-d H:i:s");
        $sql = "
UPDATE tal 
SET nickname = '{$nickname}',
sex = '{$sex}',
province = '{$province}',
city = '{$city}',
country = '{$country}',
headimgurl = '{$headimgurl}',
privilege = '{$privilege}',
unionid = '{$unionid}',
update_time = '{$update_time}' 
WHERE
	openid = '{$openid}'
        ";
        $con = $this->setConn();
        $sql = $con->query($sql);
        $con->close();
    }

    /**
     * @Purpose：查询用户是否存在
     * @Method Name：getQueryWechat()
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    protected function getQueryWechat($openid)
    {
        $sql = "
SELECT
	* 
FROM
	food_wechat_user 
WHERE
	openid ='{$openid}'
";
        $con = $this->setConn();
        $sql = $con->query($sql);
        if ($con->error) {
            return $con->error;
        }
        if ($sql->num_rows > 0) {
            while ($rs = $sql->fetch_assoc()) {
                $id = $rs["id"];
            }
        } else {
            $id = 0;
        }
        $con->close();
        return $id;
    }

    /**
     * @Purpose：添加购物车
     * @Method Name：getCartAddNumber()
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    protected function getCartAddNumber($food_id, $user_id, $food_number, $desk_id)
    {
        try {
            $state = 0;
            $times = date("Y-m-d H:i:s");
            $sql = "insert into {$this->tb_food_cart} (user_id,fm_id,desk_id,fm_number,state,creation_time,update_time) values 
('{$user_id}','{$food_id}','{$desk_id}','{$food_number}','{$state}','{$times}','{$times}')";
            $con = $this->setConn();
            $sql = $con->query($sql);
            $rs = $con->insert_id;
            $con->close();
            return $rs;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @Purpose：查询购物车信息
     * @Method Name：getQueryCartServer()
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    protected function getQueryCartServer($user_id, $desk_id)
    {
        $sql = "
SELECT
cart.fm_id AS foodId,
	cart.id AS cartId,
	cart.fm_number AS cartNumber,
	menu.fm_name AS foodName,
	menu.fm_price AS foodPrice,
	menu.fm_class AS foodClass 
FROM
	{$this->tb_food_cart} AS cart,
	{$this->tb_food_menu} AS menu 
WHERE
    cart.desk_id = {$desk_id} 
	AND cart.state = 0 
	AND cart.fm_id = menu.id
        ";
        $con = $this->setConn();
        $sql = $con->query($sql);
        $rsArr = $rsObj = array();
        while ($rs = $sql->fetch_assoc()) {
            $rsArr["cartId"] = $rs["cartId"];
            $rsArr["cartNumber"] = $rs["cartNumber"];
            $rsArr["foodName"] = $rs["foodName"];
            $rsArr["foodPrice"] = $rs["foodPrice"];
            $rsArr["foodClass"] = $rs["foodClass"];
            $rsArr["foodId"] = $rs["foodId"];
            $rsObj[] = $rsArr;
        }
        $con->close();
        return $rsObj;
    }

    /**
     * @Purpose：查询购物车,是否存在指定小菜
     * @Method Name：getCartAddNumber()
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    protected function getCartQueryNumber($food_id, $desk_id)
    {
        $sql = "select * from {$this->tb_food_cart} where desk_id='{$desk_id}' and fm_id='{$food_id}' and state=0";
        $con = $this->setConn();
        $sql = $con->query($sql);
        if ($sql->num_rows > 0) {
            $rs = $sql->num_rows;
        } else {
            $rs = 0;
        }
        $con->close();
        return $rs;
    }

    /**
     * @Purpose：修改购物车
     * @Method Name：getCartAddNumber()
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    protected function getCartUpdateNumber($food_id, $desk_id, $food_number)
    {
        if ((int)$food_number <= 0) {
            $sql = "update {$this->tb_food_cart} set state=1 where desk_id='{$desk_id}' and fm_id='{$food_id}'";
        } else {
            $sql = "update {$this->tb_food_cart} set fm_number='{$food_number}' where desk_id='{$desk_id}' and fm_id='{$food_id}' and state=0";
        }
        $con = $this->setConn();
        $sql = $con->query($sql);
        $rs = $con->affected_rows;
        $con->close();
        return $rs;
    }

    /**
     * @Purpose：查询餐桌号
     * @Method Name：getQueryDesk()
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    protected function getQueryDesk($desk_id)
    {
        $sql = "select * from {$this->tb_food_desk} where id='{$desk_id}' and state=0";
        $con = $this->setConn();
        $sql = $con->query($sql);
        $obj = array();
        while ($rs = $sql->fetch_assoc()) {
            $obj["id"] = $rs["id"];
            $obj["fd_name"] = $rs["fd_name"];
            $obj["fd_order"] = $rs["fd_order"];
            $obj["state"] = $rs["state"];
            $obj["creation_time"] = $rs["creation_time"];
            $obj["update_time"] = $rs["update_time"];
        }
        $con->close();
        return $obj;
    }

    /*查询桌长信息*/
    protected function getQueryDeskUserName($desk_id)
    {
        $sql = "select * from {$this->tb_food_user} as us,{$this->tb_food_wechat_user} as wu where us.desk_id='{$desk_id}' and us.desk_rank=1 and us.wechat_id=wu.id";
        $con = $this->setConn();
        $sql = $con->query($sql);
        $rsArr = array();
        while ($rs = $sql->fetch_assoc()) {
            $rsArr["id"] = $rs["id"];
            $rsArr["username"] = base64_decode($rs["nickname"]);
        }
        $con->close();
        return $rsArr;
    }

    /**
     * @Purpose：查询餐桌号 所有
     * @Method Name：getQueryDescAll()
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    protected function getQueryDescAllSever()
    {
        $sql = "select * from {$this->tb_food_desk} where state=0 order by fd_order desc";
        $con = $this->setConn();
        $sql = $con->query($sql);
        $obj = $arr = array();
        while ($rs = $sql->fetch_assoc()) {
            $arr["id"] = $rs["id"];
            $arr["fd_name"] = $rs["fd_name"];
            $arr["fd_order"] = $rs["fd_order"];
            $arr["state"] = $rs["state"];
            $arr["creation_time"] = $rs["creation_time"];
            $arr["update_time"] = $rs["update_time"];
            $obj[] = $arr;
        }
        $con->close();
        return $obj;
    }

    /**
     * @Purpose：加入餐桌号
     * @Method Name：getAddDeskMyServer()
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    protected function getAddDeskMyServer($desk_id, $user_id)
    {
        $con = $this->setConn();
        //加入前，查询是否有桌长
        $sql = "select * from {$this->tb_food_user} where desk_id='{$desk_id}' and desk_rank=1";
        $sql = $con->query($sql);
        if ($sql->num_rows > 0) {
            $deskRank = 0;
        } else {
            $deskRank = 1;
        }
        //加入桌号
        $sql = "update {$this->tb_food_user} set desk_id='{$desk_id}',desk_rank='{$deskRank}' where  id='{$user_id}'";
        $sql = $con->query($sql);
        $rs = $con->affected_rows;
        $con->close();
        return $rs;
    }

    /**
     * @Purpose：确认订单
     * @Method Name：getConfirmOrderServer()
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    protected function getConfirmOrderServer($desk_id, $user_id)
    {
        $con = $this->setConn();
        $sql = "
select 
cart.*, 
menu.fm_price as price
from 
{$this->tb_food_cart} as cart ,
{$this->tb_food_menu} as menu 
where 
cart.desk_id='{$desk_id}' 
and cart.state=0 
and cart.fm_id=menu.id";
        $sql = $con->query($sql);
        //$rsArr = $rsObj = array();
        if ($sql->num_rows <= 0) {
            return $sql->num_rows;
        }
        /*生成订单*/
        $orderCode = time() . str_pad(mt_rand(0, 999999), 6, "0", 2);
        $time = date("Y-m-d H:i:s");
        $oSql = "
insert into {$this->tb_food_order} (order_code,desk_id,state,creation_time,update_time) 
values ('{$orderCode}','{$desk_id}','0','{$time}','{$time}')";
        $con->query($oSql);
        $orderId = $con->insert_id;
        if ($orderId <= 0) {
            return $con->error;
        }
        /*添加订单列表*/
        $olSql = "insert into {$this->tb_food_order_list} (user_id,order_id,goods_id,fo_number,good_price,creation_time,update_time) values ";
        while ($rs = $sql->fetch_assoc()) {
            $foodId = $rs["fm_id"];
            $number = $rs["fm_number"];
            $price = $rs["price"];
            $olSql .= "('{$user_id}','{$orderId}','{$foodId}','{$number}','{$price}','{$time}','{$time}'),";
        }
        $olSql = substr($olSql, 0, strlen($olSql) - 1);
        $con->query($olSql);
        $rs = $con->affected_rows;
        /*清空购物车数据*/
        $sqlCart = "update {$this->tb_food_cart} set state=1 where desk_id='{$desk_id}' and state=0";
        $con->query($sqlCart);
        $con->close();
        return $orderId;
    }

    /**
     * @Purpose：查询订单
     * @Method Name：getQueryOrderDetailsServer()
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    protected function getQueryOrderDetailsServer($desk_id, $user_id, $order_id, $order_code)
    {
        $sql = "
SELECT
	orders.order_code AS orderCode,
	orders.creation_time AS orderTime,
	list.good_price AS orderPrice,
	list.fo_number AS orderNumber,
	desk.fd_name AS deskName,
	product.fm_name as productName,
	img.fm_pic AS imgSrc 
FROM
	food_order AS orders,
	food_order_list AS list,
	food_desk AS desk,
	food_menu AS product,
	( SELECT img.* FROM food_menu AS pro, food_image AS img WHERE pro.id = img.fm_id GROUP BY img.fm_id ) AS img 
WHERE
	( orders.id = '{$order_id}' OR orders.order_code = '{$order_code}' ) 
	AND desk.id = orders.desk_id 
	AND desk.id = '{$desk_id}' 
	AND list.order_id = orders.id 
	AND list.goods_id = product.id 
	AND product.id = img.fm_id
";
        $con = $this->setConn();
        $sql = $con->query($sql);
        $rsArr = $rsObj = array();
        while ($rs = $sql->fetch_assoc()) {
            $rsArr["orderCode"] = $rs["orderCode"];
            $rsArr["orderTime"] = $rs["orderTime"];
            $rsArr["orderPrice"] = $rs["orderPrice"];
            $rsArr["orderNumber"] = $rs["orderNumber"];
            $rsArr["deskName"] = $rs["deskName"];
            $rsArr["imgSrc"] = $rs["imgSrc"];
            $rsArr["productName"] = $rs["productName"];
            $rsObj[] = $rsArr;
        }
        $con->close();
        return $rsObj;
    }

    /**
     * @Purpose：按时间查询订单信息
     * @Method Name：getQueryOrderTimeListServer()
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    protected function getQueryOrderTimeListServer($user_id, $desk_id, $time)
    {
        if ($time == "" || $time == "all") {
            $year = date("Y");
            $times = "year(orders.creation_time) =$year";
        } else {
            $times = "TO_DAYS(orders.creation_time) = TO_DAYS('$time')";
        }
        $sql = "
SELECT
	orders.id AS orderId,
	orders.creation_time AS orderTime,
	orders.order_code AS orderCode,
	desk.fd_name AS deskName,
	list.sumPrice AS sumPrice,
	lists.listNumber AS proNum 
FROM
	food_order AS orders,
	( SELECT SUM( fo_number * good_price ) AS sumPrice, order_id FROM food_order_list GROUP BY order_id ) AS list,
	( SELECT COUNT( * ) AS listNumber, order_id FROM food_order_list GROUP BY order_id ) AS lists,
	food_desk AS desk 
WHERE
	orders.id = list.order_id 
	AND orders.desk_id = desk.id 
	AND lists.order_id = orders.id
	AND orders.desk_id='{$desk_id}'  
	AND {$times} 
	ORDER  BY  orders.creation_time DESC 
";
//        return $sql;
        $con = $this->setConn();
        $sql = $con->query($sql);
        if ($con->error) {
            return $con->error;
        }
        $rsArr = $rsObj = array();
        while ($rs = $sql->fetch_assoc()) {
            $rsArr["orderId"] = $rs["orderId"];
            $rsArr["orderTime"] = $rs["orderTime"];
            $rsArr["orderCode"] = $rs["orderCode"];
            $rsArr["deskName"] = $rs["deskName"];
            $rsArr["sumPrice"] = $rs["sumPrice"];
            $rsArr["proNum"] = $rs["proNum"];
            $rsObj[] = $rsArr;
        }
        $con->close();
        return $rsObj;
    }

    protected function getYeaderOrderPriceServer($desk_id, $time)
    {
        $time = date("Y-m-d", strtotime($time));
        $sql = "
SELECT
	SUM( ls.good_price * ls.fo_number ) AS sumPrice,
	od.creation_time AS orderTime 
FROM
	food_order_list AS ls,
	food_order AS od 
WHERE
	od.id = ls.order_id 
	AND od.desk_id = '{$desk_id}' 
	AND DATE_FORMAT( od.creation_time, '%Y-%m' ) = DATE_FORMAT( '{$time}', '%Y-%m' ) 
GROUP BY DATE_FORMAT( od.creation_time, '%Y-%m-%d' )
        ";
//        return $sql;
        $con = $this->setConn();
        $sql = $con->query($sql);
        if ($con->error) {
            return $con->error;
        }
        $rsArr = $rsObj = [];
        while ($rs = $sql->fetch_assoc()) {
            $rsArr["sumPrice"] = $rs["sumPrice"];
            $rsArr["orderTime"] = $rs["orderTime"];
            $rsObj[] = $rsArr;
        }
        $con->close();
        return $rsObj;
    }

}