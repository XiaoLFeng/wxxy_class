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
    $result_outschool_select = mysqli_query($conn,"SELECT * FROM ".$setting['SQL_DATA']['out_school']." a LEFT JOIN ".$setting['SQL_DATA']['info']." b ON a.studentID=b.studentID WHERE out_time LIKE '%".date('Y-m-d')."%'");
    $num = 1;
    while ($result_outschool_select_object = mysqli_fetch_object($result_outschool_select)) {
        $array[$num] = array(
            'studentID'=>$result_outschool_select_object->studentID,
            'name'=>$result_outschool_select_object->name,
            'out_time'=>$result_outschool_select_object->out_time,
            'back_time'=>$result_outschool_select_object->back_ttime,
            'out_type'=>$result_outschool_select_object->out_type,
            'out_place'=>$result_outschool_select_object->out_place,
            'out_reason'=>$result_outschool_select_object->out_reason,
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