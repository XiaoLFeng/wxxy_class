<?PHP
/*
 * wxxy_class 项目组
 * 代码均开源
 */

// 载入头
include($_SERVER['DOCUMENT_ROOT'].'/api/header-control.php');

// 载入组件
$key = htmlspecialchars($_GET['key']);
$student = htmlspecialchars($_GET['student']);
$time = date("Y-m-d H:i:s");

// 构建函数
if ($key == $setting['Key']) {
    // 对数据表进行检查
    // 对数据表进行写入操作
    mysqli_query($conn,"LOCK TABLE ".$setting['SQL_DATA']['book']." WRITE");
    $result_book_person = mysqli_query($conn,"SELECT * FROM ".$setting['SQL_DATA']['book']." WHERE s_ID='$student'");
    $result_book_person_object = mysqli_fetch_object($result_book_person);
    if (empty($result_book_person_object->s_ID)) {
        if (mysqli_query($conn,"INSERT INTO ".$setting['SQL_DATA']['book']." (s_ID,getbook,time) VALUES ('$student','TRUE','$time')")) {
            // 编译数据
            $data = array(
                'output'=>'SUCCESS',
                'code'=>200,
                'info'=>'操作已完成',
            );
            // 输出数据
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }
    } else {
        // 编译数据
        $data = array(
            'output'=>'SQL_DENY',
            'code'=>403,
            'info'=>'操作拒绝！已经有数据了'
        );
        // 输出数据
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
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