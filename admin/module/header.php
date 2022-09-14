<?PHP
function menu_info($num) {
    global $header_num;
    if ($num == $header_num) {
        echo 'active';
    }
}
?>
<nav class="navbar navbar-expand-lg navbar-light ticky-top" style="background-color:#e3f2fd;">
    <div class="container py-1">
        <a class="navbar-brand" href="https://ourwxxy.x-lf.com/"><i class="bi bi-caret-right-fill"></i> 软件工程 - 二班 <i class="bi bi-caret-left-fill"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/index.php"><i class="bi bi-house"></i> 返回主页</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?PHP echo menu_info(1); ?>" aria-current="page" href="/admin/"><i class="bi bi-person-rolodex"></i> 管理首页</a>
                </li>
            </ul>
        </div>
    </div>
</nav>