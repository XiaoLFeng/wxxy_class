<?php 
// 页面ID
$menu_page = 3;
// 载入组件
include($_SERVER['DOCUMENT_ROOT'].'/admin/module/head-check.php');
include($_SERVER['DOCUMENT_ROOT'].'/plugins/Parsedown.php');
// 获取参数
$task_id = htmlspecialchars($_GET['task_id']);

// 载入用户个人信息
$task_url = $setting['API']['Domain'].'/class/task.php?key='.$setting['Key'].'&type=all';    
$task_ch = curl_init($task_url);
curl_setopt($task_ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
curl_setopt($task_ch, CURLOPT_RETURNTRANSFER, true);
$task = curl_exec($task_ch);
$task = json_decode($task,true);

// 使用MarkDown转HTML编译
$Parsedown = new Parsedown();
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
                <form action="./plugins/class_book_create.php" method="post">
                    <div class="col-12">
                        <div class="card shadow rounded-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 fs-5 fw-bold mb-3"><i class="bi bi-journal-bookmark"></i> 作业创建</div>
                                    <div class="col-12 mb-3 text-end">
                                        <a class="btn btn-danger" href="./class_book.php" role="button"><i class="bi bi-x-circle"></i> 放弃创建</a>
                                        <button class="btn btn-success" type="submit"><i class="bi bi-check2-circle"></i> 确认创建</button>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label class="form-label"><i class="bi bi-blockquote-left"></i> 标题<font color="red">*</font></label>
                                        <input type="text" class="form-control" placeholder="最大限制20个字" maxlength="20" aria-describedby="emailHelp" id="task_title" name="task_title" required>
                                        <div id="emailHelp" class="form-text px-2">例如：高等数学-函数</div>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label class="form-label"><i class="bi bi-person"></i> 创建人</label>
                                        <input type="text" class="form-control" value="<?PHP echo $member['data']['name'] ?>" readonly>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label class="form-label"><i class="bi bi-calendar"></i> 开始时间 <font color="red">*</font></label>
                                        <input type="datetime-local" class="form-control" value="<?PHP echo date("Y-m-d H:i") ?>" min="<?PHP echo date("Y-m-d H:i") ?>" id="task_opentime" name="task_opentime" required>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label class="form-label"><i class="bi bi-calendar"></i> 结束时间 <font color="red">*</font></label>
                                        <input type="datetime-local" class="form-control" value="<?PHP echo date("Y-m-d H:i") ?>" min="<?PHP echo date("Y-m-d H:i") ?>" id="task_closetime" name="task_closetime" required>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label"><i class="bi bi-chat-right-text"></i> 作业内容 <font color="red">*</font></label>
                                        <textarea class="form-control" rows="5" id="task_text" name="task_text" required></textarea>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 text-end">备注：暂时无法删除已创建的作业，如需删除请联系曾昶雯。</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
