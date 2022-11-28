<?PHP
/*
 * wxxy_class 项目组
 * 代码均开源
 */

// 载入头
include($_SERVER['DOCUMENT_ROOT'].'/api/header-control.php');

// 载入组件
$key = htmlspecialchars($_GET['key']);
$type = htmlspecialchars($_GET['type']);
$task_id = htmlspecialchars($_GET['task_id']);

// 获取密钥数据库
$result_key = mysqli_query($conn,"SELECT * FROM ".$setting['SQL_DATA']['system_info']." WHERE info='system_key'");
$sql_key = mysqli_fetch_object($result_key)->text;

// 构建函数
if ($key == $sql_key) {
    if ($type == 'normal') {
        if (!empty($task_id)) {
            // 从数据库获取数据
            $result_task = mysqli_query($conn,"SELECT * FROM ".$setting['SQL_DATA']['task']." WHERE task_id='$task_id'");
            $result_task_object = mysqli_fetch_object($result_task);
            if (!empty($result_task_object->task_id)) {
                // 编译数据
                $data = array(
                    'output'=>'SUCCESS',
                    'code'=>200,
                    'info'=>'数据输出成功',
                    'data'=>array(
                        'id'=>$result_task_object->id,
                        'task_id'=>$result_task_object->task_id,
                        'title'=>$result_task_object->title,
                        'text'=>$result_task_object->text,
                        'creator'=>$result_task_object->creator,
                        'opentime'=>$result_task_object->opentime,
                        'closetime'=>$result_task_object->closetime,
                        'open'=>$result_task_object->open,
                    ),
                );
                // 输出数据
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            } else {
                // 编译数据
                $data = array(
                    'output'=>'TASK_ID_ERROR',
                    'code'=>403,
                    'info'=>'未查询到数据'
                );
                // 输出数据
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
                header("HTTP/1.1 403 Forbidden");
            }
        } elseif (empty($task_id)) {
            // 编译数据
            $data = array(
                'output'=>'TASK_ID_NONE',
                'code'=>403,
                'info'=>'数据缺失'
            );
            // 输出数据
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            header("HTTP/1.1 403 Forbidden");
        } else {
            // 编译数据
            $data = array(
                'output'=>'_NONE',
                'code'=>403,
                'info'=>'未知数据丢失'
            );
            // 输出数据
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            header("HTTP/1.1 403 Forbidden");
        }
    } elseif ($type == 'all') {
        // 从数据库获取数据
        $result_task = mysqli_query($conn,"SELECT * FROM ".$setting['SQL_DATA']['task']." ORDER BY id DESC");
        $num = 1;
        while ($result_task_object = mysqli_fetch_object($result_task)) {
            $array[$num] = array(
                'id'=>$result_task_object->id,
                'task_id'=>$result_task_object->task_id,
                'title'=>$result_task_object->title,
                'creator'=>$result_task_object->creator,
                'opentime'=>$result_task_object->opentime,
                'closetime'=>$result_task_object->closetime,
                'open'=>$result_task_object->open,
            );
            $num ++;
        }
        // 编译数据
        $data = array(
            'output'=>'SUCCESS',
            'code'=>200,
            'info'=>'数据输出成功',
            'data'=>$array,
        );
        // 输出数据
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    } elseif ($type == 'check') {
        if (!empty($task_id)) {
            // 从数据库获取数据
            $result_task = mysqli_query($conn,"SELECT * FROM ".$setting['SQL_DATA']['task']." WHERE task_id='$task_id'");
            $result_task_object = mysqli_fetch_object($result_task);
            if (!empty($result_task_object->task_id)) {
                $result_task_person = mysqli_query($conn,"SELECT * FROM ".$setting['SQL_DATA']['task_person']." a RIGHT JOIN ".$setting['SQL_DATA']['info']." b ON a.studentID=b.studentID");
                while ($result_task_person_object = mysqli_fetch_object($result_task_person)) {
                    if ($result_task_person_object->task_id == $task_id) {
                        $result_person = mysqli_query($conn,"SELECT * FROM ".$setting['SQL_DATA']['info']." WHERE studentID='".$result_task_person_object->creator."'");
                        $result_person_object = mysqli_fetch_object($result_person);
                        $array[$result_task_person_object->studentID] = array(
                            'studentID'=>$result_task_person_object->studentID,
                            'name'=>$result_task_person_object->name,
                            'finish'=>$result_task_person_object->finish,
                            'creator'=>$result_person_object->name,
                            'time'=>$result_task_person_object->time,
                        );
                    }
                }
                // 编译数据
                $data = array(
                    'output'=>'SUCCESS',
                    'code'=>200,
                    'info'=>'数据输出成功',
                    'data'=>array(
                        'id'=>$result_task_object->id,
                        'task_id'=>$result_task_object->task_id,
                        'title'=>$result_task_object->title,
                        'text'=>$result_task_object->text,
                        'person'=>$array,
                    ),
                );
                // 输出数据
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            } else {
                // 编译数据
                $data = array(
                    'output'=>'TASK_ID_ERROR',
                    'code'=>403,
                    'info'=>'未查询到数据'
                );
                // 输出数据
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
                header("HTTP/1.1 403 Forbidden");
            }
        } elseif (empty($task_id)) {
            // 编译数据
            $data = array(
                'output'=>'TASK_ID_NONE',
                'code'=>403,
                'info'=>'数据缺失'
            );
            // 输出数据
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            header("HTTP/1.1 403 Forbidden");
        } else {

        }
    } else {
        // 编译数据
        $data = array(
            'output'=>'TYPE_NONE',
            'code'=>403,
            'info'=>'类型缺失'
        );
        // 输出数据
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        header("HTTP/1.1 403 Forbidden");
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