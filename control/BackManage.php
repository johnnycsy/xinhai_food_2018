<?php
/**
 * Created by PhpStorm.
 * User: johnny
 * Date: 2018/9/23
 * Time: 16:09
 */
include_once dirname(dirname(__FILE__)) . "/manual/BackEnd.php";

class BackManage extends BackEnd
{
    public function __construct()
    {
        BackEnd::__construct();
    }

    /**
     * @Purpose：添加菜品分类名称
     * @Method Name：getAddNewFoodClassName()
     * @Param：$obj 获取所有POST参数
     * @Author：johnny
     * @Return：返回统一报文
     */
    public function getAddNewFoodClassName($obj)
    {
        $appid = isset($obj["appid"]) ? trim($_POST["appid"]) : "";
        $apikey = isset($obj["apikey"]) ? trim($_POST["apikey"]) : "";
        $operation = isset($obj["operation"]) ? trim($_POST["operation"]) : "";
        $classname = isset($obj["classname"]) ? trim($_POST["classname"]) : "";
        $key = $this->getKey($appid);
        if ($apikey !== $key) {
            return $this->getReturnJson(4100);
        }
        if ($classname === "") {
            return $this->getReturnJson(4000);
        }
        //查询当前分类是否存在
        $foodTF = $this->getFoodClassNameDF($classname);
        if ($foodTF === false) {
            return $this->setAddNewFoodClassName($classname);
        } else {
            return $this->getReturnJson(6301);
        }
    }

    /**
     * @Purpose：查询所有类目名称
     * @Method Name：getQueryClassName()
     * @Param：
     * @Author：johnny
     * @Return：返回统一报文
     */
    public function getQueryClassName($obj)
    {
        $key = $this->getKey($obj["appid"]);
        if ($key !== $obj["apikey"]) {
            return $this->getReturnJson(4100);
        }
        $rs = $this->getQueryClassNameDF();
        return $this->getReturnJson(0, $rs);
    }

    /**
     * @Purpose：查询所有类目名称
     * @Method Name：getUpdateFoodClassNameOrderUpdate()
     * @Param：$obj 获取所有POST参数
     * @Author：johnny
     * @Return：返回统一报文
     */
    public function getUpdateFoodClassNameOrderUpdate($obj)
    {
        $appid = isset($obj["appid"]) ? trim($obj["appid"]) : "";
        $apikey = isset($obj["apikey"]) ? trim($obj["apikey"]) : "";
        $id = isset($obj["id"]) ? trim($obj["id"]) : "";
        $orderNumber = isset($obj["orderNumber"]) ? trim($obj["orderNumber"]) : "";
        $target = isset($obj["target"]) ? trim($obj["target"]) : "";
        if ($id == "" || $orderNumber == "" || $target == "") {
            return $this->getReturnJson(4000);
        }
        $key = $this->getKey($appid);
        if ($key !== $apikey) {
            return $this->getReturnJson(4100);
        }
        $rs = $this->getUpdateFoodClassNameOrderUpdateDF($id, $target);
        if ($rs === true) {
            return $this->getReturnJson(0);
        } else {
            return $this->getReturnJson(6000, $rs);
        }
    }

    /**
     * @Purpose：查询所有类目名称
     * @Method Name：getUpdateFoodClassNameUpdate()
     * @Param：$obj 获取所有POST参数
     * @Author：johnny
     * @Return：返回统一报文
     */
    public function getUpdateFoodClassNameUpdate()
    {
        $id = isset($_POST["id"]) ? trim($_POST["id"]) : "";
        $classname = isset($_POST["classname"]) ? trim($_POST["classname"]) : "";
        if ($id == "" || $classname == "") {
            return $this->getReturnJson(4000);
        }
        $obj = $this->getUpdateFoodClassNameUpdateServer($id, $classname);
        return $this->getReturnJson(0, $obj);
    }

