<?PHP 
/*
 * 筱锋xiao_lfeng 分享系统（插件）
 * 信息上传组件
 */

// 定义请求头
header("Content-type:text/html;charset=utf-8");
// 获取组件
include($_SERVER['DOCUMENT_ROOT'].'/setting.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/plugins/sql_conn.php');

// 载入用户个人信息
$member_url = $setting['API']['Domain'].'/class/person.php?key='.$setting['Key'].'&type=normal&studentID='.$_COOKIE['studentID'];    
$member_ch = curl_init($member_url);
curl_setopt($member_ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
curl_setopt($member_ch, CURLOPT_RETURNTRANSFER, true);
$member = curl_exec($member_ch);
$member = json_decode($member,true);

// 获取参数
$studentID = $_COOKIE['studentID'];
$type = htmlspecialchars($_GET['type']);

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
if (!empty($studentID)) {
    // 发送用户信息
    $url = $setting['API']['Domain']."/class/info_change.php"; //请求地址
    $arr = array(
        'output'=>'SUCCESS',
        'code'=>200,
        'info'=>'数据已发送',
        'ssid'=>$member['data']['ssid'],
        'data'=>array(
            'studentID'=>$studentID,
            'person_displayname'=>$_POST['person_displayname'],
            'person_qq'=>$_POST['person_qq'],
            'person_city'=>$_POST['person_city'],
        ),
    ); //请求参数(数组)
    $jsonStr = json_encode($arr); //转换为json格式
    $result = http_post_json($url, $jsonStr);
    $result = json_decode($result,true);

    // 反馈结果
    if ($result['output'] == 'SUCCESS') {
        echo <<<EOF
            <script language="javascript">
                alert( "已完成!" )
                window.location.href = "/setting.php"
            </script>
            EOF;
    } elseif ($result['output'] == 'SQL_DNEY') {
        echo <<<EOF
            <script language="javascript">
                alert( "操作拒绝！已经有数据了" )
                window.history.go(-1);
            </script>
            EOF;
    } else {
        echo <<<EOF
            <script language="javascript">
                alert( "缺少密钥" )
                window.history.go(-1);
            </script>
            EOF;
    }
} else {
    echo <<<EOF
        <script language="javascript">
            alert( "已完成!" )
            window.location.href = "/auth.php?callback=https://ourwxxy.x-lf.com/setting.php"
        </script>
        EOF;
}