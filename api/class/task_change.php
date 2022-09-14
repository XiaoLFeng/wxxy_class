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
    $data_studentID = addslashes($POST_INFO['data']['studentID']);
    $data_task_id = addslashes($POST_INFO['data']['task_id']);
    $data_creator = addslashes($POST_INFO['data']['creator']);
    $data_finish = addslashes($POST_INFO['data']['finish']);
    $data_time = date("Y-m-d H:i:s");

    // 进行数据库匹配（由于没有设置过于复杂的密码则没有）
    // 确认数据是否存在
    $result_person = mysqli_query($conn,"SELECT * FROM ".$setting['SQL_DATA']['info']." WHERE studentID='$data_studentID'");
    $result_task = mysqli_query($conn,"SELECT * FROM ".$setting['SQL_DATA']['task']." WHERE task_id='$data_task_id'");
    $result_person_object = mysqli_fetch_object($result_person);
    $result_task_object = mysqli_fetch_object($result_task);
    if (!empty($result_person_object->studentID) and !empty($result_task_object->task_id)) {
        $result_task_person = mysqli_query($conn,"SELECT * FROM ".$setting['SQL_DATA']['task_person']." WHERE studentID='$data_studentID' AND task_id='$data_task_id'");
        $result_task_person_object = mysqli_fetch_object($result_task_person);
        mysqli_query($conn,"LOCK TABLE ".$setting['SQL_DATA']['task_person']." WRITE");
        if (empty($result_task_person_object->studentID)) {
            if (mysqli_query($conn,"INSERT INTO ".$setting['SQL_DATA']['task_person']." (studentID,task_id,finish,creator,time) VALUES ('$data_studentID','$data_task_id','$data_finish','$data_creator','$data_time')")) {
                // 编译数据
                $data = array(
                    'output'=>'SUCCESS',
                    'code'=>200,
                    'info'=>'完成！'
                );
                // 输出数据
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }
        } else {
            if (mysqli_query($conn,"UPDATE ".$setting['SQL_DATA']['task_person']." SET finish='$data_finish',creator='$data_creator',time='$data_time' WHERE studentID='$data_studentID' AND task_id='$data_task_id'")) {
                // 编译数据
                $data = array(
                    'output'=>'SUCCESS_CHANGE',
                    'code'=>200,
                    'info'=>'完成修改！'
                );
                // 输出数据
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }
        }
        mysqli_query($conn,"UNLOCK TABLE");
    } else {
        if (empty($result_person_object->studentID)) {
            // 编译数据
            $data = array(
                'output'=>'USER_NO_CREATE',
                'code'=>403,
                'info'=>'没有此用户'
            );
            // 输出数据
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            header("HTTP/1.1 403 Forbidden");
        } elseif (empty($result_task_object->task_id)) {
            // 编译数据
            $data = array(
                'output'=>'TASK_ID_NO_CREATE',
                'code'=>403,
                'info'=>'未创建作业，无法查询'
            );
            // 输出数据
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            header("HTTP/1.1 403 Forbidden");
        }
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
