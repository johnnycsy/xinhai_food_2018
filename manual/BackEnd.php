<?php
/**
 * Created by PhpStorm.
 * User: johnny
 * Date: 2018/9/23
 * Time: 16:04
 */
include_once dirname(dirname(__FILE__)) . "/manual/GlobalInc.php";

class BackEnd extends GlobalInc
{

    protected function __construct()
    {
        GlobalInc::__construct();
    }

    /**
     * @Purpose：添加菜品分类名称
     * @Method Name：setAddNewFoodClassName()
     * @Param：$obj 类名称
     * @Author：johnny
     * @Return：返回统一报文
     */
    protected function setAddNewFoodClassName($obj)
    {
        $timesDb = date("Y-m-d H:i:s");
        $sql = "insert into {$this->tb_food_class} (fc_name,creation_time,update_time) values ('{$obj}','{$timesDb}','{$timesDb}')";
        $con = $this->setConn();
        $con->query($sql);
        if ($con->error) {
            $rs = $this->getReturnJson(6000, $con->error);
        } else {
            $rs = $this->getReturnJson(0, $con->insert_id);
        }
        $con->close();
        return $rs;
    }

    /**
     * @Purpose：查询分类是否存在
     * @Method Name：getFoodClassNameDF()
     * @Param：$obj 类名称
     * @Author：johnny
     * @Return：返回true or false
     */
    protected function getFoodClassNameDF($obj)
    {
        $sql = "select * from {$this->tb_food_class} where fc_name='{$obj}'";
        $con = $this->setConn();
        $sql = $con->query($sql);
        if ($sql->num_rows > 0) {
            $rs = true;
        } else {
            $rs = false;
        }
        $sql->close();
        return $rs;
    }

    /**
     * @Purpose：查询分类是否存在
     * @Method Name：getFoodClassNameDF()
     * @Param：$obj 类名称
     * @Author：johnny
     * @Return：返回true or false
     */
    protected function getQueryClassNameDF()
    {
        $sql = "select * from {$this->tb_food_class} order by fc_order desc ";
        $con = $this->setConn();
        $sql = $con->query($sql);
        $obj = $rss = array();
        while ($rs = $sql->fetch_assoc()) {
            $rss["id"] = $rs["id"];
            $rss["fc_name"] = $rs["fc_name"];
            $rss["fc_order"] = $rs["fc_order"];
            $rss["state"] = $rs["state"];
            $rss["creation_time"] = $rs["creation_time"];
            $rss["update_time"] = $rs["update_time"];
            $obj[] = $rss;
        }
        $sql->close();
        return $obj;
    }

    /**
     * @Purpose：查询所有类目名称
     * @Method Name：getUpdateFoodClassNameOrderUpdateDF()
     * @Param：$obj 获取所有POST参数
     * @Author：johnny
     * @Return：返回统一报文
     */
    protected function getUpdateFoodClassNameOrderUpdateDF($id, $order)
    {
        $sql = "update {$this->tb_food_class} set fc_order='{$order}' where  id='{$id}'";
        $con = $this->setConn();
        $sql = $con->query($sql);
        if ($con->error) {
            $rs = $con->error;
        } else {
            $rs = true;
        }
        $con->close();
        return $rs;
    }

    protected function getUpdateFoodClassNameUpdateServer($id, $classname)
    {
        $sql = "update {$this->tb_food_class} set fc_name='{$classname}' where  id='{$id}'";
        $con = $this->setConn();
        $sql = $con->query($sql);
        if ($con->error) {
            $rs = $con->error;
        } else {
            $rs = $con->affected_rows;
        }
        $con->close();
        return $rs;
    }

    /*判断菜是否已经添加*/
    protected function getQueryFoodName($fm_name)
    {
        $sql = "select * from {$this->tb_food_menu} where fm_name='{$fm_name}' and state=0";
        $con = $this->setConn();
        $sql = $con->query($sql);
        if ($con->error) {
            return $con->error;
        }
        if ($sql->num_rows > 0) {
            $rs = true;
        } else {
            $rs = false;
        }
        $con->close();
        return $rs;
    }

