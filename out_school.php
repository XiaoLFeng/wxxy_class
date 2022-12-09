<?php 
// 页面ID
$menu_page = 10;
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
        <div class="col-12 col-bg-8 col-lg-9 mt-3 mb-3">
            <?PHP
            if ($back_school_sel['output'] == "NO_BACK_SCHOOL") {
                ?>
                <div class="row">
                    <div class="card shadow rounded-3">
                        <div class="card-body">
                            <form action="/plugins/in_school.php" method="post">
                                <div class="row">
                                    <div class="col-12 mb-3 fs-4 fw-bold text-center">软件工程2班 - 进出校统计</div>
                                    <div class="col-12 mb-3 text-danger">您目前未销假，如已返校请销假！</div>
                                    <div class="col-12 mb-3 text-success">一起努力，让我们健健康康参加考试，顺利度过疫情难关！</div>
                                    <div class="col-12 col-xl-6 mb-3 px-5">
                                        <label class="form-label"><i class="bi bi-credit-card-2-front"></i> 学号</label>
                                        <input type="text" class="form-control" id="studentID" name="studentID" value="<?PHP echo stripslashes($member['data']['studentID']) ?>" readonly>
                                    </div>
                                    <div class="col-12 col-xl-6 mb-3 px-5">
                                        <label class="form-label"><i class="bi bi-person"></i> 姓名</label>
                                        <input type="text" class="form-control" value="<?PHP echo stripslashes($member['data']['name']) ?>" readonly>
                                    </div>
                                    <div class="col-12 mb-3 px-5">
                                        <label class="form-label"><i class="bi bi-alarm"></i> 返校时间（以此刻时间为主）</label>
                                        <input type="text" class="form-control" id="out" name="out" value="<?PHP echo date('Y-m-d H:i:s') ?>" readonly>
                                    </div>
                                    <div class="col-12 mb-3 text-center"><button class="btn btn-primary" type="submit"><i class="bi bi-upload"></i> 提交信息</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?PHP
            } else {
                ?>
                <div class="row">
                    <div class="card shadow rounded-3">
                        <div class="card-body">
                            <form action="/plugins/out_school.php" method="post">
                                <div class="row">
                                    <div class="col-12 mb-3 fs-4 fw-bold text-center">软件工程2班 - 进出校统计</div>
                                    <div class="col-12 mb-3">注意：这个进出校统计系统不属于学习通，不属于学校，只是我们班委处需要执行的操作，依据目前的防疫形势下，我们需要清楚你们的动向，请各位学生积极配合班委工作，出入校园信息请认真填写，谢谢配合！</div>
                                    <div class="col-12 mb-3 text-danger">在你返校后请重新打开此页面进行销假！</div>
                                    <div class="col-12 mb-3 text-success">一起努力，让我们健健康康参加考试，顺利度过疫情难关！</div>
                                    <div class="col-12 col-xl-6 mb-3 px-5">
                                        <label class="form-label"><i class="bi bi-credit-card-2-front"></i> 学号</label>
                                        <input type="text" class="form-control" id="studentID" name="studentID" value="<?PHP echo stripslashes($member['data']['studentID']) ?>" readonly>
                                    </div>
                                    <div class="col-12 col-xl-6 mb-3 px-5">
                                        <label class="form-label"><i class="bi bi-person"></i> 姓名</label>
                                        <input type="text" class="form-control" value="<?PHP echo stripslashes($member['data']['name']) ?>" readonly>
                                    </div>
                                    <div class="col-12 col-xl-6 mb-3 px-5">
                                        <label class="form-label"><i class="bi bi-house"></i> 所在宿舍</label>
                                        <input type="text" class="form-control" value="<?PHP echo stripslashes($member['data']['dormitory']) ?>" readonly>
                                    </div>
                                    <div class="col-12 col-xl-6 mb-3 px-5">
                                        <label class="form-label"><i class="bi bi-alarm"></i> 离校时间（以申请时间为主）</label>
                                        <input type="text" class="form-control" id="out" name="out" value="<?PHP echo date('Y-m-d H:i:s') ?>" readonly>
                                    </div>
                                    <div class="col-12 col-xl-6 mb-3 px-5">
                                        <label class="form-label"><i class="bi bi-shop"></i> 请假类型</label>
                                        <select class="form-select" id="reason" name="reason" required>
                                            <option value="普通" selected>普通</option>
                                            <option value="病假">病假</option>
                                            <option value="事假">事假</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-xl-6 mb-3 px-5">
                                        <label class="form-label"><i class="bi bi-shop"></i> 主要去的地方</label>
                                        <input type="text" class="form-control" id="place" name="place" placeholder="例如：锡山人民医院" required>
                                    </div>
                                    <div class="col-12 mb-4 px-5">
                                        <label class="form-label">备注信息（主要去的地方，去做什么，预计几点回来）</label>
                                        <textarea class="form-control" id="info" name="info" rows="3" required></textarea>
                                    </div>
                                    <div class="col-12 mb-3 text-center"><button class="btn btn-primary" type="submit"><i class="bi bi-upload"></i> 提交信息</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?PHP
            }
            ?>
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
