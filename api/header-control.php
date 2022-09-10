<?PHP
/*
 * wxxy_class 前置载入配置
 * 开源
 */

// 设置请求头
header('Content-Type: application/json;charset=utf-8');

// 获取数据（获取数据库信息）
include($_SERVER['DOCUMENT_ROOT'].'/setting.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/plugins/sql_conn.php');

// 日志记录
    // 日志记录时间
    $logs_time = date("Y-m-d H:i:s");
    // 日志记录用户使用的IP情况
    $logs_ip = $_SERVER["REMOTE_ADDR"];