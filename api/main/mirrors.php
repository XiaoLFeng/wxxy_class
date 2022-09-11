<?PHP 
/*
 * XF_TLS 项目组 API 部
 * 全部代码未开源
 */

// 载入头
include($_SERVER['DOCUMENT_ROOT'].'/api/header-control.php');

// 参数获取
$key = htmlspecialchars($_GET['key']);

// 获取密钥数据库
$result_key = mysqli_query($conn,"SELECT * FROM ".$setting['SQL_DATA']['system_info']." WHERE info='system_key'");
$sql_key = mysqli_fetch_object($result_key)->text;

// 数据库信息获取
if (!empty($key)) {
    if ($key == $sql_key) {
        // 从数据库获取信息
        $result_info = mysqli_query($conn,"SELECT * FROM ".$setting['SQL_DATA']['system_info']." WHERE info='web_mirror'");
        $result_info_object = mysqli_fetch_object($result_info);
        // 整理参数
        if ($result_info_object->text == 'akass') {
            $info = array(
                'bootstrap_css'=>'https://npm.akass.cn/bootstrap@5.1.3/dist/css/bootstrap.css',
                'bootstrap_icon'=>'https://npm.akass.cn/bootstrap-icons@1.8.2/font/bootstrap-icons.css',
                'bootstrap_js'=>'https://npm.akass.cn/bootstrap@5.1.3/dist/js/bootstrap.min.js',
                'bootstrap_bundle_js'=>'https://npm.akass.cn/bootstrap@5.1.3/dist/js/bootstrap.bundle.js',
                'jquery'=>'https://npm.akass.cn/jquery@3.2.1/dist/jquery.min.js',
                'qweather'=>'https://npm.akass.cn/qweather-icons@1.1.1/font/qweather-icons.css'
            );
        } elseif ($result_info_object->text == 'jsdelivr') {
            $info = array(
                'bootstrap_css'=>'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css',
                'bootstrap_icon'=>'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css',
                'bootstrap_js'=>'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js',
                'bootstrap_bundle_js'=>'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js',
                'jquery'=>'https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js',
                'qweather'=>'https://cdn.jsdelivr.net/npm//qweather-icons@1.1.1/font/qweather-icons.css'
            );
        } else {
            $info = array(
                'bootstrap_css'=>'/src/css/bootstrap.min.css',
                'bootstrap_icon'=>'/src/css/bootstrap-icons.css',
                'bootstrap_js'=>'/src/js/bootstrap.min.js',
                'bootstrap_bundle_js'=>'/src/js/bootstrap.bundle.min.js',
                'jquery'=>'/src/js/jquery.min.js',
                'qweather'=>'/src/css/qweather-icons.css'
            );
        }
        // 编译数据
        $data = array(
            'output'=>'SUCCESS',
            'code'=>200,
            'info'=>'数据输出成功',
            'data'=>array(
                'type'=>$result_info_object->text,
                'info'=>$info,
            ),
        );
        // 输出数据
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    } else {
        // 编译数据
        $data = array(
            'output'=>'SSID_ERROR',
            'code'=>403,
            'info'=>'参数 Query[ssid] 密钥错误'
        );
        // 输出数据
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        header("HTTP/1.1 403 Forbidden");
    }
    // 关闭数据库
    mysqli_free_result($result_key);
    mysqli_close($conn);
} else {
    // 编译数据
    $data = array(
        'output'=>'KEY_EMPTY',
        'code'=>403,
        'info'=>'参数 Query[KEY] 缺失'
    );
    // 输出数据
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
    header("HTTP/1.1 403 Forbidden");
}