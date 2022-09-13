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
$name = htmlspecialchars($_GET['name']);

// 获取密钥数据库
$result_key = mysqli_query($conn,"SELECT * FROM ".$setting['SQL_DATA']['system_info']." WHERE info='system_key'");
$sql_key = mysqli_fetch_object($result_key)->text;

// 构建函数
if ($key == $sql_key) {
    if ($type == 'normal') {
        if (!empty($name) and !empty($studentID)) {
            // 编译数据
            $data = array(
                'output'=>'DATA_OUT',
                'code'=>403,
                'info'=>'数据多余'
            );
            // 输出数据
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            header("HTTP/1.1 403 Forbidden");
        } elseif (empty($name) and empty($studentID)) {
            // 编译数据
            $data = array(
                'output'=>'DATA_IN',
                'code'=>403,
                'info'=>'数据缺失'
            );
            // 输出数据
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            header("HTTP/1.1 403 Forbidden");
        } else {
            function name() {
                global $studentID,$name;
                if (empty($name)) {
                    return "studentID='".$studentID."'";
                } elseif (empty($studentID)) {
                    return "name='".$name."'";
                }
            }
            // 从数据库获取数据
            $result_person = mysqli_query($conn,"SELECT * FROM ".$setting['SQL_DATA']['info']." WHERE ".name());
            $result_person_object = mysqli_fetch_object($result_person);
            if ($result_person_object->studentID !== NULL) {
                // 编译数据
                $data = array(
                    'output'=>'SUCCESS',
                    'code'=>200,
                    'info'=>'数据输出成功',
                    'data'=>array(
                        'studentID'=>$result_person_object->studentID,
                        'name'=>$result_person_object->name,
                        'dormitory'=>$result_person_object->dormitory,
                        'op'=>$result_person_object->op,
                        'office'=>$result_person_object->office,
                        'gender'=>$result_person_object->gender,
                        'qq'=>$result_person_object->qq,
                        'displayname'=>$result_person_object->displayname,
                        'ssid'=>$result_person_object->ssid,
                        'city'=>$result_person_object->city,
                    )
                );
                // 输出数据
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            } else {
                // 编译数据
                $data = array(
                    'output'=>'SELECT_NONE',
                    'code'=>403,
                    'info'=>'未查询到数据'
                );
                // 输出数据
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
                header("HTTP/1.1 403 Forbidden");
            }
        }
    } elseif ($type == 'all') {
        // 从数据库获取数据
        $result_person = mysqli_query($conn,"SELECT * FROM ".$setting['SQL_DATA']['info']);
        while ($result_person_object = mysqli_fetch_object($result_person)) {
            $array[$result_person_object->uid] = array(
                'studentID'=>$result_person_object->studentID,
                    'name'=>$result_person_object->name,
                    'dormitory'=>$result_person_object->dormitory,
                    'op'=>$result_person_object->op,
                    'office'=>$result_person_object->office,
                    'gender'=>$result_person_object->gender,
                    'qq'=>$result_person_object->qq,
            );
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