    /**
     * @Purpose：保存菜品
     * @Method Name：getUpdateFoodClassNameOrderUpdateDF()
     * @Param：
     * $fm_name 菜品名称
     * $fm_bazaar 市场价格
     * $fm_price 销售价格
     * $fm_class 分类名称
     * @Author：johnny
     * @Return：返回统一报文
     */
    protected function getInsertFoodNewGreensDF($fm_name, $fm_bazaar, $fm_price, $fm_class)
    {
        $times = date("Y-m-d H:i:s");
        $sql = "insert into {$this->tb_food_menu} (fm_class,fm_name,fm_bazaar,fm_price,creation_time,update_time) values 
('{$fm_class}','{$fm_name}','{$fm_bazaar}','{$fm_price}','{$times}','{$times}')";
        $con = $this->setConn();
        $con->query($sql);
        if ($con->error) {
            $rs = $con->error;
        } else {
            $rs = $con->insert_id;
        }
        $con->close();
        return $rs;
    }

    /*查询指定商品*/
    protected function getQueryFoodTargetServer($id)
    {
        $sql = "select * from {$this->tb_food_menu} where id='{$id}'";
        $con = $this->setConn();
        $sql = $con->query($sql);
        if ($con->error) {
            return $con->error;
        }
        $rsArr = array();
        while ($rs = $sql->fetch_assoc()) {
            $rsArr["id"] = $rs["id"];
            $rsArr["fm_class"] = $rs["fm_class"];
            $rsArr["fm_name"] = $rs["fm_name"];
            $rsArr["fm_bazaar"] = $rs["fm_bazaar"];
            $rsArr["fm_price"] = $rs["fm_price"];
        }
        //查询图片
        $sql = "select * from {$this->tb_food_image} where fm_id='{$id}' and state=0";
        $sql = $con->query($sql);
        $imgArr = $imgObj = array();
        while ($rs = $sql->fetch_assoc()) {
            $imgArr["id"] = $rs["id"];
            $imgArr["fm_pic"] = $rs["fm_pic"];
            $imgObj[] = $imgArr;
        }
        $con->close();
        return [$rsArr, $imgObj];
    }

    /*修改菜品信息*/
    protected function getUpdateFoodServer($fm_name, $fm_bazaar, $fm_price, $fm_class, $id)
    {
        $times = date("Y-m-d H:i:s");
        $sql = "update {$this->tb_food_menu} set fm_class='{$fm_class}',fm_name='{$fm_name}',fm_bazaar='{$fm_bazaar}',fm_price='{$fm_price}' where id='{$id}'";
        $con = $this->setConn();
        $con->query($sql);
        if ($con->error) {
            $rs = $con->error;
        } else {
            $rs = $con->affected_rows;
        }
        $con->close();
        return $rs;
    }

    /*修改产品图片*/
    protected function getUpdateImageServer($img, $foodid)
    {
        $con = $this->setConn();
//        var_dump($img);
        $times = date("Y-m-d H:i:s");
        if (is_array($img)) {
            for ($i = 0; $i < count($img); $i++) {
                $rs = $img[$i];
                $imgs = $rs["img"];
                $id = $rs["id"];
                $sql = "select * from {$this->tb_food_image} where id='{$id}'";
                $sql = $con->query($sql);
                if ($sql->num_rows > 0) {
                    $sql = "update {$this->tb_food_image} set fm_pic='{$imgs}' where id='{$id}'";
                } else {
                    $sql = "insert into {$this->tb_food_image} (fm_id,fm_pic,fm_order,creation_time,update_time) values ('{$foodid}','{$imgs}','0','{$times}','{$times}')";
                }
                $con->query($sql);
                if ($con->error) {
                    return $con->error;
                }
            }
            $con->close();
        }
    }

    /**
     * @Purpose：保存图片信息
     * @Method Name：getInsertFoodNewGreensImageDF()
     * @Param：$obj 获取所有POST参数
     * @Author：johnny
     * @Return：返回统一报文
     */
    protected function getInsertFoodNewGreensImageDF($id, $img)
    {
        $times = date("Y-m-d H:i:s");
        $sql = "insert into {$this->tb_food_image} (fm_id,fm_pic,fm_order,creation_time,update_time) values ";
        $sqls = "";
        for ($i = 0; $i < count($img); $i++) {
            if (!empty($img[$i])) {
                $sqls .= "('{$id}','{$img[$i]}','{$i}','{$times}','{$times}'),";
            }
        }
        if ($sqls === "") {
            return false;
        }
        $sql = $sql . substr($sqls, 0, strlen($sqls) - 1);
        $con = $this->setConn();
        $con->query($sql);
        if ($con->error) {
            $rs = $con->error;
        } else {
            $rs = true;
        }
        $con->close();
        return $rs;
    }