    /**
     * @Purpose：添加菜品信息
     * @Method Name：getUpdateFoodClassNameOrderUpdate()
     * @Param：$obj 获取所有POST参数
     * @Author：johnny
     * @Return：返回统一报文
     */
    public function getInsertFoodNewGreens($obj)
    {
        $appid = isset($obj["appid"]) ? trim($obj["appid"]) : "";
        $apikey = isset($obj["apikey"]) ? trim($obj["apikey"]) : "";
        $operation = isset($obj["operation"]) ? trim($obj["operation"]) : "";
        $img = array();
        $img[0] = isset($obj["img1"]) ? trim($obj["img1"]) : "";
        $img[1] = isset($obj["img2"]) ? trim($obj["img2"]) : "";
        $img[2] = isset($obj["img3"]) ? trim($obj["img3"]) : "";
        $img[3] = isset($obj["img4"]) ? trim($obj["img4"]) : "";
        $img[4] = isset($obj["img5"]) ? trim($obj["img5"]) : "";
        $fm_name = isset($obj["fm_name"]) ? trim($obj["fm_name"]) : "";
        $fm_bazaar = isset($obj["fm_bazaar"]) ? number_format((float)$obj["fm_bazaar"], 2) : "";
        $fm_price = isset($obj["fm_price"]) ? number_format((float)$obj["fm_price"], 2) : "";
        $fm_class = isset($obj["fm_class"]) ? trim($obj["fm_class"]) : "";
        //        判决KEY值是否正确
        $key = $this->getKey($appid);
        if ($key !== $apikey) {
            return $this->getReturnJson(4000, "key");
        }
        //判断重要信息是否为空
        if ($fm_name == "" || $fm_price == "" || $fm_class == "") {
            return $this->getReturnJson(4000);
        }
        //图片判断
        if (empty($img)) {
            return $this->getReturnJson(4000, "image");
        }
        //判断小菜是否存在
        $rsTF = $this->getQueryFoodName($fm_name);
//        var_dump($rsTF)
        if ($rsTF == true) {
            return $this->getReturnJson(6301);
        }
        //数据进行何存
        $rs = $this->getInsertFoodNewGreensDF($fm_name, $fm_bazaar, $fm_price, $fm_class);
        if (is_numeric($rs) === false) {
            return $this->getReturnJson(6000, $rs);
        }
        $rsImg = $this->getInsertFoodNewGreensImageDF($rs, $img);
        if ($rsImg === true) {
            return $this->getReturnJson(0, "添加成功");
        } else {
            return $this->getReturnJson(6000, $rsImg);
        }
    }

    /*查询指定菜品信息*/
    public function getQueryFoodTarget($obj)
    {
        $id = isset($obj["id"]) ? trim($obj["id"]) : "";
        if ($id == "") {
            return $this->getReturnJson(4000, "key");
        }
        //查询数据
        $obj = $this->getQueryFoodTargetServer($id);
        return $this->getReturnJson(0, $obj);
    }

    /*修改菜品信息*/
    public function getUpdateFood($obj)
    {
        $appid = isset($obj["appid"]) ? trim($obj["appid"]) : "";
        $apikey = isset($obj["apikey"]) ? trim($obj["apikey"]) : "";
        $operation = isset($obj["operation"]) ? trim($obj["operation"]) : "";
        $id = isset($obj["id"]) ? trim($obj["id"]) : "";
//        $img = array();
//        $img[0] = isset($obj["img1"]) ? trim($obj["img1"]) : "";
//        $img[1] = isset($obj["img2"]) ? trim($obj["img2"]) : "";
//        $img[2] = isset($obj["img3"]) ? trim($obj["img3"]) : "";
//        $img[3] = isset($obj["img4"]) ? trim($obj["img4"]) : "";
//        $img[4] = isset($obj["img5"]) ? trim($obj["img5"]) : "";
        $img = isset($obj["img"]) ? $obj["img"] : "";
        $fm_name = isset($obj["fm_name"]) ? trim($obj["fm_name"]) : "";
        $fm_bazaar = isset($obj["fm_bazaar"]) ? number_format((float)$obj["fm_bazaar"], 2) : "";
        $fm_price = isset($obj["fm_price"]) ? number_format((float)$obj["fm_price"], 2) : "";
        $fm_class = isset($obj["fm_class"]) ? trim($obj["fm_class"]) : "";
        //        判决KEY值是否正确
        $key = $this->getKey($appid);
        if ($key !== $apikey) {
            return $this->getReturnJson(4000, "key");
        }
        //判断重要信息是否为空
        if ($fm_name == "" || $fm_price == "" || $fm_class == "" || $id == "") {
            return $this->getReturnJson(4000);
        }
//        图片判断
//        if (empty($img)) {
//            return $this->getReturnJson(4000, "image");
//        }
//        return $this->getReturnJson(4000,$img[0]);
        //数据进行何存
        $rs = $this->getUpdateFoodServer($fm_name, $fm_bazaar, $fm_price, $fm_class, $id);  //修改数据
        if (is_numeric($rs) === false) {
            return $this->getReturnJson(6000, $rs);
        }
        if (!empty($img)) {
            $rsImg = $this->getUpdateImageServer($img, $id); //添加图片
        }
//        return $this->getReturnJson(4000,$rsImg);
        return $this->getReturnJson(0, "添加成功");
    }

