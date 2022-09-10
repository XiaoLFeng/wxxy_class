<?PHP 
/*
 * 筱锋xiao_lfeng 分享系统（插件）
 * 登录组件
 */

// 定义请求头
header("Content-type:text/html;charset=utf-8");
// 获取组件
include($_SERVER['DOCUMENT_ROOT'].'/setting.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/plugins/sql_conn.php');
// 获取参数
$studentID = $_POST['studentID'];
$password = $_POST['password'];
$callback = htmlspecialchars($_GET['callback']);

// 注册函数
    // 发送POST
    function http_post_json($url, $jsonStr) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Content-Length: ' . strlen($jsonStr)
            )
        );
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

// 函数构建
// 检查数据是否为空
if (!empty($studentID) and !empty($password)) {
    // 发送用户信息
    $url = $setting['API']['Domain']."/auth/login.php?key=".$setting['Key']; //请求地址
    $arr = array(
        'studentID'=>$studentID,
        'password'=>$password,
    ); //请求参数(数组)
    $jsonStr = json_encode($arr); //转换为json格式
    $result = http_post_json($url, $jsonStr);
    $result = json_decode($result,true);

    // 返回结果
    if ($result['output'] == "SUCCESS") {
        // 赋予COOKIE
        setcookie( 'studentID' , $studentID , time()+2678400 , '/' , '');
        // 返回
        if (empty($callback)) {
            header('location: /index.php');
        } else {
            header('location: '.$callback);
        }
    } elseif ($result['output'] == "PASSWORD_DENY") {
        echo <<<EOF
            <script language="javascript">
                alert( "密码错误" )
                window.history.go(-1);
            </script>
            EOF;
    } else {
        echo <<<EOF
            <script language="javascript">
                alert( "未知错误" )
                window.history.go(-1);
            </script>
            EOF;
    }
} else {
    echo <<<EOF
        <script language="javascript">
            alert( "不要空账户或者密码" )
            window.history.go(-1);
        </script>
        EOF;
}