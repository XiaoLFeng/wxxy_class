<?PHP
/*
 * XF_TLS 项目组 API 部
 * 全部代码未开源
 */

// 载入头
include($_SERVER['DOCUMENT_ROOT'].'/api/header-control.php');

// 获取数据
$studentID = htmlspecialchars($_GET['studentID']);

// 函数构建
if (!empty($studentID)) {
    // 数据库获取
    $result_avatar = mysqli_query($sql_conn,"SELECT * FROM ".$setting['SQL_DATA']['info']." WHERE studentID='$studentID'");
    $result_avatar_object = mysqli_fetch_object($result_avatar);
    // 检查是否存在
    if (isset($result_avatar_object->icon) == TRUE) {
        // 若正确信息返回数据
        header('location:'.$result_avatar_object->icon);
    } else {
        // 如果数据错误返回不存在
        header('location: ./logo.jpg');
    }
} else {
    // 没有参数返回404
    header('location: ./404.png');
}

// 处理数据库
mysqli_free_result($result_avatar);
mysqli_close($sql_conn);