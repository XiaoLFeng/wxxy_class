<?php 
// 页面ID
$menu_page = 100;
$menu_list = 2;
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
        <link href="/src/css/city-picker.css" rel="stylesheet" type="text/css" />
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
        <div class="col-12 col-bg-8 col-lg-9 mt-3 mb-3">
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="card shadow rounded-3">
                        <div class="card-body">
                            <form action="/setting_data_upload.php?type=normal" method="post">
                                <div class="row">
                                    <div class="col-12 mb-4 fs-5 fw-bold"><i class="bi bi-list-ul"></i> 基本设置</div>
                                    <div class="row px-4">
                                        <div class="col-12 col-lg-6 mb-3">
                                            <label class="form-label"><i class="bi bi-person"></i> 学号 <font color="red">*</font></label>
                                            <input type="text" class="form-control" value="<?PHP echo stripslashes($member['data']['studentID']) ?>" readonly>
                                        </div>
                                        <div class="col-12 col-lg-6 mb-3">
                                            <label class="form-label"><i class="bi bi-person"></i> 姓名 <font color="red">*</font></label>
                                            <input type="text" class="form-control" value="<?PHP echo stripslashes($member['data']['name']) ?>" readonly>
                                        </div>
                                        <div class="col-12 col-lg-6 mb-3">
                                            <label class="form-label"><i class="bi bi-person"></i> 宿舍号 <font color="red">*</font></label>
                                            <input type="text" class="form-control" value="<?PHP echo stripslashes($member['data']['dormitory']) ?>" readonly>
                                        </div>
                                        <div class="col-12 col-lg-6 mb-3">
                                            <label class="form-label"><i class="bi bi-person"></i> 班级委员 <font color="red">*</font></label>
                                            <input type="text" class="form-control" value="<?PHP echo stripslashes($member['data']['office']) ?>" readonly>
                                        </div>
                                        <div class="col-12 col-lg-6 mb-3">
                                            <label class="form-label"><i class="bi bi-card-list"></i> 昵称 <font color="red">*</font></label>
                                            <input type="text" class="form-control" id="person_displayname" name="person_displayname" value="<?PHP echo stripslashes($member['data']['displayname']) ?>">
                                        </div>
                                        <div class="col-12 col-lg-6 mb-3">
                                            <label class="form-label"><i class="bi bi-chat-dots"></i> QQ <font color="grey" class="fw-light">头像会自动获取QQ头像</font></label>
                                            <input type="text" class="form-control" id="person_qq" name="person_qq" value="<?PHP echo stripslashes($member['data']['qq']) ?>">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label"><i class="bi bi-building"></i> 所在设区市 <font color="red">*</font></label>
                                            <div id="distpicker" class="container">
                                                <div class="form-group">
                                                    <input id="person_city" name="person_city" class="form-control" readonly type="text" value="<?PHP 
                                                    if (empty($member['data']['city'])) {
                                                        echo '北京市/北京市/朝阳区';
                                                    } else {
                                                        echo stripslashes($member['data']['city']);
                                                    }
                                                    ?>" data-toggle="city-picker" style="width: auto;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3 text-end">
                                            <button class="btn btn-outline-success" type="submit"><i class="bi bi-check-circle"></i> 提交</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card shadow rounded-3">
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-12 mb-3 fs-5 fw-bold"><i class="bi bi-key"></i> 修改密码</div>
                                </div>
                            </form>
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
<script src="/src/js/city-picker.data.js"></script>
<script src="/src/js/city-picker.js"></script>
<script src="/src/js/main.js"></script>
<script>
    // 加载内容
    $("#main").hide();
    window.onload=function(){
        $("#loader").fadeOut(200);
        $("#main").show(500);
    } 
</script>
</html>
