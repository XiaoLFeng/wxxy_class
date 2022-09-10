<?php 
// 页面ID
$menu_page = 1;
// 载入组件
include($_SERVER['DOCUMENT_ROOT'].'/module/head-check.php');
include($_SERVER['DOCUMENT_ROOT'].'/plugins/function.php');
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
        <title>无锡学院 - 软件工程|二班</title>
        <link rel="shortcut icon" href="/src/img/logo.jpg" type="image/x-icon">
        <!-- CSS -->
        <link rel="stylesheet" href="https://npm.akass.cn/bootstrap@5.1.3/dist/css/bootstrap.css">
        <link rel="stylesheet" href="https://npm.akass.cn/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://npm.akass.cn/qweather-icons@1.1.1/font/qweather-icons.css">
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
<div id="main" class="container">
    <div class="row">
        <div class="col-12 col-bg-4 col-lg-3 mb-3">
            <?PHP include('./module/menu.php');  ?>
        </div>
        <div class="col-12 col-bg-8 col-lg-9 mb-3">
            <div class="row">
                <div class="col-12 col-lg-8 mb-4 d-flex flex-wrap">
                    <div class="card shadow rounded-3 flex-grow-1">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 fs-5 mb-3"><i class="bi bi-emoji-smile"></i> 欢迎</div>
                                <div class="col-12 px-5 mb-3">不知道写啥，放着吧。这个网站就服务我们二班的东西，顺便也是自己PHP练手的</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 mb-4 d-flex flex-wrap">
                    <div class="card shadow rounded-3 flex-grow-1">
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-12 mb-3 text-center">
                                    <img src="<?PHP echo $setting['API']['Domain'].'avatar/?uid='.$member['data']['uid']; ?>" style="width:120px;" class="rounded-circle">
                                </div>
                                <div class="col-12 mb-1 text-center fs-5 fw-bold"><?PHP echo $member['data']['username']; ?></div>
                                <div class="col-12 text-center"><?PHP echo $member['data']['desc']; ?></div>
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
<script src="https://npm.akass.cn/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://npm.akass.cn/bootstrap@5.1.3/dist/js/bootstrap.bundle.js"></script>
<script src="https://npm.akass.cn/jquery@3.2.1/dist/jquery.min.js"></script>
<script>
    // 加载内容
    $("#main").hide();
    window.onload=function(){
        $("#loader").fadeOut(200);
        $("#main").show(500);
    } 
</script>
</html>