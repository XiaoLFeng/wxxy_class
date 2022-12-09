<?PHP 
/*
 * 筱锋xiao_lfeng 分享系统（插件）
 * 进出校组件
 */

// 定义请求头
header("Content-type:text/html;charset=utf-8");
// 获取组件
include($_SERVER['DOCUMENT_ROOT'].'/setting.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/plugins/sql_conn.php');
// 获取参数
$studentID = $_POST['studentID'];

// 载入用户个人信息
$result_url = $setting['API']['Domain'].'/out_school/in.php?key='.$setting['Key'].'&studentID='.$studentID;    
$result_ch = curl_init($result_url);
curl_setopt($result_ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
curl_setopt($result_ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($result_ch);
$result = json_decode($result,true);

// 返回结果
if ($result['output'] == "SUCCESS") {
    echo <<<EOF
        <script language="javascript">
            alert( "已销假，请通知班长或文体委员！" )
            window.location.replace("/out_school.php");
        </script>
        EOF;
} elseif ($result['output'] == "DATA_ERROR") {
    echo <<<EOF
        <script language="javascript">
            alert( "数据出错，请重试" )
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