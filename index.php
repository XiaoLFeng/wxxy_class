<?php 
// 页面ID
$menu_page = 1;
// 载入组件
include($_SERVER['DOCUMENT_ROOT'].'/module/head-check.php');
include($_SERVER['DOCUMENT_ROOT'].'/plugins/function.php');
// 载入全部人用户个人信息
$member_all_url = $setting['API']['Domain'].'/class/person.php?key='.$setting['Key'].'&type=all';    
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
                <div class="col-12 col-lg-8 mb-4 d-flex flex-wrap">
                    <div class="card shadow rounded-3 flex-grow-1">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 fs-5 mb-3"><i class="bi bi-emoji-smile"></i> 欢迎</div>
                                <div class="col-12 px-5 mb-3">不知道写啥，放着吧。这个网站就服务我们二班的东西，顺便也是自己PHP练手的</div>
                                <div class="col-12 text-center">
                                    <a class="btn btn-primary" href="/setting.php" role="button">个人设置</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 mb-4 d-flex flex-wrap">
                    <div class="card shadow rounded-3 flex-grow-1">
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-12 mb-3 text-center">
                                    <img src="<?PHP echo $setting['API']['Domain'].'/avatar/?studentID='.$member['data']['studentID']; ?>" style="width:120px;" class="rounded-circle">
                                </div>
                                <div class="col-12 mb-1 text-center fs-5 fw-bold"><?PHP echo $member['data']['name']; ?></div>
                                <div class="col-12 text-center"><?PHP echo $member['data']['studentID']; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 mb-4 d-flex flex-wrap">
                    <div class="card shadow rounded-3 flex-grow-1">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-3 fs-5 fw-bold"><i class="bi bi-file-earmark-person"></i> 班干部表</div>
                                <div class="col-12">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">学号</th>
                                                <th scope="col">姓名</th>
                                                <th scope="col">职位</th>
                                                <th scope="col">QQ号</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?PHP
                                            $num_add = 1;
                                            while (!empty($member_all['data'][$num_add]['studentID'])) {
                                            if ($member_all['data'][$num_add]['op'] == '1') {
                                            ?>
                                            <tr>
                                                <th scope="row"><?PHP echo $member_all['data'][$num_add]['studentID'] ?></th>
                                                <td><?PHP echo $member_all['data'][$num_add]['name'] ?></td>
                                                <td><?PHP echo $member_all['data'][$num_add]['office'] ?></td>
                                                <td><?PHP echo $member_all['data'][$num_add]['qq'] ?></td>
                                            </tr>
                                            <?PHP
                                            }
                                            $num_add ++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 mb-4 d-flex flex-wrap">
                    <div class="card shadow rounded-3 flex-grow-1">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-3 fs-5 fw-bold"><i class="bi bi-file-earmark-person"></i> 班级辅导员</div>
                                <div class="row">
                                    <div class="col-12 mb-3 text-center">
                                        <img src="https://q1.qlogo.cn/g?b=qq&nk=843552555&s=640" style="width:120px;" class="rounded-circle">
                                    </div>
                                    <div class="col-12 mb-1 text-center fs-5 fw-bold">辅导员 - 缪志刚老师</div>
                                    <div class="col-12 text-center">QQ：843552555</div>
                                    <div class="col-12 text-center">TEL：15605297830</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-4 d-flex flex-wrap">
                    <div class="card shadow rounded-3 flex-grow-1">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-3 fs-5 fw-bold"><i class="bi bi-file-earmark-person"></i> 校园地图</div>
                                <div class="col-12">
                                    <img src="/src/img/map.jpg" class="container">
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