    /**
     * @Purpose：查询所有菜品数据库
     * @Method Name：getFoodQueryAllListDF($obj)
     * @Param：$obj 获取所有POST参数
     * @Author：johnny
     * @Return：返回统一报文
     */
    protected function getFoodQueryAllListDF($obj)
    {
        try {
            $page = 1;
            $pagesize = 10;
            $sum = $this->getFoodProductSumNumber()["numbers"];
            $pages = intval($sum / $pagesize);
            if ($sum % $pagesize) {
                $pages++;
            }
            if (isset($obj)) {
                $page = intval($obj);
            }
            $start = $pagesize * ($page - 1);

            $sql = "
SELECT
	food_image.*,
	food_menu.*,
	food_menu.id AS mid,
	food_image.id AS ids 
FROM
	food_menu
	LEFT JOIN food_image ON food_menu.id = food_image.fm_id 
	AND food_menu.state = 0 
ORDER BY
	food_menu.id DESC LIMIT $start,$pagesize";
            $con = $this->setConn();
            $sql = $con->query($sql);
            $rsArr = array();
            while ($rs = $sql->fetch_assoc()) {
                $rss["imgid"] = $rs["ids"];
                $rss["fm_id"] = $rs["fm_id"];
                $rss["fm_pic"] = $rs["fm_pic"];
                $rss["fm_order"] = $rs["fm_order"];
                $rss["id"] = $rs["mid"];
                $rss["fm_class"] = $rs["fm_class"];
                $rss["fm_name"] = $rs["fm_name"];
                $rss["fm_bazaar"] = $rs["fm_bazaar"];
                $rss["fm_price"] = $rs["fm_price"];
                $rss["fm_details"] = $rs["fm_details"];
                $rss["state"] = $rs["state"];
                $rss["creation_time"] = $rs["creation_time"];
                $rss["update_time"] = $rs["update_time"];
                $rsArr[] = $rss;
            }
            $con->close();
            return array(
                "list" => $rsArr,
                "pagenum" => $pages,
            );
        } catch (Exception $e) {
            return $e->getTraceAsString();
        }
    }

    /**
     * @Purpose：当前菜的总数
     * @Method Name：getFoodProductSumNumber($obj)
     * @Param：$obj 获取所有POST参数
     * @Author：johnny
     * @Return：返回统一报文
     */
    protected function getFoodProductSumNumber()
    {
        $sql = "select count(*) as numbers from {$this->tb_food_menu} ";
        $con = $this->setConn();
        $sql = $con->query($sql);
        $rs = $sql->fetch_assoc();
        $con->close();
        return $rs;
    }

    /**
     * @Purpose：查询餐桌信息 是否存在
     * @Method Name：getQueryFoodTableName($obj)
     * @Param：$obj 获取所有POST参数
     * @Author：johnny
     * @Return：返回统一报文
     */
    protected function getQueryFoodTableName($fooddname)
    {
        $sql = "select * from {$this->tb_food_desk} where fd_name='{$fooddname}'";
        $con = $this->setConn();
        $con->query($sql);
        if ($con->error) {
            $rs = $con->error;
        } else {
            $rs = true;
        }
        $con->close();
        return $rs;
    }

    /**
     * @Purpose：保存餐桌信息
     * @Method Name：getFoodTableInsertNewDF($obj)
     * @Param：$obj 获取所有POST参数
     * @Author：johnny
     * @Return：返回统一报文
     */
    protected function getFoodTableInsertNewDF($fd_code, $fd_name, $fd_order, $state)
    {
        $times = date("Y-m-d H:i:s");
        $sql = "insert into {$this->tb_food_desk} (fd_name,fd_order,state,creation_time,update_time) values 
('{$fd_name}','{$fd_order}','{$state}','{$times}','{$times}')";
        $con = $this->setConn();
        $con->query($sql);
        if ($con->error) {
            $rs = $con->error;
        } else {
            $rs = true;
        }
        $con->close();
        return $rs;
    }

