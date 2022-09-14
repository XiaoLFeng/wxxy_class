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
<?PHP
if (empty($task_id)) {
?>
<div id="main" class="container">
    <div class="row">
        <div class="col-12 col-bg-4 col-lg-3 mb-3">
            <?PHP include('./module/menu.php');  ?>
        </div>
        <div class="col-12 col-bg-8 col-lg-9 mt-3 mb-3">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow rounded-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 fs-5 fw-bold mb-3"><i class="bi bi-journal-bookmark"></i> 作业管理</div>
                                <div class="col-12 px-5 mb-3">
                                    <a class="btn btn-primary" href="./class_book_create.php" role="button"><i class="bi bi-plus-circle"></i> 添加作业</a>
                                </div>
                                <div class="col-12 fs-5 fw-bold mb-3"><i class="bi bi-journal-bookmark"></i> 作业清单</div>
                                <div class="col-12">
                                    <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID号</th>
                                            <th scope="col">作业标题</th>
                                            <th scope="col">截止时间</th>
                                            <th scope="col">创建人</th>
                                            <th scope="col">管理</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?PHP
                                        $num = 1;
                                        while ($task['data'][$num]['id']) {
                                            // 载入用户个人信息
                                            $member_creator_url = $setting['API']['Domain'].'/class/person.php?key='.$setting['Key'].'&type=normal&studentID='.$task['data'][$num]['creator'];    
                                            $member_creator_ch = curl_init($member_creator_url);
                                            curl_setopt($member_creator_ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
                                            curl_setopt($member_creator_ch, CURLOPT_RETURNTRANSFER, true);
                                            $member_creator = curl_exec($member_creator_ch);
                                            $member_creator = json_decode($member_creator,true);
                                        ?>
                                        <tr>
                                            <th scope="row"><?PHP echo $task['data'][$num]['task_id'] ?></th>
                                            <td><?PHP echo stripslashes($task['data'][$num]['title']) ?></td>
                                            <td><?PHP echo stripslashes($task['data'][$num]['closetime']) ?></td>
                                            <td><?PHP echo $member_creator['data']['name'] ?></td>
                                            <td><a class="btn btn-outline-primary btn-sm" href="?task_id=<?PHP echo $task['data'][$num]['task_id'] ?>" role="button"><i class="bi bi-dpad"></i> 管理</a></td>
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
<?PHP
} else {
    // 载入用户个人信息
    $task_url = $setting['API']['Domain'].'/class/task.php?key='.$setting['Key'].'&type=check&task_id='.$task_id;    
    $task_ch = curl_init($task_url);
    curl_setopt($task_ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
    curl_setopt($task_ch, CURLOPT_RETURNTRANSFER, true);
    $task = curl_exec($task_ch);
    $task = json_decode($task,true);
?>
<div id="main" class="container">
    <div class="row">
        <div class="col-12 col-bg-4 col-lg-3 mb-3">
            <?PHP include('./module/menu.php');  ?>
        </div>
        <div class="col-12 col-bg-8 col-lg-9 mt-3 mb-3">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow rounded-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 fs-5 fw-bold mb-3"><i class="bi bi-journal-bookmark"></i> 作业管理</div>
                                <div class="col-12 mb-3"><a class="btn btn-outline-primary" href="/admin/class_book.php" role="button"><i class="bi bi-arrow-90deg-left"></i> 返回作业管理</a></div>
                                <div class="col-12 fs-5 fw-bold mb-3 text-center"><?PHP echo stripslashes($task['data']['title']) ?></div>
                                <div class="col-12 mb-3 px-4"><?PHP echo $Parsedown->text(stripslashes($task['data']['text'])); ?></div>
                                <div class="col-12 fs-5 fw-bold mb-1"><i class="bi bi-journal-bookmark"></i> 本班情况</div>
                                <div class="col-12">
                                    <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">学号</th>
                                            <th scope="col">姓名</th>
                                            <th scope="col">交作业</th>
                                            <th scope="col">时间</th>
                                            <th scope="col">处理人</th>
                                            <th scope="col">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?PHP
                                        $num = 22344201;
                                        while ($task['data']['person'][$num]['studentID']) {
                                        ?>
                                        <tr>
                                            <th scope="row"><?PHP echo stripslashes($task['data']['person'][$num]['studentID']) ?></th>
                                            <td><?PHP echo stripslashes($task['data']['person'][$num]['name']) ?></td>
                                            <td>
                                                <?PHP
                                                if (empty($task['data']['person'][$num]['finish']) or $task['data']['person'][$num]['finish'] == "FALSE") {
                                                    echo '<font color="red">未提交</font>';
                                                } else {
                                                    if ($task['data']['person'][$num]['finish'] == "TRUE") {
                                                        echo '<font color="green">已提交</font>';
                                                    } else {
                                                        echo '<font color="grey">未知</font>';
                                                    }
                                                }
                                                ?>    
                                            </td>
                                            <td><?PHP echo stripslashes($task['data']['person'][$num]['time']) ?></td>
                                            <td><?PHP echo stripslashes($task['data']['person'][$num]['creator']) ?></td>
                                            <td>
                                                <?PHP 
                                                if (empty($task['data']['person'][$num]['finish']) or $task['data']['person'][$num]['finish'] == "FALSE") {
                                                ?>
                                                <a class="btn btn-outline-success btn-sm" href="./plugins/class_book_change.php?task_id=<?PHP echo $task_id ?>&studentID=<?PHP echo stripslashes($task['data']['person'][$num]['studentID'])?>&finish=TRUE" role="button"><i class="bi bi-check"></i> 确认提交</a>
                                                <?PHP
                                                } else {
                                                    if ($task['data']['person'][$num]['finish'] == "TRUE") {
                                                        ?>
                                                        <a class="btn btn-outline-danger btn-sm" href="./plugins/class_book_change.php?task_id=<?PHP echo $task_id ?>&studentID=<?PHP echo stripslashes($task['data']['person'][$num]['studentID'])?>&finish=FALSE" role="button"><i class="bi bi-x"></i> 取消提交</a>
                                                        <?PHP
                                                    } else {
                                                        ?>
                                                        <a class="btn btn-outline-success btn-sm" href="./plugins/class_book_change.php?task_id=<?PHP echo $task_id ?>&studentID=<?PHP echo stripslashes($task['data']['person'][$num]['studentID'])?>&finish=TRUE" role="button"><i class="bi bi-check"></i> 确认提交</a>
                                                        <?PHP
                                                    }
                                                }
                                                ?>
                                            </td>
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
<?PHP
}
?>
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
