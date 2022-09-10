<?php 
// 页面ID
$menu_page = 7;
// 载入组件
include($_SERVER['DOCUMENT_ROOT'].'/setting.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/module/head-check.php');
include($_SERVER['DOCUMENT_ROOT'].'/plugins/function.php');
// 配置信息
$key = htmlspecialchars($_GET['key']);

// 载入信息
$book_url = $setting['API']['Domain'].'/get_book/?key='.$setting['Key'];  
$book_ch = curl_init($book_url);
curl_setopt($book_ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
curl_setopt($book_ch, CURLOPT_RETURNTRANSFER, true);
$book = curl_exec($book_ch);
$book = json_decode($book,true);
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
                <div class="card shadow rounded-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 fs-5 fw-bold mb-3"><i class="bi bi-journal-bookmark"></i> 书本领取登记</div>
                            <?PHP if ($_COOKIE['studentID'] == '22344233' and $key == $setting['Key']) {
                            ?>
                            <div class="col-12">
                                <form action="./get_book_upload.php" method="post">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <select class="form-select form-select-sm" name="student">
                                                <?PHP 
                                                $num = 22344201;
                                                while (!empty($book['data'][$num]['studentID'])) {
                                                    if ($book['data'][$num]['need_book'] == "FALSE" or $book['data'][$num]['get_book'] == "TRUE") {
                                                        ?><option value="<?PHP echo $book['data'][$num]['studentID'] ?>" disabled><?PHP echo $book['data'][$num]['name'] ?></option><?PHP
                                                    } else {
                                                        ?><option value="<?PHP echo $book['data'][$num]['studentID'] ?>"><?PHP echo $book['data'][$num]['name'] ?></option><?PHP
                                                    }
                                                    $num ++;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-12 text-center">
                                            <button class="btn btn-primary" type="submit">提交</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <?PHP
                            } else {
                            ?>
                            <div class="col-12">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th scope="col">学号</th>
                                        <th scope="col">姓名</th>
                                        <th scope="col">需要书</th>
                                        <th scope="col">已领取</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?PHP 
                                        $nums = 22344201;
                                        while (!empty($book['data'][$nums]['studentID'])) {
                                        ?>
                                        <tr class="">
                                            <th scope="row"><?PHP echo $book['data'][$nums]['studentID'] ?></th>
                                            <td><?PHP echo $book['data'][$nums]['name'] ?></td>
                                            <td>
                                                <?PHP 
                                                if ($book['data'][$nums]['need_book'] == "TRUE") {
                                                    echo '需要';
                                                } else {
                                                    echo '<font color="red">不需要</font>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?PHP
                                                if ($book['data'][$nums]['need_book'] == "FALSE") {
                                                    echo '';
                                                } else {
                                                    if ($book['data'][$nums]['get_book'] == "TRUE") {
                                                        echo '<font color="green">已领取</font>';
                                                    } else {
                                                        echo '<font color="red">未领取</font>';
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <?PHP
                                        $nums ++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?PHP
                            } ?>
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