    /**
     * @Purpose：查询当前所有菜信息
     * @Method Name：getUpdateFoodClassNameOrderUpdate()
     * @Param：$obj 获取所有POST参数
     * @Author：johnny
     * @Return：返回统一报文
     */
    public function getFoodQueryAllList($obj)
    {
        $appid = isset($obj["appid"]) ? trim($obj["appid"]) : "";
        $apikey = isset($obj["apikey"]) ? trim($obj["apikey"]) : "";
        $operation = isset($obj["operation"]) ? trim($obj["operation"]) : "";
        $page = isset($obj["page"]) ? trim($obj["page"]) : 1;
        $key = $this->getKey($appid);
        if ($key !== $apikey) {
            return $this->getReturnJson(4000, $apikey . "==" . $key);
        }
        $rs = $this->getFoodQueryAllListDF((int)$page);
        return $this->getReturnJson(0, $rs);
    }

    /**
     * @Purpose：新建 餐桌
     * @Method Name：getFoodTableInsertNew()
     * @Param：$obj 获取所有POST参数
     * @Author：johnny
     * @Return：返回统一报文
     */
    public function getFoodTableInsertNew($obj)
    {
        $appid = isset($obj["appid"]) ? trim($obj["appid"]) : "";
        $apikey = isset($obj["apikey"]) ? trim($obj["apikey"]) : "";
        $fd_code = isset($obj["fd_code"]) ? (int)($obj["fd_code"]) : "";  //餐桌编号
        $fd_name = isset($obj["fd_name"]) ? trim($obj["fd_name"]) : ""; //餐桌名称
        $key = $this->getKey($appid);
        if ($key !== $apikey) {
            return $this->getReturnJson(4000, "KEY ERROR");
        }
        //判断编码是否存在
        if ($fd_code == "") {
            $fd_code = str_pad(mt_rand(0, 999), 3, "0", STR_PAD_BOTH);
        }
        //判断数据是否为空
        if ($fd_name == "") {
            return $this->getReturnJson(4000, "empty data");
        }
        //查询数据是否存在
        $fname = $this->getQueryFoodTableName($fd_name);
        if ($fname !== true) {
            return $this->getReturnJson(4000, "food name repetition");
        }
        //保存数据
        $rs = $this->getFoodTableInsertNewDF($fd_code, $fd_name, $obj["fd_order"], $obj["state"]);
        if ($rs === true) {
            $rsEnd = $this->getReturnJson(0);
        } else {
            $rsEnd = $this->getReturnJson(4000, $rs);
        }
        return $rsEnd;
    }

    /**
     * @Purpose：查询餐桌信息
     * @Method Name：getQueryTableAllList()
     * @Param：$obj 获取所有POST参数
     * @Author：johnny
     * @Return：返回统一报文
     */
    public function getQueryTableAllList($obj)
    {
        $appid = isset($obj["appid"]) ? trim($obj["appid"]) : "";
        $apikey = isset($obj["apikey"]) ? trim($obj["apikey"]) : "";
        $key = $this->getKey($appid);
        if ($key !== $apikey) {
            return $this->getReturnJson(4000, "key error");
        }
        //查询餐桌信息
        $rs = $this->getQueryTableAllListDF();
        return $this->getReturnJson(0, $rs);
    }

