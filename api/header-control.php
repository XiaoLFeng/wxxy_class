<?PHP
/*
 * wxxy_class 前置载入配置
 * 开源
 */

// 设置请求头
header('Content-Type: application/json;charset=utf-8');
header('Access-Control-Allow-Origin:*'); 

// 获取数据（获取数据库信息）
include($_SERVER['DOCUMENT_ROOT'].'/setting.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/plugins/sql_conn.php');