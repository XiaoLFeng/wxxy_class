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
    $info['studentID'] = addslashes($POST_INFO['studentID']);
    $info['password'] = $POST_INFO['password'];

    // 进行数据库匹配（由于没有设置过于复杂的密码则没有）
    $result_person = mysqli_query($conn,"SELECT * FROM ".$setting['SQL_DATA']['info']." WHERE studentID='".$info['studentID']."'");
    $result_person_object = mysqli_fetch_object($result_person);
    // 进行密码校验
    if (password_verify($info['password'],$result_person_object->password)) {
        // 编译数据
        $data = array(
            'output'=>'SUCCESS',
            'code'=>200,
            'info'=>'密码正确',
        );
        // 输出数据
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    } else {
    // 编译数据
        $data = array(
            'output'=>'PASSWORD_DENY',
            'code'=>403,
            'info'=>'密码错误'
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