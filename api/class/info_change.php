<?PHP
/*
 * wxxy_class 项目组
 * 代码均开源
 */

// 载入头
include($_SERVER['DOCUMENT_ROOT'].'/api/header-control.php');

// 获取参数
$post = file_get_contents('php://input');
$POST_INFO = json_decode($post,true);

// 载入用户个人信息
$member_url = $setting['API']['Domain'].'/class/person.php?key='.$setting['Key'].'&type=normal&studentID='.$POST_INFO['data']['studentID'];    
$member_ch = curl_init($member_url);
curl_setopt($member_ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
curl_setopt($member_ch, CURLOPT_RETURNTRANSFER, true);
$member = curl_exec($member_ch);
$member = json_decode($member,true);

// 构建函数
if ($POST_INFO['ssid'] == $member['data']['ssid']) {
    // 对数据进行转义，避免数据库注入
    $data_person_displayname = addslashes($POST_INFO['data']['person_displayname']);
    $data_person_qq = addslashes($POST_INFO['data']['person_qq']);
    $data_person_city = addslashes($POST_INFO['data']['person_city']);
    $data_person = addslashes($POST_INFO['data']['studentID']);

    // 检查数据
    if (!empty($data_person)
    and !empty($data_person_city)
    and !empty($data_person_displayname)) {
        // 检查数据可行性
        if (preg_match('/[0-9]{8}/',$data_person) and preg_match('/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{2,20}+$/u',$data_person_displayname)) {
            // 对部分数据（QQ）进行数据检查
            if (!empty($data_person_qq)) {
                if (!preg_match('/[1-9][0-9]{4,}/',$data_person_qq)) {
                    // 编译数据
                    $data = array(
                        'output'=>'DATA_QQ',
                        'code'=>403,
                        'info'=>'参数 Json[data.person_qq] 错误'
                    );
                    // 输出数据
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                    header("HTTP/1.1 403 Forbidden");
                }
            }

            // 上传数据（保证数据可以正常上传则锁定数据库）
            mysqli_query($conn,"LOCK TABLE ".$setting['SQL_DATA']['info']." WHRITE");
            if (mysqli_query($conn,"UPDATE ".$setting['SQL_DATA']['info']." SET displayname='$data_person_displayname',qq='$data_person_qq',city='$data_person_city' WHERE studentID='$data_person'")) {
                // 编译数据
                $data = array(
                    'output'=>'SUCCESS',
                    'code'=>200,
                    'info'=>'修改完毕！'
                );
                // 输出数据
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            } else {
                // 编译数据
                $data = array(
                    'output'=>'MYSQL_ERROR',
                    'code'=>403,
                    'info'=>'请重试或联系管理员'
                );
                // 输出数据
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
                header("HTTP/1.1 403 Forbidden");
            }
            mysqli_query($conn,"TABLE UNLOCK");
        } else {
            if (!preg_match('/[0-9]{8}/',$data_person)) {
                // 编译数据
                $data = array(
                    'output'=>'DATA_USER',
                    'code'=>403,
                    'info'=>'参数 Json[data.studentID] 错误'
                );
                // 输出数据
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
                header("HTTP/1.1 403 Forbidden");
            } elseif (!preg_match('/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{2,20}+$/u',$data_person_displayname)) {
                // 编译数据
                $data = array(
                    'output'=>'DATA_DISPLAYNAME',
                    'code'=>403,
                    'info'=>'参数 Json[data.person_displayname] 错误'
                );
                // 输出数据
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
                header("HTTP/1.1 403 Forbidden");
            }
        }
    } else {
        if (empty($data_person)) {
            // 编译数据
            $data = array(
                'output'=>'NONE_USER',
                'code'=>403,
                'info'=>'参数 Json[data.studentID] 缺失'
            );
            // 输出数据
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            header("HTTP/1.1 403 Forbidden");
        } elseif ($data_person_displayname) {
            // 编译数据
            $data = array(
                'output'=>'NONE_DISPLAYNAME',
                'code'=>403,
                'info'=>'参数 Json[data.person_displayname] 缺失'
            );
            // 输出数据
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            header("HTTP/1.1 403 Forbidden");
        }  elseif ($data_person_city) {
            // 编译数据
            $data = array(
                'output'=>'NONE_CITY',
                'code'=>403,
                'info'=>'参数 Json[data.person_city] 缺失'
            );
            // 输出数据
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            header("HTTP/1.1 403 Forbidden");
        } else {
            // 编译数据
            $data = array(
                'output'=>'NONE_ERROR',
                'code'=>403,
                'info'=>'参数 Json[data.__] 缺失，未知错误'
            );
            // 输出数据
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            header("HTTP/1.1 403 Forbidden");
        }
    }
} else {
    // 编译数据
    $data = array(
        'output'=>'SSID_ERROR',
        'code'=>403,
        'info'=>'密钥错误'
    );
    // 输出数据
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
    header("HTTP/1.1 403 Forbidden");
}