    /**
     * @Purpose：查询餐桌信息
     * @Method Name：getQueryTableAllListDF()
     * @Param：$obj 获取所有POST参数
     * @Author：johnny
     * @Return：返回统一报文
     */
    protected function getQueryTableAllListDF()
    {
        $sql = "select * from {$this->tb_food_desk}";
        $con = $this->setConn();
        $sql = $con->query($sql);
        $rss = $rsObj = array();
        while ($rs = $sql->fetch_assoc()) {
            $rss["id"] = $rs["id"];
            $rss["fd_name"] = $rs["fd_name"];
            $rss["fd_order"] = $rs["fd_order"];
            $rss["state"] = $rs["state"];
            $rss["creation_time"] = $rs["creation_time"];
            $rss["update_time"] = $rs["update_time"];
            $rsObj[] = $rss;
        }
        $con->close();
        return $rsObj;
    }

    /**
     * @Purpose：获取今日订单
     * @Method Name：getQueryOrderDayServer()
     * @Param：$obj 获取所有POST参数
     * @Author：johnny
     * @Return：返回统一报文
     */
    protected function getQueryOrderDayServer()
    {
        /*
                $sql = "
        SELECT
            od.order_code AS orderCode,
            od.id AS orderId,
            mu.fm_name AS goodName,
            ol.fo_number AS orderNumber,
            ol.good_price AS unitPrice,
            dk.fd_name AS deskName,
            od.update_time AS update_time
        FROM
            food_order AS od,
            food_order_list AS ol,
            food_menu AS mu,
            food_desk AS dk
        WHERE
            TO_DAYS( od.creation_time ) = TO_DAYS( NOW( ) )
            AND od.id = ol.order_id
            AND mu.id = ol.goods_id
            AND dk.id = od.desk_id
            AND od.state=0
        ";
        */
        $sql = "
SELECT
	od.order_code AS orderCode,
	od.id AS orderId,
	GROUP_CONCAT(mu.fm_name) AS goodName,
	GROUP_CONCAT(ol.fo_number) AS orderNumber,
	GROUP_CONCAT(ol.good_price) AS unitPrice,
	dk.fd_name AS deskName,
	od.update_time AS update_time 
FROM
	food_order AS od,
	food_order_list AS ol,
	food_menu AS mu,
	food_desk AS dk 
WHERE
	TO_DAYS( od.creation_time ) = TO_DAYS( NOW( ) ) 
	AND od.id = ol.order_id 
	AND mu.id = ol.goods_id 
	AND dk.id = od.desk_id 
	AND od.state = 0 
GROUP BY
	od.id
        ";
        $con = $this->setConn();
        $sql = $con->query($sql);
        $rsArr = $rsObj = array();
        while ($rs = $sql->fetch_assoc()) {
            $rsArr["orderCode"] = $rs["orderCode"];
            $rsArr["orderId"] = $rs["orderId"];
            $rsArr["goodName"] = $rs["goodName"];
            $rsArr["orderNumber"] = $rs["orderNumber"];
            $rsArr["unitPrice"] = $rs["unitPrice"];
            $rsArr["deskName"] = $rs["deskName"];
            $rsArr["update_time"] = $rs["update_time"];
            $rsObj[] = $rsArr;
        }
        $con->close();
        return $rsObj;
    }

    /**
     * @Purpose：获取昨日订单
     * @Method Name：getQueryOrderDayServer()
     * @Param：$obj 获取所有POST参数
     * @Author：johnny
     * @Return：返回统一报文
     */
    protected function getQueryOrderYesDayServer()
    {
        /*        $sql = "
        SELECT
            od.order_code AS orderCode,
            od.id AS orderId,
            mu.fm_name AS goodName,
            ol.fo_number AS orderNumber,
            ol.good_price AS unitPrice,
            dk.fd_name AS deskName,
            od.update_time AS update_time
        FROM
            food_order AS od,
            food_order_list AS ol,
            food_menu AS mu,
            food_desk AS dk
        WHERE
            TO_DAYS( NOW( ) ) - TO_DAYS( od.creation_time ) = 1
            AND od.id = ol.order_id
            AND mu.id = ol.goods_id
            AND dk.id = od.desk_id
            AND od.state=0
        ";*/
        $sql = "
SELECT
	od.order_code AS orderCode,
	od.id AS orderId,
	GROUP_CONCAT(mu.fm_name) AS goodName,
	GROUP_CONCAT(ol.fo_number) AS orderNumber,
	GROUP_CONCAT(ol.good_price) AS unitPrice,
	dk.fd_name AS deskName,
	od.update_time AS update_time 
FROM
	food_order AS od,
	food_order_list AS ol,
	food_menu AS mu,
	food_desk AS dk 
WHERE
	TO_DAYS( NOW( ) ) - TO_DAYS( od.creation_time ) = 1 
	AND od.id = ol.order_id 
	AND mu.id = ol.goods_id 
	AND dk.id = od.desk_id 
	AND od.state = 0 
GROUP BY
	od.id
";
        $con = $this->setConn();
        $sql = $con->query($sql);
        $rsArr = $rsObj = array();
        while ($rs = $sql->fetch_assoc()) {
            $rsArr["orderCode"] = $rs["orderCode"];
            $rsArr["orderId"] = $rs["orderId"];
            $rsArr["goodName"] = $rs["goodName"];
            $rsArr["orderNumber"] = $rs["orderNumber"];
            $rsArr["unitPrice"] = $rs["unitPrice"];
            $rsArr["deskName"] = $rs["deskName"];
            $rsArr["update_time"] = $rs["update_time"];
            $rsObj[] = $rsArr;
        }
        $con->close();
        return $rsObj;
    }

