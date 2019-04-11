<?php
/**
 * Created by PhpStorm.
 * User: johnny
 * Date: 2018/9/23
 * Time: 14:29
 */

class GlobalInc
{
    /*数据库连接*/
    private $hostAddress = "localhost";
    private $hostUser = "root";
    private $hostPassword = "admin";
    private $dataBase = "xh_order_food";

    /*数据库表格*/
    protected $tb_food_class = "food_class";
    protected $tb_food_cart = "food_cart";
    protected $tb_food_desk = "food_desk";
    protected $tb_food_image = "food_image";
    protected $tb_food_menu = "food_menu";
    protected $tb_food_order = "food_order";
    protected $tb_food_order_list = "food_order_list";
    protected $tb_food_user = "food_user";
    protected $tb_food_wechat_user = "food_wechat_user";

    /*数据交互地址*/
    private $http_src = "http://localhost/food/api/fornt_api.php";

    /*自定义参数*/
    private $conding;

    /*微信用户查询接口*/
    protected $wechatApi = "http://wcphp172.xinhaimobile.cn/wecaat_login/api/index.php";  //微信查询接口

    protected function __construct()
    {
        $this->setCoding();
        date_default_timezone_set("Asia/Shanghai");
    }

    /**
     * @Purpose：错误码设定
     * @Method Name：setConn()
     * @Param：
     * @Author：johnny
     * @Return：返回正常链接状态
     */
    protected function setCoding()
    {
        $this->conding = array(
            "0" => "成功",
            "401" => "HTTP请求参数不符合要求",
            "503" => "调用额度已超出限制",
            "504" => "服务故障",
            "4000" => "请求参数非法",
            "4100" => "鉴权失败",
            "4200" => "请求过期",
            "4300" => "拒绝访问",
            "4400" => "超过配额",
            "4500" => "重放攻击",
            "4600" => "协议不支持",
            "6000" => "服务器内部错误",
            "6100" => "版本暂不支持",
            "6200" => "接口暂时无法访问",
            "6300" => "数据为空",
            "6301" => "重复数据",
        );
    }

    /**
     * @Purpose：数据库连接设置
     * @Method Name：setConn()
     * @Param：
     * @Author：johnny
     * @Return：返回正常链接状态
     */
    protected function setConn()
    {
        $con = new mysqli($this->hostAddress, $this->hostUser, $this->hostPassword, $this->dataBase);
        if ($con->connect_error) {
            return $this->getReturnJson(6000, $con->connect_error);
        }
        $con->query("set character set 'utf8'");
        $con->query("set names 'utf8'");
        return $con;
    }

    /**
     * @Purpose：统一数据报文格式
     * @Method Name：setRetrun()
     * @Param：
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    public function getReturnJson($num, $txt = "")
    {
        $value = $this->conding[$num];
        if ($txt !== "") {
            $value = $txt;
        }
        $obj = array(
            "code" => $num,
            "msg" => $this->conding[$num],
            "data" => $value
        );
        return json_encode($obj);
    }

    /**
     * @Purpose：加密KEY值
     * @Method Name：getKey()
     * @Param：
     * @Author：johnny
     * @Return：返回加密码KEY值
     */
    public function getKey($appid)
    {
        $redirect_url = "http://www.xinhai.com/foodwww/";
        $key = md5(md5(md5($redirect_url . $appid)));
        return $key;
    }

    /**
     * @Purpose：httpPost
     * @Method Name：getPost($postData, $src)
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    public function getPost($postData, $src)
    {
        if (!isset($src)) {
            $src = $this->http_src;
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $src);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
    }

    /**
     * @Purpose：app 生成数据
     * @Method Name：getKeyReturn()
     * @Param：$post = $_POST
     * @Author：johnny
     * @Return：返回统一数据格式
     */
    public function getKeyReturn()
    {
        $appid = str_pad(mt_rand(0, 999999), 6, "0", 2) . time();
        $ms = date("Y-m-d H:i:s");
        $arr = array(
            "appid" => $appid,
            "ms" => $ms,
            "key" => $this->getKey($appid),
        );
        return $arr;
    }

}