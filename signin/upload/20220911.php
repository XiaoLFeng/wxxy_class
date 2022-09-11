<?PHP 
/*
 * 筱锋xiao_lfeng 分享系统（插件）
 * 登录组件
 */

// 定义请求头
header("Content-type:text/html;charset=utf-8");
// 获取组件
include($_SERVER['DOCUMENT_ROOT'].'/setting.inc.php');
// 获取参数
$studentID = $_COOKIE['studentID'];
$sigin_id = '20220911';

// 函数构建
// 检查数据是否为空
if (!empty($studentID)) {
    // 载入信息
    $signin_url = $setting['API']['Domain'].'/signin/?key='.$setting['Key'].'&studentID='.$studentID.'&type=normal';
    $signin_ch = curl_init($signin_url);
    curl_setopt($signin_ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
    curl_setopt($signin_ch, CURLOPT_RETURNTRANSFER, true);
    $signin = curl_exec($signin_ch);
    $signin = json_decode($signin,true);

    if ($signin['output'] == 'SUCCESS') {
        echo <<<EOF
            <script language="javascript">
                alert( "已完成!" )
                window.location.href = "/signin/20220911.php"
            </script>
            EOF;
    } elseif ($signin['output'] == 'SQL_DNEY') {
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
            alert( "您未登录！" )
            window.location.href = "/auth.php"
        </script>
        EOF;
}