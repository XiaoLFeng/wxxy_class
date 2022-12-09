<?PHP
/*
 * wxxy_class 项目组
 * 代码均开源
 */

// 载入头
include($_SERVER['DOCUMENT_ROOT'].'/api/header-control.php');

// 载入组件
$key = htmlspecialchars($_GET['key']);

// 获取参数
$post = file_get_contents('php://input');
$POST_INFO = json_decode($post,true);

// 构建函数
if ($key == $setting['Key']) {
    // 对数据进行转义，避免数据库注入
    $info['studentID'] = addslashes($POST_INFO['data']['studentID']);
    $info['reason'] = addslashes($POST_INFO['data']['reason']);
    $info['place'] = addslashes($POST_INFO['data']['place']);
    $info['info'] = addslashes($POST_INFO['data']['info']);

    // 进行数据库匹配（由于没有设置过于复杂的密码则没有）
    mysqli_query($conn,"LOCK TABLE ".$setting['SQL_DATA']['out_school']." WRITE");
    if (mysqli_query($conn,"INSERT INTO ".$setting['SQL_DATA']['out_school']." (studentID,out_time,out_type,out_place,out_reason) VALUES ('".$info['studentID']."','".date('Y-m-d H:i:s')."','".$info['reason']."', '".$info['place']."', '".$info['info']."')")) {
        // 编译数据
        $data = array(
            'output'=>'SUCCESS',
            'code'=>200,
            'info'=>'数据写入完毕',
        );
        // 输出数据
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    } else {
        // 编译数据
        $data = array(
            'output'=>'DATA_ERROR',
            'code'=>403,
            'info'=>'数据写入错误'
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