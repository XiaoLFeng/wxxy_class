<?PHP
/*
 * wxxy_class 项目组
 * 代码均开源
 */

// 载入头
include($_SERVER['DOCUMENT_ROOT'].'/api/header-control.php');

// 载入组件
$key = htmlspecialchars($_GET['key']);

// 获取密钥数据库
$result_key = mysqli_query($conn,"SELECT * FROM ".$setting['SQL_DATA']['system_info']." WHERE info='system_key'");
$sql_key = mysqli_fetch_object($result_key)->text;

// 构建函数
if (empty($key)) {
    // 循环输出内容
    $result_info = mysqli_query($conn,"SELECT * FROM ".$setting['SQL_DATA']['system_info']);
    while ($result_info_object = mysqli_fetch_object($result_info)) {
        if ($result_info_object->info !== 'system_key') {
            $array[$result_info_object->info] = array(
                'info'=>$result_info_object->info,
                'text'=>$result_info_object->text,
                'load'=>$result_info_object->load,
            );
        }
    }
    // 编译数据
    $data = array(
        'output'=>'SUCCESS',
        'code'=>200,
        'info'=>'输出成功',
        'data'=>$array,
    );
    // 输出数据
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
} else {
    if ($key == $sql_key) {
        // 循环输出内容
        $result_info = mysqli_query($conn,"SELECT * FROM ".$setting['SQL_DATA']['system_info']);
        while ($result_info_object = mysqli_fetch_object($result_info)) {
            $array[$result_info_object->info] = array(
                'info'=>$result_info_object->info,
                'text'=>$result_info_object->text,
                'load'=>$result_info_object->load,
            );
        }
        // 编译数据
        $data = array(
            'output'=>'SUCCESS',
            'code'=>200,
            'info'=>'输出成功',
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
}