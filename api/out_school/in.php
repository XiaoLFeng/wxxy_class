<?PHP
/*
 * wxxy_class 项目组
 * 代码均开源
 */

// 载入头
include($_SERVER['DOCUMENT_ROOT'].'/api/header-control.php');

// 载入组件
$key = htmlspecialchars($_GET['key']);
$studentID = htmlspecialchars($_GET['studentID']);

// 构建函数
if ($key == $setting['Key']) {
    mysqli_query($conn,"LOCK TABLE ".$setting['SQL_DATA']['out_school']." WRITE");
    $result_outschool_select = mysqli_query($conn,"SELECT * FROM ".$setting['SQL_DATA']['out_school']." WHERE studentID=$studentID ORDER BY out_time DESC");
    $result_outschool_select_object = mysqli_fetch_object($result_outschool_select);

    if (mysqli_query($conn,"UPDATE ".$setting['SQL_DATA']['out_school']." SET back_ttime='".date('Y-m-d H:i:s')."' WHERE id='".$result_outschool_select_object->id."'")) {
        // 编译数据
        $data = array(
            'output'=>'SUCCESS',
            'code'=>200,
            'info'=>'已登记返校'
        );
        // 输出数据
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    } else {
        // 编译数据
        $data = array(
            'output'=>'DATA_ERROR',
            'code'=>403,
            'info'=>'数据错误'
        );
        // 输出数据
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        header("HTTP/1.1 403 Forbidden");
    }
    mysqli_query($conn,"UNLOCK TABLE");
} else {
    // 编译数据
    $data = array(
        'output'=>'KEY_ERROR',
        'code'=>403,
        'info'=>'密钥错误'
    );
    // 输出数据
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
    header("HTTP/1.1 403 Forbidden");
}