    /**
     * @Purpose：查询今日订单
     * @Method Name：getQueryTableAllList()
     * @Param：$obj 获取所有POST参数
     * @Author：johnny
     * @Return：返回统一报文
     */
    public function getQueryOrderDay()
    {
        $obj = $this->getQueryOrderDayServer();
        return $this->getReturnJson(0, $obj);
    }

    /**
     * @Purpose：查询昨日订单
     * @Method Name：getQueryOrderYesDay()
     * @Param：$obj 获取所有POST参数
     * @Author：johnny
     * @Return：返回统一报文
     */
    public function getQueryOrderYesDay()
    {
        $obj = $this->getQueryOrderYesDayServer();
        return $this->getReturnJson(0, $obj);
    }

    /**
     * @Purpose：查询月订单信息
     * @Method Name：getQueryOrderMonth()
     * @Param：$obj 获取所有POST参数
     * @Author：johnny
     * @Return：返回统一报文
     */
    public function getQueryOrderMonth()
    {
        $obj = $this->getQueryOrderMonthServer();
        return $this->getReturnJson(0, $obj);
    }

    /**
     * @Purpose：查询年订单信息
     * @Method Name：getQueryOrderMonth()
     * @Param：$obj 获取所有POST参数
     * @Author：johnny
     * @Return：返回统一报文
     */
    public function getQueryOrderYear()
    {
        $obj = $this->getQueryOrderYearServer();
        return $this->getReturnJson(0, $obj);
    }

    /**
     * @Purpose：查询年订单信息
     * @Method Name：getQueryFoodPointsMenu()
     * @Param：$postObj 获取所有POST参数
     * @Author：johnny
     * @Return：返回统一报文
     */
    public function getQueryFoodPointsMenu($postObj)
    {
        $timeShow = isset($postObj["qtime"]) ? trim($_POST["qtime"]) : "";
        switch ($timeShow) {
            case "today":
                $obj = $this->getQueryFoodPointsMenuToDay();
                return $this->getReturnJson(0, $obj);
                break;
            case "yesterday":
                $obj = $this->getQueryFoodPointsMenuYesterDay();
                return $this->getReturnJson(0, $obj);
                break;
            default:
                return $this->getReturnJson(4000);
                break;
        }
    }

    /*删除订单*/
    public function getOrderDelete($obj)
    {
        $id = isset($obj["id"]) ? trim($obj["id"]) : "";
        if ($id == "") {
            return $this->getReturnJson(4000);
        } else {
            $rs = $this->getOrderDeleteServer($id);
            return $this->getReturnJson(0, $rs);
        }
    }

    //查询所有用户的餐桌
    public function getQueryUserDeskAll()
    {
        $rs = $this->getQueryUserDeskAllServer();
        return $this->getReturnJson(0, $rs);
    }

//删除用户餐桌信息
    public function getDeleteUserDesk($obj)
    {
        $userid = isset($obj["userid"]) ? trim($obj["userid"]) : "";
        $deskid = isset($obj["deskid"]) ? trim($obj["deskid"]) : "";
        $deskrank = isset($obj["deskrank"]) ? trim($obj["deskrank"]) : "";
        if ($userid == "" || $deskid == "" || $deskrank == "") {
            return $this->getReturnJson(4000);
        }
        $rs = $this->getDeleteUserDeskServer($userid, $deskid, $deskrank);
        return $this->getReturnJson(0, $rs);
    }

//修改桌长信息
    public function getUpdateUseDeskRand($obj)
    {
        $userid = isset($obj["userid"]) ? trim($obj["userid"]) : "";
        $deskid = isset($obj["deskid"]) ? trim($obj["deskid"]) : "";
        if ($userid == "" || $deskid == "") {
            return $this->getReturnJson(4000);
        }
        $rs = $this->getUpdateUseDeskRandServer($userid, $deskid);
        return $this->getReturnJson(0, $rs);
    }

}