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
                                if ($_COOKIE['studentID'] == '22344231' or $_COOKIE['studentID'] == '22344216' or $_COOKIE['studentID'] == '22344233' or $_COOKIE['studentID'] == '22344218') {
                                ?>
                                <div class="col-12 mb-3">
                                    <div class="row">
                                        <div class="col-12 fs-6 fw-bold"><i class="bi bi-person-circle"></i> 便携查询</div>
                                        <div class="col-12">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                    <th scope="col">内容</th>
                                                    <th scope="col">信息</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>需要购书人数</td>
                                                        <td>
                                                            <?PHP
                                                            $nums_s = 22344201;
                                                            $fil_num = 0;
                                                            while (!empty($book['data'][$nums_s]['studentID'])) {
                                                                if ($book['data'][$nums_s]['need_book'] == "TRUE") {
                                                                    $fil_num ++;
                                                                }
                                                                $nums_s ++;
                                                            }
                                                            echo $fil_num.'人';
                                                            ?>    
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>领取书本人数</td>
                                                        <td>
                                                            <?PHP
                                                            $nums_s = 22344201;
                                                            $getbook_num = 0;
                                                            while (!empty($book['data'][$nums_s]['studentID'])) {
                                                                if ($book['data'][$nums_s]['get_book'] == "TRUE") {
                                                                    $getbook_num ++;
                                                                }
                                                                $nums_s ++;
                                                            }
                                                            echo $getbook_num.' / '.$fil_num.'人';
                                                            ?>    
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?PHP
                                }
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