    /**
     * @Purpose：获取月订单订单
     * @Method Name：getQueryOrderDayServer()
     * @Param：$obj 获取所有POST参数
     * @Author：johnny
     * @Return：返回统一报文
     */
    protected function getQueryOrderMonthServer()
    {
        /*        $sql = "
        SELECT
            od.order_code AS orderCode,
            od.id AS orderId,
            mu.fm_name AS goodName,
            ol.fo_number AS orderNumber,
            ol.good_price AS unitPrice,
            dk.fd_name AS deskName,
            od.update_time AS update_time
        FROM
            food_order AS od,
            food_order_list AS ol,
            food_menu AS mu,
            food_desk AS dk
        WHERE
            MONTH ( NOW( ) ) = MONTH ( od.creation_time )
            AND od.id = ol.order_id
            AND mu.id = ol.goods_id
            AND dk.id = od.desk_id
            AND od.state=0
        ";*/
        $sql = "
SELECT
	od.order_code AS orderCode,
	od.id AS orderId,
	GROUP_CONCAT(mu.fm_name) AS goodName,
	GROUP_CONCAT(ol.fo_number) AS orderNumber,
	GROUP_CONCAT(ol.good_price) AS unitPrice,
	dk.fd_name AS deskName,
	od.update_time AS update_time 
FROM
	food_order AS od,
	food_order_list AS ol,
	food_menu AS mu,
	food_desk AS dk 
WHERE
	MONTH ( NOW( ) ) = MONTH ( od.creation_time ) 
	AND od.id = ol.order_id 
	AND mu.id = ol.goods_id 
	AND dk.id = od.desk_id 
	AND od.state = 0 
GROUP BY
	od.id
";
        $con = $this->setConn();
        $sql = $con->query($sql);
        $rsArr = $rsObj = array();
        while ($rs = $sql->fetch_assoc()) {
            $rsArr["orderCode"] = $rs["orderCode"];
            $rsArr["orderId"] = $rs["orderId"];
            $rsArr["goodName"] = $rs["goodName"];
            $rsArr["orderNumber"] = $rs["orderNumber"];
            $rsArr["unitPrice"] = $rs["unitPrice"];
            $rsArr["deskName"] = $rs["deskName"];
            $rsArr["update_time"] = $rs["update_time"];
            $rsObj[] = $rsArr;
        }
        $con->close();
        return $rsObj;
    }

