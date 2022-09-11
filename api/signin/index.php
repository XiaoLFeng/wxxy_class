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
$studentID = htmlspecialchars($_GET['studentID']);
$time = date("Y-m-d H:i:s");

// 构建函数
if ($key == $setting['Key']) {
    // 选择类型
    if ($type == 'normal') {
        if (!empty($studentID)) {
            mysqli_query($conn,"LOCK TABLE ".$setting['SQL_DATA']['signin']." WRITE");
            if (mysqli_query($conn,"UPDATE ".$setting['SQL_DATA']['signin']." SET signin_20220911='TRUE',time_20220911='$time' WHERE studentID='$studentID'")) {
                // 编译数据
                $data = array(
                    'output'=>'SUCCESS',
                    'code'=>200,
                    'info'=>'已签到',
                );
                // 输出数据
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }
            mysqli_query($conn,"UNLOCK TABLE");
        } else {
            // 编译数据
            $data = array(
                'output'=>'USER_NONE',
                'code'=>403,
                'info'=>'缺少用户信息'
            );
            // 输出数据
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            header("HTTP/1.1 403 Forbidden");
        }
    } elseif ($type == 'admin') {
        $result_siginin_check = mysqli_query($conn,"SELECT * FROM ".$setting['SQL_DATA']['signin']." a LEFT JOIN ".$setting['SQL_DATA']['info']." b ON a.studentID=b.studentID");
        $num = 1;
        while ($result_siginin_check_object = mysqli_fetch_object($result_siginin_check)) {
            $array[$num] = array(
                'studentID'=>$result_siginin_check_object->studentID,
                'name'=>$result_siginin_check_object->name,
                'signin'=>$result_siginin_check_object->signin_20220911,
                'time'=>$result_siginin_check_object->time_20220911,
            );
            $num ++;
        }
        // 编译数据
        $data = array(
            'output'=>'SUCCESS',
            'code'=>200,
            'info'=>'数据输出完毕',
            'data'=>$array,
        );
        // 输出数据
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
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