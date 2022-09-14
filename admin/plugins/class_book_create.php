<?PHP 
/*
 * 筱锋xiao_lfeng 分享系统（插件）
 * 登录组件
 */

// 定义请求头
header("Content-type:text/html;charset=utf-8");
// 获取组件
include($_SERVER['DOCUMENT_ROOT'].'/setting.inc.php');

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

// 载入用户个人信息
$member_url = $setting['API']['Domain'].'/class/person.php?key='.$setting['Key'].'&type=normal&studentID='.$_COOKIE['studentID'];    
$member_ch = curl_init($member_url);
curl_setopt($member_ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
curl_setopt($member_ch, CURLOPT_RETURNTRANSFER, true);
$member = curl_exec($member_ch);
$member = json_decode($member,true);

if ($member['data']['op'] == "1") {
    // 发送用户信息
    $url = $setting['API']['Domain']."/class/task_create.php"; //请求地址
    $arr = array(
        'output'=>'SUCCESS',
        'code'=>200,
        'info'=>'数据上传完毕',
        'key'=>$setting['Key'],
        'data'=>array(
            'title'=>$_POST['task_title'],
            'text'=>$_POST['task_text'],
            'creator'=>$_COOKIE['studentID'],
            'opentime'=>$_POST['task_opentime'],
            'closetime'=>$_POST['task_closetime'],
            'open'=>'TRUE',
        )
    ); //请求参数(数组)
    $jsonStr = json_encode($arr); //转换为json格式
    $result = http_post_json($url, $jsonStr);
    $result = json_decode($result,true);

    // 返回结果
    if ($result['output'] == "SUCCESS") {
        header('location: /admin/class_book.php');
    } elseif ($result['output'] == "MYSQL_ERROR") {
        echo <<<EOF
            <script language="javascript">
                alert( "数据库错误，请联系管理员" )
                window.history.go(-1);
            </script>
            EOF;
    } else {
        echo <<<EOF
            <script language="javascript">
                alert( "密钥错误" )
                window.history.go(-1);
            </script>
            EOF;
    }
} else {
    echo <<<EOF
        <script language="javascript">
            alert( "你没有权限" )
            window.history.go(-1);
        </script>
        EOF;
}