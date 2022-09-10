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
$student = $_POST['student'];

// 函数构建
// 检查数据是否为空
if (!empty($student)) {
    // 载入信息
    $book_url = $setting['API']['Domain'].'/get_book/change.php?key='.$setting['Key'].'&student='.$student;
    $book_ch = curl_init($book_url);
    curl_setopt($book_ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
    curl_setopt($book_ch, CURLOPT_RETURNTRANSFER, true);
    $book = curl_exec($book_ch);
    $book = json_decode($book,true);

    if ($book['output'] == 'SUCCESS') {
        echo <<<EOF
            <script language="javascript">
                alert( "已完成!" )
                window.location.href = "/get_book.php?key=061823zcw"
            </script>
            EOF;
    } elseif ($book['output'] == 'SQL_DNEY') {
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
            alert( "信息错误，你肯定有毛病" )
            window.history.go(-1);
        </script>
        EOF;
}