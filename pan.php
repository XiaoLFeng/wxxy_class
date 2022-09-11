<?php 
// 页面ID
$menu_page = 4;
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
<div id="main" class="container">
    <div class="row">
        <div class="col-12 col-bg-4 col-lg-3 mb-3">
            <?PHP include('./module/menu.php');  ?>
        </div>
        <div class="col-12 col-bg-8 col-lg-9 mb-3">
            <div class="row">
                <div class="card shadow rounded-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="row text-center">
                                    <div class="col-12"><font color="red">账户：wxxy@x-lf.cn，密码：2022wxxyrjgc2</font></div>
                                    <div class="col-12">地址：<a target="_blank" href="https://nas.x-lf.com/">https://nas.x-lf.com/</a></div>
                                    <div class="col-12">合理使用资源，不要随意删除，一共10G大小。</div>
                                    <div class="col-12">你可以理解为班级小网盘</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <iframe src="https://nas.x-lf.com/s/j42fZ" frameborder="0" class="container" height="800px"></iframe>
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
<script src="/src/js/bootstrap.bundle.min.js"></script>
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
