<?PHP
/*
 * wxxy_class 项目组
 * 代码均开源
 */

// 载入头
include($_SERVER['DOCUMENT_ROOT'].'/api/header-control.php');

// 编译数据
$data = array(
    'output'=>'SUCCESS',
    'code'=>200,
    'info'=>'当看到此页面代表所有API项目正常运行'
);

// 输出数据
echo json_encode($data,JSON_UNESCAPED_UNICODE);