    /**
     * @Purpose：获取年订单订单
     * @Method Name：getQueryOrderYearServer()
     * @Param：$obj 获取所有POST参数
     * @Author：johnny
     * @Return：返回统一报文
     */
    protected function getQueryOrderYearServer()
    {
        /*        $sql = "
        SELECT
            od.order_code AS orderCode,
            od.id AS orderId,
            mu.fm_name AS goodName,
            ol.fo_number AS orderNumber,
            ol.good_price AS unitPrice,
            dk.fd_name AS deskName,
            od.update_time AS update_time
        FROM
            food_order AS od,
            food_order_list AS ol,
            food_menu AS mu,
            food_desk AS dk
        WHERE
            YEAR ( NOW( ) ) = YEAR ( od.creation_time )
            AND od.id = ol.order_id
            AND mu.id = ol.goods_id
            AND dk.id = od.desk_id
            AND od.state=0
        ";*/
        $sql = "
SELECT
	od.order_code AS orderCode,
	od.id AS orderId,
	GROUP_CONCAT(mu.fm_name) AS goodName,
	GROUP_CONCAT(ol.fo_number) AS orderNumber,
	GROUP_CONCAT(ol.good_price) AS unitPrice,
	dk.fd_name AS deskName,
	od.update_time AS update_time 
FROM
	food_order AS od,
	food_order_list AS ol,
	food_menu AS mu,
	food_desk AS dk 
WHERE
	YEAR ( NOW( ) ) = YEAR ( od.creation_time ) 
	AND od.id = ol.order_id 
	AND mu.id = ol.goods_id 
	AND dk.id = od.desk_id 
	AND od.state = 0 
GROUP BY
	od.id
";
        $con = $this->setConn();
        $sql = $con->query($sql);
        $rsArr = $rsObj = array();
        while ($rs = $sql->fetch_assoc()) {
            $rsArr["orderCode"] = $rs["orderCode"];
            $rsArr["orderId"] = $rs["orderId"];
            $rsArr["goodName"] = $rs["goodName"];
            $rsArr["orderNumber"] = $rs["orderNumber"];
            $rsArr["unitPrice"] = $rs["unitPrice"];
            $rsArr["deskName"] = $rs["deskName"];
            $rsArr["update_time"] = $rs["update_time"];
            $rsObj[] = $rsArr;
        }
        $con->close();
        return $rsObj;
    }

    /*查询今日分菜表*/
    protected function getQueryFoodPointsMenuToDay()
    {
        /*
                $sql = "
        SELECT
            fm.fm_name AS foodName,
            sum( fo_number ) AS foodSum,
            fc.fc_name AS foodClass
        FROM
            food_order AS foo,
            food_order_list AS fo,
            food_menu AS fm,
            food_class AS fc
        WHERE
            fo.goods_id = fm.id
            AND foo.state = 0
            AND foo.id = fo.order_id
            AND fc.id = fm.fm_class
            AND TO_DAYS( fo.update_time ) = TO_DAYS( NOW( ) )
        GROUP BY
            fo.goods_id
        ORDER BY
            fc.id
        ";*/
        $sql = "
SELECT
	fm.fm_name AS foodName,
	sum( fo_number ) AS foodSum,
	fc.fc_name AS foodClass,
	fo.id AS foodListId,
	GROUP_CONCAT( fd.fd_name ) as deskAll,
	foo.id as orderId
FROM
	food_order AS foo,
	food_order_list AS fo,
	food_menu AS fm,
	food_class AS fc,
	food_desk AS fd 
WHERE
	fo.goods_id = fm.id 
	AND foo.state = 0 
	AND fd.id = foo.desk_id 
	AND foo.id = fo.order_id 
	AND fc.id = fm.fm_class 
	AND TO_DAYS( fo.update_time ) = TO_DAYS( NOW( ) ) 
GROUP BY
	fo.goods_id 
ORDER BY
	fc.id
        ";
        $con = $this->setConn();
        $sql = $con->query($sql);
        $rsArr = $rsObj = [];
        while ($rs = $sql->fetch_assoc()) {
            $rsArr["foodName"] = $rs["foodName"];
            $rsArr["foodSum"] = $rs["foodSum"];
            $rsArr["foodClass"] = $rs["foodClass"];
            $rsArr["deskAll"] = $rs["deskAll"];
            $rsArr["orderId"] = $rs["orderId"];
            $rsObj[] = $rsArr;
        }
        $con->close();
        return $rsObj;
    }

