<?PHP
/*
 * wxxy_class 项目组
 * 代码均开源
 */

// 载入头
include($_SERVER['DOCUMENT_ROOT'].'/api/header-control.php');

// 载入组件
$key = htmlspecialchars($_GET['key']);

// 构建函数
if ($key == $setting['Key']) {
    // 数据库信息查询
    $result_book = mysqli_query($conn,"SELECT a.studentID,a.name,a.get_book,b.getbook FROM ".$setting['SQL_DATA']['info']." a LEFT JOIN ".$setting['SQL_DATA']['book']." b ON a.studentID=b.s_ID");
    while ($result_book_object = mysqli_fetch_object($result_book)) {
        $array[$result_book_object->studentID] = array(
            'studentID'=>$result_book_object->studentID,
            'name'=>$result_book_object->name,
            'need_book'=>$result_book_object->get_book,
            'get_book'=>$result_book_object->getbook
        );
    }
    // 编译数据
    $data = array(
        'output'=>'SUCCESS',
        'code'=>200,
        'info'=>'输出成功',
        'data'=>$array,
    );
    // 输出数据
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
} else {
    // 编译数据
    $data = array(
        'output'=>'KEY_ERROR',
        'code'=>403,
        'info'=>'密钥错误'
    );
    // 输出数据
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
    header("HTTP/1.1 403 Forbidden");
}