<?php 
// 页面ID
$menu_id = 2;

// 载入组件
include($_SERVER['DOCUMENT_ROOT'].'/module/head-check.php');
$callback = htmlspecialchars($_GET['callback']);
?>
<!doctype html>
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
    </head>
<body>
<!-- 菜单 -->
<header>
<?PHP include($_SERVER['DOCUMENT_ROOT'].'/module/header.php') ?>
</header>
<!-- 内容 -->
<div id="loader" class="container placeholder-glow mt-5 text-center">
    <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
    <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
    <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
</div>
<div id="main" class="container my-5">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-lg-3"></div>
                <div class="col-12 col-lg-6">
                    <div class="card shadow-sm rounded-3">
                        <div class="card-body">
                            <form action="./plugins/login.php?callback=<?PHP echo $callback; ?>" method="post">
                                <div class="row">
                                    <div class="col-12 my-3 fs-4 fw-bold text-center"><?PHP echo $normal['data']['web_title']['text']?>二班 - 登录</div>
                                    <div class="col-12 mb-3 px-5 input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i>&nbsp;学号</span>
                                        <input type="text" class="form-control" placeholder="22344233" id="studentID" name="studentID" required>
                                    </div>
                                    <div class="col-12 mb-1 px-5 input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i>&nbsp;密码</span>
                                        <input type="password" class="form-control" placeholder="***" id="password" name="password" required>
                                    </div>
                                    <div class="col-12 mb-5 px-5">
                                        <font color="red">（密码市学号最后三位，没有隐私信息不设计密码修改）</font>
                                        <br/>
                                        <font color="grey">登陆后一个月内默认保持登录状态</font>
                                    </div>
                                    <div class="col-12 mb-3 px-5">
                                        <div class="row">
                                            <div class="col-3"></div>
                                            <div class="d-grid gap-3 col-6">
                                                <button class="btn btn-outline-primary" type="submit"><i class="bi bi-box-arrow-in-right"></i> 登录</button>
                                            </div>
                                            <div class="col-3"></div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3"></div>
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
