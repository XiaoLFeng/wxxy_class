<?php 
// 页面ID
$menu_page = 5;
$header_num = 1;
// 载入组件
include($_SERVER['DOCUMENT_ROOT'].'/admin/module/head-check.php');

// 载入全部人用户个人信息
$member_all_url = $setting['API']['Domain'].'/out_school/quanbu_select.php?key='.$setting['Key'];    
$member_all_ch = curl_init($member_all_url);
curl_setopt($member_all_ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
curl_setopt($member_all_ch, CURLOPT_RETURNTRANSFER, true);
$member_all = curl_exec($member_all_ch);
$member_all = json_decode($member_all,true);
?>
<!doctype html>
<!-- 
    哎呀，原来你看到了呀。
    欢迎你~
    如果你想看完整的代码你可以去我的GITHUB看代码，代码地址如下哦：
        https://github.com/XiaoLFeng/wxxy_class
    欢迎来201宿舍玩啊~
 -->
<html lang="zh">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?PHP echo $normal['data']['web_title']['text']?> - <?PHP echo $normal['data']['web_subtitle']['text']?></title>
        <link rel="shortcut icon" href="<?PHP echo $normal['data']['web_icon']['text']?>" type="image/x-icon">
        <meta name="description" content="<?PHP echo $normal['data']['web_desc']['text']?>">
        <!-- CSS -->
        <link rel="stylesheet" href="<?PHP echo $mirror['data']['info']['bootstrap_css'] ?>">
        <link rel="stylesheet" href="<?PHP echo $mirror['data']['info']['bootstrap_icon'] ?>">
        <link rel="stylesheet" href="<?PHP echo $mirror['data']['info']['qweather'] ?>">
    </head>
<body style="background-color:#e3f2fd;">
<!-- 菜单 -->
<header>
<?PHP include($_SERVER['DOCUMENT_ROOT'].'/admin/module/header.php') ?>
</header>
<!-- 内容 -->
<div id="loader" class="container placeholder-glow text-center py-4">
    <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
    <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
    <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
</div>
<div id="main" class="container">
    <div class="row">
        <div class="col-12 col-bg-4 col-lg-3 mb-3">
            <?PHP include('./module/menu.php');  ?>
        </div>
        <div class="col-12 col-bg-8 col-lg-9 mt-3 mb-3">
            <div class="row">
                <div class="col-12 col-lg-12 mb-4">
                    <div class="card shadow rounded-3 flex-grow-1 mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 fs-5 mb-3"><i class="bi bi-emoji-smile"></i> 目前(<?PHP echo date('Y-m-d')?>) 在校外学生</div>
                                <div class="col-12 px-4 mb-3">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">学生</th>
                                            <th scope="col">出校时间</th>
                                            <th scope="col">返校时间</th>
                                            <th scope="col">类型</th>
                                            <th scope="col">主要到达地方</th>
                                            <th scope="col">出校原因</th>
                                            <th scope="col">记录</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?PHP
                                        $num = 1;
                                        while ($member_all['data'][$num]['studentID'] != NULL) {
                                            ?>
                                            <tr>
                                                <th scope="row"><?PHP echo $member_all['data'][$num]['name'] ?></th>
                                                <td><?PHP echo $member_all['data'][$num]['out_time'] ?></td>
                                                <td><?PHP echo $member_all['data'][$num]['back_time'] ?></td>
                                                <td><?PHP echo $member_all['data'][$num]['out_type'] ?></td>
                                                <td><?PHP echo $member_all['data'][$num]['out_place'] ?></td>
                                                <td><?PHP echo $member_all['data'][$num]['out_reason'] ?></td>
                                                <td><?PHP
                                                if ($member_all['data'][$num]['back_time'] != NULL) {
                                                    echo '<span class="badge bg-success">已返校</span>';
                                                } elseif ($member_all['data'][$num]['back_time'] == NULL) {
                                                    echo '<span class="badge bg-danger">未返校</span>';
                                                } else {
                                                    echo '<span class="badge bg-secondary">未知记录</span>';
                                                }
                                                ?></td>
                                            </tr>
                                            <?PHP
                                            $num ++;
                                        }
                                        ?>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 页尾 -->
<?PHP include($_SERVER['DOCUMENT_ROOT'].'/module/footer.php') ?>
</body>
<!-- JavaScript -->
<script src="<?PHP echo $mirror['data']['info']['qweather'] ?>"></script>
<script src="<?PHP echo $mirror['data']['info']['bootstrap_bundle_js'] ?>"></script>
<script src="<?PHP echo $mirror['data']['info']['jquery'] ?>"></script>
<script>
    // 加载内容
    $("#main").hide();
    window.onload=function(){
        $("#loader").fadeOut(200);
        $("#main").show(500);
    } 
</script>
</html>
