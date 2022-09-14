<?PHP
/*
 * wxxy_class 项目组
 * 代码均开源
 */

// 载入头
include($_SERVER['DOCUMENT_ROOT'].'/api/header-control.php');

// 获取参数
$post = file_get_contents('php://input');
$POST_INFO = json_decode($post,true);

// 构建函数
if ($POST_INFO['key'] == $setting['Key']) {
    // 对数据进行转义，避免数据库注入
    $data_title = addslashes($POST_INFO['data']['title']);
    $data_text = addslashes($POST_INFO['data']['text']);
    $data_creator = addslashes($POST_INFO['data']['creator']);
    $data_opentime = addslashes($POST_INFO['data']['opentime']);
    $data_closetime = addslashes($POST_INFO['data']['closetime']);
    $data_open = addslashes($POST_INFO['data']['open']);

    // 进行数据库匹配（由于没有设置过于复杂的密码则没有）
    start:
    $data_task_id = date("Ymd").rand(0000,9999);
    $result_task = mysqli_query($conn,"SELECT * FROM ".$setting['SQL_DATA']['task']." WHERE task_id='$data_task_id'");
    $result_task_object = mysqli_fetch_object($result_task);
    if (empty($result_task_object->task_id)) {
        mysqli_query($conn,"LOCK TABLE ".$setting['SQL_DATA']['task']." WRITE");
        if (mysqli_query($conn,"INSERT INTO ".$setting['SQL_DATA']['task']." (task_id,title,text,creator,opentime,closetime,open) VALUES ('$data_task_id','$data_title','$data_text','$data_creator','$data_opentime','$data_closetime','$data_open')")) {
            // 编译数据
            $data = array(
                'output'=>'SUCCESS',
                'code'=>200,
                'info'=>'数据成功上传',
            );
            // 输出数据
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        } else {
            // 编译数据
            $data = array(
                'output'=>'MYSQL_ERROR',
                'code'=>403,
                'info'=>'数据库出错，无法上传'
            );
            // 输出数据
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            header("HTTP/1.1 403 Forbidden");
        }
        mysqli_query($conn,"UNLOCK TABLE");
    } else {
        goto start;
    }
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