    /*查询昨日分菜表*/
    protected function getQueryFoodPointsMenuYesterDay()
    {
        /*
                $sql = "
        SELECT
            fm.fm_name AS foodName,
            sum( fo_number ) AS foodSum,
            fc.fc_name AS foodClass
        FROM
            food_order AS foo,
            food_order_list AS fo,
            food_menu AS fm,
            food_class AS fc
        WHERE
            fo.goods_id = fm.id
            AND foo.state = 0
            AND foo.id = fo.order_id
            AND fc.id = fm.fm_class
            AND TO_DAYS( NOW( ) ) - TO_DAYS( fo.update_time ) = 1
        GROUP BY
            fo.goods_id
        ORDER BY
            fc.id
        ";
        */
        $sql = "
SELECT
	fm.fm_name AS foodName,
	sum( fo_number ) AS foodSum,
	fc.fc_name AS foodClass,
	fo.id AS foodListId,
	GROUP_CONCAT( fd.fd_name ) as deskAll,
	foo.id as orderId
FROM
	food_order AS foo,
	food_order_list AS fo,
	food_menu AS fm,
	food_class AS fc,
	food_desk AS fd 
WHERE
	fo.goods_id = fm.id 
	AND foo.state = 0 
	AND fd.id = foo.desk_id 
	AND foo.id = fo.order_id 
	AND fc.id = fm.fm_class 
	AND TO_DAYS( NOW( ) ) - TO_DAYS( fo.update_time ) = 1 
GROUP BY
	fo.goods_id 
ORDER BY
	fc.id
       ";
        $con = $this->setConn();
        $sql = $con->query($sql);
        $rsArr = $rsObj = [];
        while ($rs = $sql->fetch_assoc()) {
            $rsArr["foodName"] = $rs["foodName"];
            $rsArr["foodSum"] = $rs["foodSum"];
            $rsArr["foodClass"] = $rs["foodClass"];
            $rsArr["deskAll"] = $rs["deskAll"];
            $rsArr["orderId"] = $rs["orderId"];
            $rsObj[] = $rsArr;
        }
        $con->close();
        return $rsObj;
    }

    //删除订单
    protected function getOrderDeleteServer($id)
    {
        $sql = "update {$this->tb_food_order} set state=1 where id='{$id}'";
        $con = $this->setConn();
        $sql = $con->query($sql);
        $con->close();
        return "success";
    }

    //查询用户桌号
    protected function getQueryUserDeskAllServer()
    {
        $sql = "
SELECT
	fd.fd_name AS deskName,
	GROUP_CONCAT(fu.id) AS userId,
	fu.desk_id AS deskId,
	GROUP_CONCAT(fu.desk_rank) AS deskRank,
	GROUP_CONCAT( fw.nickname ) AS nickname 
FROM
	food_user AS fu,
	food_wechat_user AS fw,
	food_desk AS fd 
WHERE
	fu.wechat_id = fw.id 
	AND fu.desk_id = fd.id 
GROUP BY
	fd.id 
ORDER BY
	fu.id desc 
        ";
        $con = $this->setConn();
        $sql = $con->query($sql);
        $rsArr = $rsObj = [];
        while ($rs = $sql->fetch_assoc()) {
            $nickname = explode(",", $rs["nickname"]);
            $deskrank = explode(",", $rs["deskRank"]);
            $userall = explode(",", $rs["userId"]);
            $wname = [];
            $drank = [];
            $userid = [];
            for ($i = 0; $i < count($nickname); $i++) {
                $wname[$i] = base64_decode($nickname[$i]);
                $drank[$i] = $deskrank[$i];
                $userid[$i] = $userall[$i];
            }
            $rsArr["deskName"] = $rs["deskName"];
//            $rsArr["userId"] = $rs["userId"];
            $rsArr["userId"] = $userid;
            $rsArr["deskId"] = $rs["deskId"];
//            $rsArr["deskRank"] = $rs["deskRank"];
            $rsArr["deskRank"] = $drank;
//            $rsArr["nickname"] = $rs["nickname"];
            $rsArr["nickname"] = $wname;
            $rsObj[] = $rsArr;
        }
        $con->close();
        return $rsObj;
    }

    //移除用户桌号
    protected function getDeleteUserDeskServer($userid, $deskid, $deskrank)
    {
        $sql = "update food_user set desk_id=null ,desk_rank=null where id='{$userid}' and desk_id='{$deskid}' and desk_rank='{$deskrank}'";
        $con = $this->setConn();
        $sql = $con->query($sql);
        $rs = $con->affected_rows;
        $con->close();
        return $rs;
    }

    //重置桌长
    protected function getUpdateUseDeskRandServer($userid, $deskid)
    {
        $con = $this->setConn();
        $sql = "update food_user set desk_rank=0 where desk_id='{$deskid}'";
        $con->query($sql);
        $sqls = "update food_user set  desk_rank=1 where id='{$userid}'";
        $con->query($sqls);
        $updateSql = $con->affected_rows;
        $con->close();
        return $updateSql;
    }

}