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

// 函数构建
// 检查数据是否为空
if (!empty($studentID) and !empty($password)) {
    // 检查用户
    if ($result_person = mysqli_query($conn,"SELECT * FROM ".$setting['SQL_DATA']['info']." WHERE studentID='$studentID'")) {
        $result_person_object = mysqli_fetch_object($result_person);
        if ($password == $result_person_object->password) {
            $keyID = $result_person_object->studentID;
            setcookie( 'studentID' , $keyID , time()+2678400 , '/' , '');
            if (empty($callback)) {
                $callbacks = '/';
            } else {
                $callbacks = $callback;
            }
            header('location:'.$callbacks);
        } else {
            echo <<<EOF
                <script language="javascript">
                    alert( "密码错误" )
                    window.history.go(-1);
                </script>
                EOF;
        }
    } else {
        echo <<<EOF
            <script language="javascript">
                alert( "数据库查询失败" )
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