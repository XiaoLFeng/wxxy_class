<?php 
// 页面ID
$menu_page = 8;

// 载入组件
include($_SERVER['DOCUMENT_ROOT'].'/setting.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/module/head-check.php');
// 载入信息
$signin_url = $setting['API']['Domain'].'/signin/?key='.$setting['Key'].'&studentID='.$_COOKIE['studentID'].'&type=myself';
$signin_ch = curl_init($signin_url);
curl_setopt($signin_ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
curl_setopt($signin_ch, CURLOPT_RETURNTRANSFER, true);
$signin = curl_exec($signin_ch);
$signin = json_decode($signin,true);
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
<?PHP include($_SERVER['DOCUMENT_ROOT'].'/module/header.php') ?>
</header>
<!-- 内容 -->
<div id="loader" class="container placeholder-glow text-center py-4">
    <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
    <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
    <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
</div>
<div id="main" class="container my-3">
    <div class="row">
        <div class="col-12 col-bg-4 col-lg-3 mb-3">
            <?PHP include($_SERVER['DOCUMENT_ROOT'].'/module/menu.php');  ?>
        </div>
        <div class="col-12 col-bg-8 col-lg-9 mb-3">
            <div class="row">
                <div class="card shadow rounded-3">
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-12 fs-5 fw-bold mb-3">军训服装集合领取签到</div>
                            <?PHP
                            if ($_COOKIE['studentID'] == '22344233' or $_COOKIE['studentID'] == '22344231' or $_COOKIE['studentID'] == '22344218' or $_COOKIE['studentID'] == '22344219' or $_COOKIE['studentID'] == '22344216') {
                            ?>
                            <div class="col-12 my-3">查询到场人 <a class="btn btn-danger" href="./admin_20220911.php" role="button">查询</a></div>
                            <?PHP
                            }
                            if (empty($signin['data']['signin'])) {
                            ?>
                                <div class="col-12 mb-1">点击下方按钮进行签到</div>
                                <div class="col-12 mb-3"><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">签到</button></div>
                            <?PHP
                            } else {
                            ?>
                                <div class="col-12 mb-1">您已经完成签到啦~</div>
                                <div class="col-12 mb-3">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                            <th scope="col">内容</th>
                                            <th scope="col">信息</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">学号</th>
                                                <td><?PHP echo $signin['data']['studentID'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">姓名</th>
                                                <td><?PHP echo $signin['data']['name'] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">签到</th>
                                                <td>
                                                    <?PHP 
                                                    if (empty($signin['data']['signin'])) {
                                                        echo '<font color="red">未签到</font>';
                                                    } else {
                                                        echo '<font color="green">已签到</font>';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">签到时间</th>
                                                <td><?PHP echo $signin['data']['time'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            <?PHP
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Model -->
<form action="./upload/20220911.php" method="post">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">请输入签到码</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            为了方便我们统计人数，请不要随意点击签到，请到指定位置后点击签到。谢谢QWQ
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">确认签到</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- 页尾 -->
<?PHP include($_SERVER['DOCUMENT_ROOT'].'/module/footer.php') ?>
</body>
<!-- JavaScript -->
<script src="<?PHP echo $mirror['data']['info']['bootstrap_js'] ?>"></script>
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
