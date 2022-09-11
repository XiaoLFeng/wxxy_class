<?PHP
// 检查是否正常登录
$callback = htmlspecialchars($_GET['callback']);
if ($menu_id == 2) {
    if (!empty($_COOKIE['studentID'])) {
        if (empty($callback)) {
            header('location: /index.php');
        } else {
            header('location:'.$callback);
        }
    }
} else {
    if (empty($_COOKIE['studentID'])) {
        $get_ip = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        header('location: https://ourwxxy.x-lf.com/auth.php?callback='.$get_ip);
    }
}

// 获取数据（获取数据库信息）
include($_SERVER['DOCUMENT_ROOT'].'/setting.inc.php');

// 载入网站基本信息
$normal_url = $setting['API']['Domain'].'/main/?key='.$setting['Key'];    
$normal_ch = curl_init($normal_url);
curl_setopt($normal_ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
curl_setopt($normal_ch, CURLOPT_RETURNTRANSFER, true);
$normal = curl_exec($normal_ch);
$normal = json_decode($normal,true);

// 载入镜像基本信息
$mirror_url = $setting['API']['Domain'].'/main/mirrors.php?key='.$setting['Key'];    
$mirror_ch = curl_init($mirror_url);
curl_setopt($mirror_ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
curl_setopt($mirror_ch, CURLOPT_RETURNTRANSFER, true);
$mirror = curl_exec($mirror_ch);
$mirror = json_decode($mirror,true);

// 载入用户个人信息
$member_url = $setting['API']['Domain'].'/class/person.php?key='.$setting['Key'].'&type=normal&studentID='.$_COOKIE['studentID'];    
$member_ch = curl_init($member_url);
curl_setopt($member_ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
curl_setopt($member_ch, CURLOPT_RETURNTRANSFER, true);
$member = curl_exec($member_ch);
$member = json_decode($member,true);