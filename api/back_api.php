<?php
/**
 * Created by PhpStorm.
 * User: johnny
 * Date: 2018/9/23
 * Time: 16:06
 */
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include_once dirname(dirname(__FILE__)) . "/control/BackManage.php";
$rs = new BackManage();
$appid = isset($_POST["appid"]) ? trim($_POST["appid"]) : die($rs->getReturnJson(4000, "API EMPTY"));  //接口唯一认证
$apikey = isset($_POST["apikey"]) ? trim($_POST["apikey"]) : die($rs->getReturnJson(4000, "API EMPTY")); //接口唯一认证
//请求接口认证
$operation = isset($_POST["operation"]) ? trim($_POST["operation"]) : "";
//echo $operation;
switch ($operation) {
    case "addFoodClass": //菜品分类 添加
        echo $rs->getAddNewFoodClassName($_POST);
        break;
    case "queryClassName": //菜品分类查询
        echo $rs->getQueryClassName($_POST);
        break;
    case "updateFoodClassNameOrderUpdate": //菜品分类修改 顺序
        echo $rs->getUpdateFoodClassNameOrderUpdate($_POST);
        break;
    case "updateFoodClassNameUpdate"://菜品分类修改
        echo $rs->getUpdateFoodClassNameUpdate();
        break;
    case "insertFoodNewGreens": //添加菜品信息
        echo $rs->getInsertFoodNewGreens($_POST);
        break;
    case "UpdateFood":  //修改菜口信息
        echo $rs->getUpdateFood($_POST);
        break;
    case "QueryFoodTarget":  //查询指定菜品
        echo $rs->getQueryFoodTarget($_POST);
        break;
    case "foodQueryAllList": //查询所有菜品
        echo $rs->getFoodQueryAllList($_POST);
        break;
    case"foodTableInsertNew":  //新建餐桌
        echo $rs->getFoodTableInsertNew($_POST);
        break;
    case "QueryTableAllList":  //查询所有餐桌信息
        echo $rs->getQueryTableAllList($_POST);
        break;
    case "QueryOrderDay": //查询今日订单
        echo $rs->getQueryOrderDay();
        break;
    case "QueryOrderYesDay": //查询昨日订单
        echo $rs->getQueryOrderYesDay();
        break;
    case "QueryOrderMonth": //查询月订单
        echo $rs->getQueryOrderMonth();
        break;
    case "QueryOrderYear": //查询年订单
        echo $rs->getQueryOrderYear();
        break;
    case "QueryFoodPointsMenu":  //查询分菜表
        echo $rs->getQueryFoodPointsMenu($_POST);
        break;
    case "orderDelete": //删除订单
        echo $rs->getOrderDelete($_POST);
        break;
    case "QueryUserDeskAll"://查询所有用户的餐桌
        echo $rs->getQueryUserDeskAll();
        break;
    case "DeleteUserDesk"://删除用户餐桌信息
        echo $rs->getDeleteUserDesk($_POST);
        break;
    case "UpdateUseDeskRand"://修改桌长信息
        echo $rs->getUpdateUseDeskRand($_POST);
        break;

    default:
        echo $rs->getReturnJson(4300);
        break;
}