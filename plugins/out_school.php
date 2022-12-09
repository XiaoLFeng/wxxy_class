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
$out_time = $_POST['out'];
$reason = $_POST['reason'];
$place = $_POST['place'];
$info = $_POST['info'];

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
if (!empty($studentID)) {
    // 发送用户信息
    $url = $setting['API']['Domain']."/out_school/out.php?key=".$setting['Key']; //请求地址
    $arr = array(
        'output'=>"SUCCESS",
        'code'=>200,
        'info'=>"上传成功",
        'data'=>array(
            'studentID'=>$studentID,
            'reason'=>$reason,
            'place'=>$place,
            'info'=>$info,
        )
    ); //请求参数(数组)
    $jsonStr = json_encode($arr); //转换为json格式
    $result = http_post_json($url, $jsonStr);
    $result = json_decode($result,true);

    // 返回结果
    if ($result['output'] == "SUCCESS") {
        echo <<<EOF
            <script language="javascript">
                alert( "已提交出校申请，请通知班长或文体委员！" )
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
} else {
    echo <<<EOF
        <script language="javascript">
            alert( "不要空账户" )
            window.history.go(-1);
        </script>
        EOF;
}